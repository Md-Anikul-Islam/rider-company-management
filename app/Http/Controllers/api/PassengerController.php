<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Passenger;
use App\Models\TripHistory;use Carbon\Carbon;use Illuminate\Support\Facades\Crypt;use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class PassengerController extends Controller
{

//        public function registerPassenger(Request $request)
//        {
//            $validator = Validator::make($request->all(), [
//                'name' => 'required|string|max:255',
//                'phone' => 'string|max:20|unique:passengers,phone',
//                'password' => 'required|string|min:8',
//            ]);
//
//            if ($validator->fails()) {
//                return response()->json([
//                    'errors' => $validator->errors()
//                ], 422);
//            }
//
//            try {
//                $passenger = Passenger::create([
//                    'name' => $request->name,
//                    'email' => $request->email ?? null,
//                    'phone' => $request->phone,
//                    'password' => Hash::make($request->password),
//                    'is_apple' => $request->is_apple ?? 0,
//                ]);
//
//                $token = $passenger->createToken('passenger-token')->plainTextToken;
//
//                return response()->json([
//                    'message' => 'Passenger registered successfully',
//                    'token' => $token,
//                    'passenger' => [
//                        'id' => $passenger->id,
//                        'name' => $passenger->name,
//                        'email' => $passenger->email,
//                        'phone' => $passenger->phone,
//                        'profile' => $passenger->profile,
//                        'is_apple' => $passenger->is_apple,
//                        'status' => $passenger->status ?? 'active',
//                        'created_at' => $passenger->created_at,
//                        'updated_at' => $passenger->updated_at,
//                    ]
//                ], 201);
//            } catch (\Exception $e) {
//                return response()->json([
//                    'error' => 'An error occurred while registering the passenger'
//                ], 500);
//            }
//        }


        public function registerPassenger(Request $request)
        {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'phone' => 'nullable|string|max:20|unique:passengers,phone',
                'email' => 'nullable|string|email|max:255|unique:passengers,email',
                'password' => 'required|string|min:8',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors()
                ], 422);
            }

            if (!$request->phone && !$request->email) {
                return response()->json([
                    'errors' => ['phone' => 'Either phone or email is required.']
                ], 422);
            }

            try {
                $passenger = Passenger::create([
                    'name' => $request->name,
                    'email' => $request->email ?? null,
                    'phone' => $request->phone ?? null,
                    'password' => Hash::make($request->password),
                    'is_apple' => $request->is_apple ?? 0,
                ]);

                $token = $passenger->createToken('passenger-token')->plainTextToken;

                return response()->json([
                    'message' => 'Passenger registered successfully',
                    'token' => $token,
                    'passenger' => [
                        'id' => $passenger->id,
                        'name' => $passenger->name,
                        'email' => $passenger->email,
                        'phone' => $passenger->phone,
                        'profile' => $passenger->profile,
                        'is_apple' => $passenger->is_apple,
                        'status' => $passenger->status ?? 'active',
                        'created_at' => $passenger->created_at,
                        'updated_at' => $passenger->updated_at,
                    ]
                ], 201);
            } catch (\Exception $e) {
                return response()->json([
                    'error' => 'An error occurred while registering the passenger'
                ], 500);
            }
        }

