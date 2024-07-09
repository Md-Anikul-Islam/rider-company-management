<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Toastr;
class CompanyMakeController extends Controller
{
    public function company()
    {
        return view('company-register');
    }

    public function companyRegister(Request $request)
    {
       try {
           $request->validate([
               'name' => 'required|max:255',
               'email' => 'required|email|unique:users',
               'phone' => 'required',
               'address' => 'required',
               'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
               'password' => 'required|min:6',
               'trade_license' => 'nullable|mimes:jpeg,png,jpg,gif,svg,pdf',
           ]);
           $company = new User();
           $company->name = $request->name;
           $company->email = $request->email;
           $company->phone = $request->phone;
           $company->address = $request->address;
           $company->status = 'inactive';

           if ($request->hasFile('logo')) {
               $logo = $request->file('logo');
               $logoName = time() . '_' . $logo->getClientOriginalName();
               $logo->move(public_path('logos'), $logoName);
               $company->logo = 'logos/' . $logoName;
           }

           if ($request->hasFile('trade_license')) {
               $tradeLicense = $request->file('trade_license');
               $tradeLicenseName = time() . '_' . $tradeLicense->getClientOriginalName();
               $tradeLicense->move(public_path('tradeLicense'), $tradeLicenseName);
               $company->trade_license = 'tradeLicense/' . $tradeLicenseName;
           }

           $company->password = bcrypt($request->password);
           $company->save();

           Toastr::success('Company added successfully!', 'Success');
           return redirect()->back();
       } catch (\Exception $e) {
           return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
       }
    }
}
