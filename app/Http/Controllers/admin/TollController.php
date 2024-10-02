<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Toll;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Toastr;
class TollController extends Controller
{
    public function index()
   {
       try {
           $toll = Toll::latest()->get();
           return view('admin.pages.toll.index', compact('toll'));
       } catch (\Exception $e) {
           return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
       }
   }

   public function store(Request $request)
   {
       try {
           $request->validate([
               'name' => 'required',
               'latitude' => 'required',
               'longitude' => 'required',
               'amount' => 'required',
           ]);
           $toll = new Toll();
           $toll->name = $request->name;
           $toll->latitude = $request->latitude;
           $toll->longitude = $request->longitude;
           $toll->amount = $request->amount;
           $toll->save();
           Toastr::success('Toll added successfully!', 'Success');
           return redirect()->back();
       } catch (\Exception $e) {
           return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
       }
   }

   public function update(Request $request, $id)
   {
       try {
           $validator = Validator::make($request->all(), [
              'name' => 'required',
              'latitude' => 'required',
              'longitude' => 'required',
              'amount' => 'required',
           ]);

           if ($validator->fails()) {
               return redirect()->back()->withErrors($validator)->withInput();
           }
           $toll = Toll::findOrFail($id);
           $toll->name = $request->name;
           $toll->latitude = $request->latitude;
           $toll->longitude = $request->longitude;
           $toll->amount = $request->amount;
           $toll->status = $request->status;
           $toll->save();
           Toastr::success('Toll updated successfully!', 'Success');
           return redirect()->back();
       } catch (\Exception $e) {
           return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage())->withInput();
       }
   }

    public function destroy($id)
    {
       try {
           $toll = Toll::findOrFail($id);
           $toll->delete();
           Toastr::error('Toll deleted successfully!', 'Error');
           return redirect()->back();
       } catch (\Exception $e) {
           return redirect()->route('admin.company')->with('error', 'An error occurred: ' . $e->getMessage());
       }
    }
}