//        public function passengerLogin(Request $request)
//        {
//            try {
//                $validator = Validator::make($request->all(), [
//                    'phone' => 'required|string|max:20',
//                    'password' => 'required|string|min:8',
//                ]);
//
//                if ($validator->fails()) {
//                    return response()->json([
//                        'errors' => $validator->errors()
//                    ], 422);
//                }
//
//                $passenger = Passenger::where('phone', $request->phone)->first();
//
//                if (!$passenger || !Hash::check($request->password, $passenger->password)) {
//                    return response()->json([
//                        'error' => 'Invalid phone or password'
//                    ], 401);
//                }
//
//                $token = $passenger->createToken('passenger-token')->plainTextToken;
//
//                return response()->json([
//                    'message' => 'Passenger logged in successfully',
//                    'token' => $token,
//                    'passenger' => [
//                        'id' => $passenger->id,
//                        'name' => $passenger->name,
//                        'email' => $passenger->email,
//                        'phone' => $passenger->phone,
//                        'profile' => $passenger->profile,
//                        'is_apple' => $passenger->is_apple,
//                        'status' => $passenger->status ?? 'active',
//                        'created_at' => $passenger->created_at,
//                        'updated_at' => $passenger->updated_at,
//                    ]
//                ], 200);
//            } catch (\Exception $e) {
//                return response()->json([
//                    'error' => 'An error occurred while processing your request. Please try again later.',
//                    'message' => $e->getMessage()
//                ], 500);
//            }
//        }

        public function passengerLogin(Request $request)
        {
            try {
                $validator = Validator::make($request->all(), [
                    'credential' => 'required|string|max:255',
                    'password' => 'required|string|min:8',
                ]);

                if ($validator->fails()) {
                    return response()->json([
                        'errors' => $validator->errors()
                    ], 422);
                }

                $credential = $request->input('credential');
                $password = $request->input('password');

                // Check if the credential is an email or a phone number
                $isEmail = filter_var($credential, FILTER_VALIDATE_EMAIL);

                $passenger = Passenger::when($isEmail, function ($query) use ($credential) {
                        return $query->where('email', $credential);
                    })
                    ->when(!$isEmail, function ($query) use ($credential) {
                        return $query->where('phone', $credential);
                    })
                    ->first();

                if (!$passenger) {
                    $errorMessage = $isEmail ? 'The email under had no account' : 'The phone number under had no account';
                    return response()->json([
                        'error' => $errorMessage
                    ], 401);
                }

                if (!Hash::check($password, $passenger->password)) {
                    return response()->json([
                        'error' => 'The password is incorrect'
                    ], 401);
                }

                $token = $passenger->createToken('passenger-token')->plainTextToken;

                return response()->json([
                    'message' => 'Passenger logged in successfully',
                    'token' => $token,
                    'passenger' => [
                        'id' => $passenger->id,
                        'name' => $passenger->name,
                        'email' => $passenger->email,
                        'phone' => $passenger->phone,
                        'profile' => $passenger->profile,
                        'is_apple' => $passenger->is_apple,
                        'status' => $passenger->status ?? 'active',
                        'created_at' => $passenger->created_at,
                        'updated_at' => $passenger->updated_at,
                    ]
                ], 200);
            } catch (\Exception $e) {
                return response()->json([
                    'error' => 'An error occurred while processing your request. Please try again later.',
                    'message' => $e->getMessage()
                ], 500);
            }
        }


        public function passengerProfile(Request $request)
        {
               try {
                    $passenger = Passenger::where('id', $request->user()->id)->first();
                    return response()->json([
                        'passenger' => $passenger,
                    ]);
                } catch (\Exception $e) {
                    return response()->json([
                        'message' => 'An error occurred',
                        'error' => $e->getMessage(),
                    ], 500);
                }
        }

          public function updatePassengerProfile(Request $request)
          {
              try {
                  $passenger = Passenger::findOrFail($request->user()->id);

                  $validator = Validator::make($request->all(), [
                      'name' => 'sometimes|max:255',
                      'email' => 'sometimes|max:255|',
                      'profile' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                  ]);

                  if ($validator->fails()) {
                      return response()->json([
                          'errors' => $validator->errors()
                      ], 422);
                  }

                  if ($request->has('name')) {
                      $passenger->name = $request->name;
                  }

                  if ($request->has('email')) {
                      $passenger->email = $request->email;
                  }

                  if ($request->hasFile('profile')) {
                      // Delete the old profile picture if it exists
                      if ($passenger->profile && File::exists(public_path($passenger->profile))) {
                          File::delete(public_path($passenger->profile));
                      }

                      $profileImage = $request->file('profile');
                      $profileImageName = time() . '_' . $profileImage->getClientOriginalName();
                      $profileImage->move(public_path('images/profileUser'), $profileImageName);
                      $passenger->profile = 'images/profileUser/' . $profileImageName;
                  }

                  $passenger->save();

                  return response()->json([
                      'message' => 'Profile updated successfully',
                      'passenger' => $passenger
                  ], 200);
              } catch (\Exception $e) {
                  Log::error('Error updating profile: ' . $e->getMessage());
                  return response()->json([
                      'status' => 'error',
                      'message' => 'An error occurred while updating the profile'
                  ], 500);
              }
          }

          public function passengerChangePassword(Request $request)
          {
              try {
                  $request->validate([
                      'old_password' => 'required',
                      'new_password' => 'required',
                      'confirm_password' => 'required|same:new_password',
                  ]);
                  $passenger = Passenger::where('id', $request->user()->id)->first();
                  if (!Hash::check($request->old_password, $passenger->password)) {
                      return response()->json([
                          'status' => 'error',
                          'message' => 'The old password is incorrect'
                      ], 400);
                  }
                  $passenger->password = Hash::make($request->new_password);
                  $passenger->save();
                  return response()->json(['message' => 'Password changed successfully']);
              } catch (\Exception $e) {
                  Log::error('Error changing password: ' . $e->getMessage());
                  return response()->json([
                      'status' => 'error',
                      'message' => 'An error occurred while changing the password'
                  ], 500);
              }
          }



