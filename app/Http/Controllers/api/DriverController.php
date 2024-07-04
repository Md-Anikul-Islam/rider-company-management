<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\CarOrFleet;
use App\Models\Driver;
use App\Models\DriverRating;
use App\Models\DriverRatting;
use App\Models\TripHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;use Illuminate\Support\Facades\File;
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
                // First, check if the old password is correct
                $driver = Driver::find($request->user()->id);

                if (!$driver) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Driver not found'
                    ], 404);
                }

                if (!Hash::check($request->old_password, $driver->password)) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'The old password is incorrect'
                    ], 400);
                }
                // If the old password is correct, validate the new password and confirm password
                $request->validate([
                    'new_password' => 'required',
                    'confirm_password' => 'required|same:new_password',
                ], [
                    'confirm_password.same' => 'The confirmation password does not match the new password.',
                ]);

                // Update the password if validation passes
                $driver->password = Hash::make($request->new_password);
                $driver->save();

                return response()->json(['message' => 'Password changed successfully']);
            } catch (\Illuminate\Validation\ValidationException $e) {
                return response()->json([
                    'status' => 'error',
                    'message' => $e->validator->errors()->first()
                ], 400);
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
                $trip = TripHistory::where('driver_id', $request->user()->id)->with('passenger','driver.car')->get();
                if ($trip->isEmpty())
                {
                   return response()->json(['trips' => null]);
                }
                return response()->json(['trips' => $trip]);
            } catch (\Exception $e) {
                Log::error('Error fetching driver trip history: ' . $e->getMessage());
                return response()->json([
                    'status' => 'error',
                    'message' => 'An error occurred while fetching the trip history'
                ], 500);
            }
        }


        public function driverSpecificTripHistory(Request $request,$tripId)
        {
            try {
                $baseUrl = url('/');
                $trip = TripHistory::where('id',$tripId)->with('driver','driver.car','passenger')->first();
                if ($trip)
                {
                   $trip->link = $baseUrl . '/get-specific-trip-history-verify/' . encrypt($trip->id);
                }
                if(!$trip)
                {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Trip not found'
                    ], 404);
                }

                return response()->json(['trip' => $trip]);
            } catch (\Exception $e) {
                Log::error('Error fetching driver trip history: ' . $e->getMessage());
                return response()->json([
                    'status' => 'error',
                    'message' => 'An error occurred while fetching the trip history'
                ], 500);
            }
        }

        public function confirmDriverLoginDevice(Request $request)
        {
            try {
                $request->validate([
                    'device_information' => 'required',
                ]);
                $driver = auth()->user();
                if (!$driver) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Driver not found'
                    ], 404);
                }

                $driver->status = 'active';
                $driver->device_information = $request->device_information;
                $driver->save();

                return response()->json(['message' => 'Driver status and device information updated successfully']);
            } catch (\Exception $e) {
                \Log::error('Error updating driver status: ' . $e->getMessage());
                return response()->json([
                    'status' => 'error',
                    'message' => 'An error occurred while updating the driver status'
                ], 500);
            }
        }





}
