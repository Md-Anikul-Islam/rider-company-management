<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\CarOrFleet;use App\Models\Driver;use Illuminate\Http\Request;use Illuminate\Support\Facades\Auth;use Illuminate\Support\Facades\Log;

class CarOrFleetController extends Controller
{
       public function carOrFleetAll(Request $request)
       {
           try {

               $driver = Driver::where('id', $request->user()->id)->first();
               if ($driver && $driver->company_id) {
                   $cars = CarOrFleet::where('company_id', $driver->company_id)->get();
                   return response()->json([
                       'status' => 'success',
                       'cars' => $cars
                   ]);
               }
               return response()->json([
                   'status' => 'error',
                   'message' => 'Driver not found or does not belong to a company'
               ], 404);
           } catch (\Exception $e) {
               Log::error('Error retrieving cars: ' . $e->getMessage());
               return response()->json([
                   'status' => 'error',
                   'message' => 'An error occurred while retrieving cars'
               ], 500);
           }
       }

       public function carOrFleetUnselected(Request $request)
       {
          try {

              $driver = Driver::where('id', $request->user()->id)->first();
              if ($driver && $driver->company_id) {
                  $cars = CarOrFleet::where('company_id', $driver->company_id)->where('is_selected','no')->get();
                  return response()->json([
                      'status' => 'success',
                      'cars' => $cars
                  ]);
              }
              return response()->json([
                  'status' => 'error',
                  'message' => 'Driver not found or does not belong to a company'
              ], 404);
          } catch (\Exception $e) {
              Log::error('Error retrieving cars: ' . $e->getMessage());
              return response()->json([
                  'status' => 'error',
                  'message' => 'An error occurred while retrieving cars'
              ], 500);
          }
       }
}
