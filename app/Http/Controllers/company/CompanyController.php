<?php

namespace App\Http\Controllers\company;

use App\Http\Controllers\Controller;
use App\Models\CarOrFleet;use App\Models\Driver;use App\Models\TripHistory;use App\Models\User;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index()
    {
        $company = auth()->user();

        $totalCar = CarOrFleet::where('company_id', $company->id)->count();
        $totalDriver = Driver::where('company_id', $company->id)->count();
        $totalTrip = TripHistory::where('company_id', $company->id)->count();
        return view('company.dashboard', compact('company', 'totalCar', 'totalDriver', 'totalTrip'));
    }

    public function show()
    {
        return view('company.pages.test');
    }
}
