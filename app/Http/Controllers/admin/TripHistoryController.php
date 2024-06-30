<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\TripHistory;use Illuminate\Http\Request;

class TripHistoryController extends Controller
{
    public function allTripHistory()
    {
        $trip = TripHistory::with('passenger')->paginate(50);
        return view('admin.pages.tripHistory.allTripHistory', compact('trip'));
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
}
