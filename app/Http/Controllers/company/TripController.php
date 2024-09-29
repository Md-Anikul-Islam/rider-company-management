<?php

namespace App\Http\Controllers\company;

use App\Http\Controllers\Controller;
use App\Models\TripHistory;use Illuminate\Http\Request;use Illuminate\Support\Facades\DB;

class TripController extends Controller
{
//        public function allTripHistoryUnderCompany()
//        {
//            $trip = TripHistory::where('company_id',auth()->user()->id)->with('passenger')->paginate(50);
//            $totalIncome = TripHistory::where('company_id',auth()->user()->id)->sum(DB::raw('CASE
//                    WHEN fare_received_status = 0 THEN calculated_fare
//                    WHEN fare_received_status = 1 THEN estimated_fare
//                    ELSE 0
//                END'));
//            return view('company.pages.companyTripHistory.allTripHistory', compact('trip','totalIncome'));
//        }

           public function allTripHistoryUnderCompany(Request $request)
            {
                // Fetch the filter value from the request
                $filter = $request->input('filter');

                // Initialize the query builder for TripHistory
                $tripQuery = TripHistory::where('company_id',auth()->user()->id)->with('passenger');

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
               return view('company.pages.companyTripHistory.allTripHistory', compact('trip','totalIncome'));
            }




        public function requestTripHistoryUnderCompany()
        {
            $trip = TripHistory::where('company_id',auth()->user()->id)->where('trip_type','request_trip')->with('passenger')->paginate(50);
            return view('company.pages.companyTripHistory.requestTripHistory', compact('trip'));
        }

        public function manualTripHistoryUnderCompany()
        {
            $trip = TripHistory::where('company_id',auth()->user()->id)->where('trip_type','manual_trip')->with('passenger')->paginate(50);
            return view('company.pages.companyTripHistory.manualTripHistory', compact('trip'));
        }

        public function agentTripHistoryUnderCompany()
        {
            $trip = TripHistory::where('company_id',auth()->user()->id)->where('trip_type','agent_create_trip')->with('passenger')->paginate(50);
            return view('company.pages.companyTripHistory.agentTripHistory', compact('trip'));
        }
}
