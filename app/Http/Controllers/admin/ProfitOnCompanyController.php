<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\CompanyCommission;use App\Models\TripHistory;use App\Models\User;use Carbon\Carbon;use Illuminate\Http\Request;use Illuminate\Support\Facades\DB;

class ProfitOnCompanyController extends Controller
{
    public function profitList()
    {
         // Total income
         // Sum for request_trip where calculated_fare is always used
         $requestTripIncome = TripHistory::where('trip_type', 'request_trip')->sum('calculated_fare');
         // Sum for manual_trip based on fare_received_status condition
         $manualTripIncome = TripHistory::where('trip_type', 'manual_trip')->sum(DB::raw('CASE 
                 WHEN fare_received_status = 0 THEN calculated_fare
                 ELSE estimated_fare END'));

         $agentTripIncome = TripHistory::where('trip_type', 'agent_create_trip')
             ->sum(DB::raw('CASE 
                 WHEN fare_received_status = 0 THEN calculated_fare
                 ELSE estimated_fare
             END'));
         $totalIncome = $requestTripIncome + $manualTripIncome + $agentTripIncome;



         // Today income
         $startOfToday = Carbon::today()->startOfDay();
         $endOfToday = Carbon::today()->endOfDay();
         // Sum for request_trip where calculated_fare is always used
         $requestTripIncomeToday = TripHistory::where('trip_type', 'request_trip')
             ->whereBetween('created_at', [$startOfToday, $endOfToday])
             ->sum('calculated_fare');
         // Sum for manual_trip based on fare_received_status condition
         $manualTripIncomeToday = TripHistory::where('trip_type', 'manual_trip')
             ->whereBetween('created_at', [$startOfToday, $endOfToday])
             ->sum(DB::raw('CASE 
                 WHEN fare_received_status = 0 THEN calculated_fare
                 ELSE estimated_fare END'));

         // Sum for agent_create_trip based on fare_received_status condition
         $agentTripIncomeToday = TripHistory::where('trip_type', 'agent_create_trip')
             ->whereBetween('created_at', [$startOfToday, $endOfToday])
             ->sum(DB::raw('CASE 
                 WHEN fare_received_status = 0 THEN calculated_fare
                 ELSE estimated_fare END'));

         $totalIncomeToday = $requestTripIncomeToday + $manualTripIncomeToday + $agentTripIncomeToday;

         // Week income
         $startOfWeek = Carbon::now()->startOfWeek();
         $endOfWeek = Carbon::now()->endOfWeek();
         $requestTripIncomeWeek = TripHistory::where('trip_type', 'request_trip')
             ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
             ->sum('calculated_fare');
         $manualTripIncomeWeek = TripHistory::where('trip_type', 'manual_trip')
             ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
             ->sum(DB::raw('CASE 
                 WHEN fare_received_status = 0 THEN calculated_fare
                 ELSE estimated_fare END'));
         $agentTripIncomeWeek = TripHistory::where('trip_type', 'agent_create_trip')
             ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
             ->sum(DB::raw('CASE 
                 WHEN fare_received_status = 0 THEN calculated_fare
                 ELSE estimated_fare END'));

         $totalIncomeWeek = $requestTripIncomeWeek + $manualTripIncomeWeek + $agentTripIncomeWeek;

         // Month income
         $startOfMonth = Carbon::now()->startOfMonth();
         $endOfMonth = Carbon::now()->endOfMonth();
         $requestTripIncomeMonth = TripHistory::where('trip_type', 'request_trip')
             ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
             ->sum('calculated_fare');
         $manualTripIncomeMonth = TripHistory::where('trip_type', 'manual_trip')
             ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
             ->sum(DB::raw('CASE 
                 WHEN fare_received_status = 0 THEN calculated_fare
                 ELSE estimated_fare END'));
         $agentTripIncomeMonth = TripHistory::where('trip_type', 'agent_create_trip')
             ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
             ->sum(DB::raw('CASE 
                 WHEN fare_received_status = 0 THEN calculated_fare
                 ELSE estimated_fare END'));

         $totalIncomeMonth = $requestTripIncomeMonth + $manualTripIncomeMonth + $agentTripIncomeMonth;

       $company = User::where('role','company')->with('drivers', 'cars','commissions')->get();
       return view('admin.pages.commission.profitList',compact('company','totalIncome','totalIncomeToday','totalIncomeWeek','totalIncomeMonth'));
    }


    public function earningProfit($companyId)
    {
        $companies = User::where('role','company')->get();
        $company = User::find($companyId);
        $trips = TripHistory::where('company_id', $companyId)->with('passenger','driver')->get();
        $totalEarnings = $trips->sum(function($trip) {
            return $trip->fare_received_status == 0 ? $trip->calculated_fare : $trip->estimated_fare;
        });

        $commissionRate = CompanyCommission::where('company_id', $companyId)->value('commission_percentage');
        $adminEarnings = $totalEarnings * ($commissionRate / 100);

        return view('admin.pages.commission.profitDetails', compact('company', 'trips', 'totalEarnings', 'adminEarnings', 'commissionRate', 'companies'));
    }
}