//          public function passengerTripHistory(Request $request)
//          {
//              try {
//                  $trip = TripHistory::where('passenger_id', $request->user()->id)->with('driver.car')->get();
//                  return response()->json(['trips' => $trip]);
//              } catch (\Exception $e) {
//                  Log::error('Error fetching driver trip history: ' . $e->getMessage());
//                  return response()->json([
//                      'status' => 'error',
//                      'message' => 'An error occurred while fetching the trip history'
//                  ], 500);
//              }
//          }

            public function passengerTripHistory(Request $request)
            {
                try {
                    $baseUrl = url('/');
                    $perPage = 10; // Define how many items you want per page

                    $trips = TripHistory::where('passenger_id', $request->user()->id)
                                        ->with('driver.car')
                                        ->paginate($perPage)
                                        ->through(function ($trip) use ($baseUrl) {
                                            $pickTime = Carbon::parse($trip->pick_time);
                                            $dropTime = Carbon::parse($trip->drop_time);
                                            $duration = $pickTime->diffInMinutes($dropTime);
                                            $trip->duration = gmdate('H:i', $duration * 60); // Convert minutes to HH:MM format
                                            $trip->link = $baseUrl . '/get-specific-trip-history-verify/' . Crypt::encrypt($trip->id);
                                            return $trip;
                                        });

                    return response()->json($trips);
                } catch (\Exception $e) {
                    Log::error('Error fetching passenger trip history: ' . $e->getMessage());
                    return response()->json([
                        'status' => 'error',
                        'message' => 'An error occurred while fetching the trip history'
                    ], 500);
                }
            }

            public function passengerSpecificTripHistory(Request $request, $tripId)
            {
                try {
                    $baseUrl = url('/');
                    $trip = TripHistory::where('id', $tripId)
                                       ->where('passenger_id', $request->user()->id)
                                       ->with('driver.car')
                                       ->first();

                    if ($trip) {
                        // Calculate duration
                        $pickTime = Carbon::parse($trip->pick_time);
                        $dropTime = Carbon::parse($trip->drop_time);
                        $duration = $pickTime->diffInMinutes($dropTime);
                        $trip->duration = gmdate('H:i', $duration * 60); // Convert minutes to HH:MM format

                        // Add link
                        $trip->link = $baseUrl . '/get-specific-trip-history-verify/' . Crypt::encrypt($trip->id);
                    } else {
                        return response()->json([
                            'status' => 'error',
                            'message' => 'Trip not found'
                        ], 404);
                    }

                    return response()->json(['trip' => $trip]);
                } catch (\Exception $e) {
                    Log::error('Error fetching passenger trip history: ' . $e->getMessage());
                    return response()->json([
                        'status' => 'error',
                        'message' => 'An error occurred while fetching the trip history'
                    ], 500);
                }
            }


}
