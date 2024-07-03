<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\CarOrFleet;
use App\Models\Driver;
use App\Models\DriverRating;
use App\Models\DriverRatting;
use App\Models\TripHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class DriverController extends Controller
{
        public function driverLogin(Request $request)
        {
            try {
                $request->validate([
                    'phone' => 'required|digits_between:10,15',
                    'password' => 'required',
                ]);

                $driver = Driver::where('phone', $request->phone)->with('company', 'car.fleetType')->first();

                if (!$driver) {
                    return response()->json([
                        'message' => 'Invalid phone number',
                    ], 401);
                }

                if (!Hash::check($request->password, $driver->password)) {
                    return response()->json([
                        'message' => 'Incorrect password',
                    ], 401);
                }

                // If both phone and password are correct, create token for authentication
                $token = $driver->createToken('token-name')->plainTextToken;

                // Include the fleet type name in the car details
                if($driver->car){
                  $driver->car->fleet_type_name = $driver->car->fleetType->name;
                }


                return response()->json([
                    'message' => 'Driver Login Successful',
                    'token' => $token,
                    'driver' => $driver,
                ]);

            } catch (\Exception $e) {
                return response()->json([
                    'message' => 'An error occurred',
                    'error' => $e->getMessage(),
                ], 500);
            }
        }



        public function driverProfile(Request $request)
        {
               try {
                    $driver = Driver::where('id', $request->user()->id)->with('company','car.fleetType')->first();
                    if($driver->car)
                    {
                       $driver->car->fleet_type_name = $driver->car->fleetType->name;
                    }
                    return response()->json([
                        'driver' => $driver,
                    ]);
                } catch (\Exception $e) {
                    return response()->json([
                        'message' => 'An error occurred',
                        'error' => $e->getMessage(),
                    ], 500);
                }
        }

        public function driverProfileUpdate(Request $request)
        {
            try {
                $driver = Driver::where('id', $request->user()->id)->with('company','car.fleetType')->first();
                $request->validate([
                    'profile' => 'required|image',
                ]);
                if ($request->hasFile('profile')) {
                    // Delete the old profile image if it exists
                    if (File::exists(public_path($driver->profile))) {
                        File::delete(public_path($driver->profile));
                    }
                    $image = $request->file('profile');
                    $imageName = time() . '_' . $image->getClientOriginalName();
                    $image->move(public_path('images/profile'), $imageName);
                    $driver->profile = 'images/profile/' . $imageName;
                }
                $driver->save();
                if($driver->car)
                {
                    $driver->car->fleet_type_name = $driver->car->fleetType->name;
                }

                return response()->json(['message' => 'Profile updated successfully', 'driver' => $driver]);

            } catch (\Exception $e) {
                Log::error('Error updating profile: ' . $e->getMessage());
                return response()->json([
                    'status' => 'error',
                    'message' => 'An error occurred while updating the profile'
                ], 500);
            }
        }


        public function assignCarToDriver(Request $request)
        {
            try {
                // Validate the request
                $request->validate([
                    'car_id' => 'required|exists:car_or_fleets,id',
                ]);
                // Get the authenticated driver
                $driver = Driver::where('id', $request->user()->id)->with('company', 'car.fleetType')->first();
                // Ensure the car belongs to the same company as the driver
                $car = CarOrFleet::where('id', $request->car_id)
                    ->where('company_id', $driver->company_id)
                    ->first();
                if (!$car) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Car not found or does not belong to the same company as the driver'
                    ], 404);
                }
                // Check if the car is already assigned to the driver
                if ($driver->car_id == $request->car_id) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'You have already booked this car'
                    ], 400);
                }
                // Update the previously assigned car's is_selected to 'no'
                if ($driver->car_id) {
                    CarOrFleet::where('id', $driver->car_id)->update(['is_selected' => 'no']);
                }
                // Assign the new car to the driver and update its is_selected to 'yes'
                $driver->car_id = $request->car_id;
                $driver->save();

                $car->is_selected = 'yes';
                $car->save();
                // Reload the driver's relations to reflect the updated car information
                $driver->load('company', 'car');

                if($driver->car)
                {
                    $driver->car->fleet_type_name = $driver->car->fleetType->name;
                }

                return response()->json(['message' => 'Car assigned successfully', 'driver' => $driver]);
            } catch (\Exception $e) {
                Log::error('Error assigning car to driver: ' . $e->getMessage());
                return response()->json([
                    'status' => 'error',
                    'message' => 'An error occurred while assigning the car to the driver'
                ], 500);
            }
        }


        public function driverChangePassword(Request $request)
        {
            try {
                $request->validate([
                    'old_password' => 'required',
                    'new_password' => 'required',
                    'confirm_password' => 'required|same:new_password',
                ]);
                $driver = Driver::where('id', $request->user()->id)->first();
                if (!Hash::check($request->old_password, $driver->password)) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'The old password is incorrect'
                    ], 400);
                }
                $driver->password = Hash::make($request->new_password);
                $driver->save();
                return response()->json(['message' => 'Password changed successfully']);
            } catch (\Exception $e) {
                Log::error('Error changing password: ' . $e->getMessage());
                return response()->json([
                    'status' => 'error',
                    'message' => 'An error occurred while changing the password'
                ], 500);
            }
        }


        public function driverRatting(Request $request)
        {
            $request->validate([
                'driver_id' => 'required',
                'ratting' => 'required|numeric|min:1|max:5',
            ]);
            $passengerId = $request->user()->id;
            // Save the rating
            $driverRating = new DriverRating();
            $driverRating->driver_id = $request->driver_id;
            $driverRating->passenger_id = $passengerId;
            $driverRating->ratting = $request->ratting;
            $driverRating->save();

            // Calculate average rating for the driver
            $driverId = $request->driver_id;

            $ratings = DriverRating::where('driver_id', $driverId)->pluck('ratting');
            $totalRatings = count($ratings);
            $totalSum = $ratings->sum();
            $averageRating = $totalRatings > 0 ? $totalSum / $totalRatings : 0;

            //Update the driver's total rating in the Driver table
            $driver = Driver::where('id', $driverId)->first();
            if ($driver) {
                $driver->ratting = $averageRating;
                $driver->save();
            }
            return response()->json(['ratting' => $averageRating], 200);
        }


        public function driverTripHistory(Request $request)
        {
            try {
                $trip = TripHistory::where('driver_id', $request->user()->id)->with('passenger')->get();
                return response()->json(['trips' => $trip]);
            } catch (\Exception $e) {
                Log::error('Error fetching driver trip history: ' . $e->getMessage());
                return response()->json([
                    'status' => 'error',
                    'message' => 'An error occurred while fetching the trip history'
                ], 500);
            }
        }

}
