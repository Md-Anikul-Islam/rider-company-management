<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\TripHistory;use Illuminate\Http\Request;use Illuminate\Support\Facades\DB;

class TripHistoryController extends Controller
{
//    public function allTripHistory()
//    {
//        $trip = TripHistory::with('passenger')->paginate(50);
//
//        $totalIncome = TripHistory::sum(DB::raw('CASE
//                WHEN fare_received_status = 0 THEN calculated_fare
//                WHEN fare_received_status = 1 THEN estimated_fare
//                ELSE 0
//            END'));
//        return view('admin.pages.tripHistory.allTripHistory', compact('trip', 'totalIncome'));
//    }

    public function allTripHistory(Request $request)
    {
        // Fetch the filter value from the request
        $filter = $request->input('filter');

        // Initialize the query builder for TripHistory
        $tripQuery = TripHistory::with('passenger');

        // Apply filter if a filter value is provided
        if (!empty($filter)) {
            if ($filter == 'request_trip') {
                $tripQuery->where('trip_type', 'request_trip');
            } elseif ($filter == 'manual_trip') {
                $tripQuery->where('trip_type', 'manual_trip');
            } elseif ($filter == 'agent_create_trip') {
                $tripQuery->where('trip_type', 'agent_create_trip');
            }
        }

        // Paginate the filtered or unfiltered results
        $trip = $tripQuery->paginate(50);

        // Calculate the total income
        $totalIncome = TripHistory::sum(DB::raw('CASE 
                WHEN fare_received_status = 0 THEN calculated_fare 
                WHEN fare_received_status = 1 THEN estimated_fare 
                ELSE 0 
            END'));

        // Return the view with the filtered trip history and total income
        return view('admin.pages.tripHistory.allTripHistory', compact('trip', 'totalIncome'));
    }

    public function requestTripHistory()
    {
        $trip = TripHistory::where('trip_type','request_trip')->with('passenger')->paginate(50);
        return view('admin.pages.tripHistory.requestTripHistory', compact('trip'));
    }

    public function manualTripHistory()
    {
        $trip = TripHistory::where('trip_type','manual_trip')->with('passenger')->paginate(50);
        return view('admin.pages.tripHistory.manualTripHistory', compact('trip'));
    }

    public function agentTripHistory()
    {
        $trip = TripHistory::where('trip_type','agent_create_trip')->with('passenger')->paginate(50);
        return view('admin.pages.tripHistory.agentTripHistory', compact('trip'));
    }
}
