<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Driver;use App\Models\TripHistory;use Illuminate\Http\Request;use Illuminate\Support\Facades\Validator;

class TripHistoryController extends Controller
{
        public function storeTripHistory(Request $request)
        {
            $validator = Validator::make($request->all(), [
                'origin_address' => 'required|string|max:255',
                'destination_address' => 'required|string|max:255',
                'pick_time' => 'required',
                'passenger_name' => 'nullable|string|max:255',
                'passenger_phone' => 'nullable|string|max:255',
                'estimated_fare' => 'nullable|string|max:255',
                'calculated_fare' => 'required|string|max:255',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }
            try {
                $driver = Driver::where('id', $request->user()->id)->firstOrFail();
                $tripHistory = new TripHistory();
                $tripHistory->passenger_id = $request->input('passenger_id');
                $tripHistory->driver_id = $driver->id;
                $tripHistory->origin_address = $request->input('origin_address');
                $tripHistory->destination_address = $request->input('destination_address');
                $tripHistory->change_destination_address = $request->input('change_destination_address');
                $tripHistory->pick_time = $request->input('pick_time');
                $tripHistory->drop_time = $request->input('drop_time');
                $tripHistory->passenger_name = $request->input('passenger_name');
                $tripHistory->passenger_phone = $request->input('passenger_phone');
                $tripHistory->estimated_fare = $request->input('estimated_fare');
                $tripHistory->calculated_fare = $request->input('calculated_fare');
                $tripHistory->fare_received_status = $request->input('fare_received_status', 0);
                $tripHistory->trip_status = $request->input('trip_status', 'start');
                $tripHistory->trip_type = $request->input('trip_type', 'request_trip');
                $tripHistory->save();
                return response()->json(['message' => 'Trip history created successfully', 'data' => $tripHistory], 201);
            } catch (\Exception $e) {
                return response()->json(['error' => 'Failed to create trip history', 'message' => $e->getMessage()], 500);
            }
        }

     public function updateTripHistory(Request $request, $tripId)
     {
         // Validate the request inputs
         $validator = Validator::make($request->all(), [
             'change_destination_address' => 'nullable|string|max:255',
             'drop_time' => 'required_if:change_destination_address,true',
         ]);

         if ($validator->fails()) {
             return response()->json(['errors' => $validator->errors()], 422);
         }

         try {
             // Find the trip history record
             $tripHistory = TripHistory::findOrFail($tripId);

             // Check if the authenticated user is the driver associated with the trip history
             if ($request->user()->id !== $tripHistory->driver_id) {
                 return response()->json(['error' => 'Unauthorized. Only the driver associated with this trip history can update it.'], 403);
             }

             // Update specific fields if provided in the request
             if ($request->has('change_destination_address')) {
                 $tripHistory->change_destination_address = $request->input('change_destination_address');
             }

             if ($request->has('drop_time')) {
                 $tripHistory->drop_time = $request->input('drop_time');
             }

             // Save the updated trip history record
             $tripHistory->save();

             return response()->json(['message' => 'Trip history updated successfully', 'data' => $tripHistory], 200);
         } catch (\Exception $e) {
             return response()->json(['error' => 'Failed to update trip history', 'message' => $e->getMessage()], 500);
         }
     }


}
