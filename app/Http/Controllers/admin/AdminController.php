<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Agent;use App\Models\Coupon;use App\Models\Driver;use App\Models\FleetType;use App\Models\Passenger;use App\Models\Toll;use App\Models\TripHistory;use App\Models\User;
use Carbon\Carbon;use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class AdminController extends Controller
{
    public function index()
    {
        $companies = User::where('role', 'company')->get();
        $totalCompanies = $companies->count();
        $totalPassengers = Passenger::count();
        $totalDrivers = Driver::count();
        $totalAgents = Agent::count();
        $totalCoupon = Coupon::count();
        $toll = Toll::count();
        $trip = TripHistory::count();
        $fleetType = FleetType::count();

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




        return view('admin.dashboard', compact('companies', 'totalCompanies',
        'totalPassengers', 'totalDrivers', 'totalAgents',
        'totalCoupon', 'toll', 'trip', 'fleetType',
        'totalIncome', 'totalIncomeToday', 'totalIncomeWeek', 'totalIncomeMonth'
        ));
    }


}
