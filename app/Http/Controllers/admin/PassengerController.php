<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Passenger;use Illuminate\Http\Request;

class PassengerController extends Controller
{
       public function index()
       {
           try {
               $passenger = Passenger::latest()->get();
               return view('admin.pages.passenger.index', compact('passenger'));
           } catch (\Exception $e) {
               return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
           }
       }
}
