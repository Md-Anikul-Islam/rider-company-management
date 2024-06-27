<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Driver;use App\Models\TripHistory;use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Toastr;
class CompanyController extends Controller
{
       public function index()
       {
           try {
               $companies = User::where('role', 'company')->latest()->get();
               return view('admin.pages.company.index', compact('companies'));
           } catch (\Exception $e) {
               return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
           }
       }

       public function store(Request $request)
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

       public function update(Request $request, $id)
       {
           try {
               $validator = Validator::make($request->all(), [
                   'name' => 'required|max:255',
                   'email' => 'required|email|unique:users,email,' . $id,
                   'phone' => 'required',
                   'address' => 'required',
                   'logo' => 'nullable|image',
                   'password' => 'nullable|min:6',
                   'trade_license' => 'nullable|mimes:jpeg,png,jpg,gif,svg,pdf',
               ]);

               if ($validator->fails()) {
                   return redirect()->back()->withErrors($validator)->withInput();
               }
               $company = User::findOrFail($id);
               $company->name = $request->name;
               $company->email = $request->email;
               $company->phone = $request->phone;
               $company->address = $request->address;
               $company->status = $request->status;

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

               if ($request->filled('password')) {
                   $company->password = bcrypt($request->password);
               }
               $company->save();
               Toastr::success('Company updated successfully!', 'Success');
               return redirect()->back();
           } catch (\Exception $e) {
               return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage())->withInput();
           }
       }

        public function destroy($id)
        {
           try {
               $company = User::findOrFail($id);
               if ($company->logo && File::exists(public_path($company->logo))) {
                   File::delete(public_path($company->logo));
               }


               if ($company->trade_license && File::exists(public_path($company->trade_license))) {

                   File::delete(public_path($company->trade_license));

               }
               $company->delete();
               Toastr::error('Company deleted successfully!', 'Error');
               return redirect()->back();
           } catch (\Exception $e) {
               return redirect()->route('admin.company')->with('error', 'An error occurred: ' . $e->getMessage());
           }
        }

        public function showDriverList($companyId)
        {
            //dd($companyId);
            try {
                $driver = Driver::where('company_id', $companyId)->with('car')->get();
                return view('admin.pages.company.driver.companyUnderDriverList', compact('driver'));
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
            }
        }

        public function showDriverDetails($id)
        {
            $driver = Driver::where('id', $id)->with('car','company')->first();
            $trip = TripHistory::where('driver_id', $id)->with('passenger')->paginate(50);
            return view('admin.pages.company.driver.companyUnderDriverDetails', compact('driver','trip'));
        }







}
