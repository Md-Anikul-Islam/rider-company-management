<?php

namespace App\Http\Controllers;

use App\Models\TripHistory;use Illuminate\Contracts\Encryption\DecryptException;use Illuminate\Http\Request;

class TripVerifyController extends Controller
{
       public function driverSpecificTripHistory($encryptedId)
       {
           try {
                $id = decrypt($encryptedId);
                $tripVerify = TripHistory::where('id',$id)->with('driver.car','passenger','company')->first();
//dd($tripVerify);
                return view('trip-verify',compact('tripVerify'));

           } catch (DecryptException $e) {
               return response()->json(['error' => 'Invalid encrypted ID'], 400);
           }
       }
}
