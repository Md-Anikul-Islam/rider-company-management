<?php

namespace App\Http\Controllers\company;

use App\Http\Controllers\Controller;
use App\Models\TripHistory;use Illuminate\Http\Request;

class TripController extends Controller
{
        public function allTripHistoryUnderCompany()
        {
            $trip = TripHistory::where('company_id',auth()->user()->id)->with('passenger')->paginate(50);
            return view('company.pages.companyTripHistory.allTripHistory', compact('trip'));
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
