<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\CompanyCommission;use App\Models\TripHistory;use App\Models\User;use Illuminate\Http\Request;
use Toastr;
class CommissionController extends Controller
{
    public function companyCommission()
    {
        $company = User::where('role','company')->get();
        $commission = CompanyCommission::with('company')->latest()->get();
        return view('admin.pages.commission.companyCommission',compact('company','commission'));
    }

    public function companyCommissionStore(Request $request)
    {
        try {
            $request->validate([
                'company_id' => 'required',
                'commission_percentage' => 'required|numeric|min:0',
            ]);
            $commission = new CompanyCommission();
            $commission->company_id = $request->company_id;
            $commission->commission_percentage = $request->commission_percentage;
            $commission->save();
            Toastr::success('Company Commission Added Successfully', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function companyCommissionUpdate(Request $request, $id)
    {

        try {
            $commission = CompanyCommission::findOrFail($id);
            $request->validate([
                'company_id' => 'required',
                'commission_percentage' => 'required|numeric|min:0',
            ]);
            $commission->company_id = $request->company_id;
            $commission->commission_percentage = $request->commission_percentage;
            $commission->save();
            Toastr::success('Company Commission Updated Successfully', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function companyCommissionDestroy($id)
    {
        try {
            $commission = CompanyCommission::find($id);
            $commission->delete();
            Toastr::success('Company Commission Deleted Successfully', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }


    //Earning Company Commission
    public function earningCompanyCommission(Request $request)
    {
        $companies = User::where('role','company')->get();
        $companyId = $request->input('company_id');
        $company = User::find($companyId);
        $trips = TripHistory::where('company_id', $companyId)->with('passenger','driver')->get();
        $totalEarnings = $trips->sum(function($trip) {
            return $trip->fare_received_status == 0 ? $trip->calculated_fare : $trip->estimated_fare;
        });

        $commissionRate = CompanyCommission::where('company_id', $companyId)->value('commission_percentage');
        $adminEarnings = $totalEarnings * ($commissionRate / 100);

        return view('admin.pages.commission.earningCommissionOnCompany', compact('company', 'trips', 'totalEarnings', 'adminEarnings', 'commissionRate', 'companies'));
    }

}
