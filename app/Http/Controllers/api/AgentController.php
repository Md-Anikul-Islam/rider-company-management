<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Agent;use Illuminate\Http\Request;use Illuminate\Support\Facades\Hash;

class AgentController extends Controller
{
       public function agentLogin(Request $request)
       {
           try {
               $request->validate([
                   'phone' => 'required|digits_between:10,15',
                   'password' => 'required',
               ]);

               $agent = Agent::where('phone', $request->phone)->first();
               if (!$agent) {
                   return response()->json([
                       'message' => 'Invalid phone number',
                   ], 401);
               }

               if (!Hash::check($request->password, $agent->password)) {
                   return response()->json([
                       'message' => 'Incorrect password',
                   ], 401);
               }
               // Check if the company status is inactive
               if ($agent->status === 'inactive') {
                   return response()->json([
                       'message' => 'You cannot login. Please contact administration.',
                   ], 403);
               }
               // If both phone and password are correct, create token for authentication
               $token = $agent->createToken('token-name')->plainTextToken;
               return response()->json([
                   'message' => 'Agent Login Successful',
                   'token' => $token,
                   'driver' => $agent,
               ]);
           } catch (\Exception $e) {
               return response()->json([
                   'message' => 'An error occurred',
                   'error' => $e->getMessage(),
               ], 500);
           }
       }


       public function agentProfile(Request $request)
       {
              try {
                   $agent = Agent::where('id', $request->user()->id)->first();
                   return response()->json([
                       'agent' => $agent,
                   ]);
               } catch (\Exception $e) {
                   return response()->json([
                       'message' => 'An error occurred',
                       'error' => $e->getMessage(),
                   ], 500);
               }
       }

}
