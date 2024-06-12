<?php

namespace App\Http\Controllers\company;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index()
    {
        $company = auth()->user();
        return view('company.dashboard', compact('company'));
    }

    public function show()
    {
        return view('company.pages.test');
    }
}
