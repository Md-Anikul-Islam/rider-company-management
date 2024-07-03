<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Agent;use App\Models\Driver;use App\Models\Passenger;use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $companies = User::where('role', 'company')->get();
        $totalCompanies = $companies->count();
        $totalPassengers = Passenger::count();
        $totalDrivers = Driver::count();
        $totalAgents = Agent::count();
        return view('admin.dashboard', compact('companies', 'totalCompanies', 'totalPassengers', 'totalDrivers', 'totalAgents'));
    }


}
