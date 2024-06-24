<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Driver;use Illuminate\Http\Request;use Illuminate\Support\Facades\Hash;

class DriverController extends Controller
{
     public function driverLogin(Request $request)
        {
            try {
                $request->validate([
                    'phone' => 'required|digits_between:10,15',
                    'password' => 'required',
                ]);
                $driver = Driver::where('phone', $request->phone)->with('company','car')->first();
                if ($driver && Hash::check($request->password, $driver->password)) {
                    // Create token for the authenticated driver
                    $token = $driver->createToken('token-name')->plainTextToken;
                    return response()->json([
                        'token' => $token,
                        'driver' => $driver,
                    ]);
                }
                return response()->json([
                    'message' => 'Invalid credentials',
                ], 401);
            } catch (\Exception $e) {
                return response()->json([
                    'message' => 'An error occurred',
                    'error' => $e->getMessage(),
                ], 500);
            }
        }

}
