<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\CarOrFleet;use App\Models\Driver;use App\Models\FleetType;use Illuminate\Http\Request;use Illuminate\Support\Facades\Auth;use Illuminate\Support\Facades\Log;

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

       public function carOrFleetType()
       {
           try {
               //$carOrFleetTypes  = CarOrFleet::pluck('name')->toArray();
               $carOrFleetTypes  = FleetType::latest()->get();
               return response()->json($carOrFleetTypes, 200);
           } catch (\Exception $e) {
               return response()->json(['error' => 'An error occurred while fetching data.'], 500);
           }
       }

      public function carOrFleetForPassenger()
      {
            try {
                $carOrFleetTypes  = FleetType::pluck('name')->toArray();
                return response()->json($carOrFleetTypes, 200);
            } catch (\Exception $e) {
                return response()->json(['error' => 'An error occurred while fetching data.'], 500);
            }
      }

        public function carOrFleetAllForPassenger(Request $request)
        {
            try {
                $cars = CarOrFleet::with(['fleetType', 'fleetMake', 'fleetModel'])
                    ->get()
                    ->map(function ($item) {
                        return [
                            'id' => $item->id,
                            'company_id' => $item->company_id,
                            'fleet_type_id' => $item->fleet_type_id,
                            'fleet_make_id' => $item->fleet_make_id,
                            'fleet_model_id' => $item->fleet_model_id,
                            'car_image' => $item->car_image,
                            'plate_no' => $item->plate_no,
                            'car_name' => $item->car_name,
                            'year' => $item->year,
                            'car_color' => $item->car_color,
                            'car_register_card' => $item->car_register_card,
                            'is_selected' => $item->is_selected,
                            'status' => $item->status,
                            'created_at' => $item->created_at,
                            'updated_at' => $item->updated_at,
                            'car_type' => $item->fleetType->name,
                            'car_make' => $item->fleetMake->car_make_name,
                            'car_model' => $item->fleetModel->car_model_name,
                        ];
                    })
                    ->groupBy('fleet_model_id')
                    ->map(function ($group) {
                        return $group->first(); // Select the first item from each group
                    })
                    ->values();

                return response()->json([
                    'status' => 'success',
                    'cars' => $cars
                ]);
            } catch (\Exception $e) {
                Log::error('Error retrieving cars: ' . $e->getMessage());
                return response()->json([
                    'status' => 'error',
                    'message' => 'An error occurred while retrieving cars'
                ], 500);
            }
        }

}
