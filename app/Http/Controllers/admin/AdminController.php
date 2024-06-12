<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $companies = User::where('role', 'company')->get();
        return view('admin.dashboard', compact('companies'));
    }


}
