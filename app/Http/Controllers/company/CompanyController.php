<?php

namespace App\Http\Controllers\company;

use App\Http\Controllers\Controller;
use App\Models\CarOrFleet;use App\Models\Driver;use App\Models\TripHistory;use App\Models\User;
use Carbon\Carbon;use Illuminate\Http\Request;use Illuminate\Support\Facades\DB;

class CompanyController extends Controller
{
    public function index()
    {
        $company = auth()->user();

        $totalCar = CarOrFleet::where('company_id', $company->id)->count();
        $totalDriver = Driver::where('company_id', $company->id)->count();
        $totalTrip = TripHistory::where('company_id', $company->id)->count();

        // Total income
        $requestTripIncome = TripHistory::where('company_id', $company->id)->where('trip_type', 'request_trip')->sum('calculated_fare');
        // Sum for manual_trip based on fare_received_status condition
        $manualTripIncome = TripHistory::where('company_id', $company->id)->where('trip_type', 'manual_trip')->sum(DB::raw('CASE 
                WHEN fare_received_status = 0 THEN calculated_fare
                ELSE estimated_fare END'));

        $agentTripIncome = TripHistory::where('company_id', $company->id)->where('trip_type', 'agent_create_trip')
            ->sum(DB::raw('CASE 
                WHEN fare_received_status = 0 THEN calculated_fare
                ELSE estimated_fare
            END'));
        $totalIncome = $requestTripIncome + $manualTripIncome + $agentTripIncome;


        // Today income
        $startOfToday = Carbon::today()->startOfDay();
        $endOfToday = Carbon::today()->endOfDay();
        // Sum for request_trip where calculated_fare is always used
        $requestTripIncomeToday = TripHistory::where('company_id', $company->id)->where('trip_type', 'request_trip')
            ->whereBetween('created_at', [$startOfToday, $endOfToday])
            ->sum('calculated_fare');
        // Sum for manual_trip based on fare_received_status condition
        $manualTripIncomeToday = TripHistory::where('company_id', $company->id)->where('trip_type', 'manual_trip')
            ->whereBetween('created_at', [$startOfToday, $endOfToday])
            ->sum(DB::raw('CASE 
                WHEN fare_received_status = 0 THEN calculated_fare
                ELSE estimated_fare END'));
        // Sum for agent_create_trip based on fare_received_status condition
        $agentTripIncomeToday = TripHistory::where('company_id', $company->id)->where('trip_type', 'agent_create_trip')
            ->whereBetween('created_at', [$startOfToday, $endOfToday])
            ->sum(DB::raw('CASE 
                WHEN fare_received_status = 0 THEN calculated_fare
                ELSE estimated_fare END'));
        $totalIncomeToday = $requestTripIncomeToday + $manualTripIncomeToday + $agentTripIncomeToday;


        // Week income
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();
        $requestTripIncomeWeek = TripHistory::where('company_id', $company->id)->where('trip_type', 'request_trip')
            ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->sum('calculated_fare');
        $manualTripIncomeWeek = TripHistory::where('company_id', $company->id)->where('trip_type', 'manual_trip')
            ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->sum(DB::raw('CASE 
                WHEN fare_received_status = 0 THEN calculated_fare
                ELSE estimated_fare END'));
        $agentTripIncomeWeek = TripHistory::where('company_id', $company->id)->where('trip_type', 'agent_create_trip')
            ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->sum(DB::raw('CASE 
                WHEN fare_received_status = 0 THEN calculated_fare
                ELSE estimated_fare END'));
        $totalIncomeWeek = $requestTripIncomeWeek + $manualTripIncomeWeek + $agentTripIncomeWeek;


        // Month income
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();
        $requestTripIncomeMonth = TripHistory::where('company_id', $company->id)->where('trip_type', 'request_trip')
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->sum('calculated_fare');
        $manualTripIncomeMonth = TripHistory::where('company_id', $company->id)->where('trip_type', 'manual_trip')
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->sum(DB::raw('CASE 
                WHEN fare_received_status = 0 THEN calculated_fare
                ELSE estimated_fare END'));
        $agentTripIncomeMonth = TripHistory::where('company_id', $company->id)->where('trip_type', 'agent_create_trip')
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->sum(DB::raw('CASE 
                WHEN fare_received_status = 0 THEN calculated_fare
                ELSE estimated_fare END'));
        $totalIncomeMonth = $requestTripIncomeMonth + $manualTripIncomeMonth + $agentTripIncomeMonth;
        return view('company.dashboard', compact('company', 'totalCar', 'totalDriver', 'totalTrip', 'totalIncome', 'totalIncomeToday', 'totalIncomeWeek', 'totalIncomeMonth'));
    }

    public function show()
    {
        return view('company.pages.test');
    }
}
