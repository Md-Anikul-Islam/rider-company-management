<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\FleetType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Toastr;
class FleetTypeController extends Controller
{
           public function index()
           {
               try {
                   $fleetType = FleetType::latest()->get();
                   return view('admin.pages.fleetType.index', compact('fleetType'));
               } catch (\Exception $e) {
                   return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
               }
           }

           public function store(Request $request)
           {
               try {
                   $request->validate([
                       'name' => 'required|max:255',
                   ]);
                   $fleetType = new FleetType();
                   $fleetType->name = $request->name;
                   $fleetType->save();

                   Toastr::success('Fleet Type added successfully!', 'Success');
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
                   ]);

                   if ($validator->fails()) {
                       return redirect()->back()->withErrors($validator)->withInput();
                   }
                   $fleetType = FleetType::findOrFail($id);
                   $fleetType->name = $request->name;
                   $fleetType->status = $request->status;
                   $fleetType->save();
                   Toastr::success('Fleet Type updated successfully!', 'Success');
                   return redirect()->back();
               } catch (\Exception $e) {
                   return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage())->withInput();
               }
           }

            public function destroy($id)
            {
               try {
                   $fleetType = FleetType::findOrFail($id);
                   $fleetType->delete();
                   Toastr::error('Fleet Type deleted successfully!', 'Error');
                   return redirect()->back();
               } catch (\Exception $e) {
                   return redirect()->route('admin.company')->with('error', 'An error occurred: ' . $e->getMessage());
               }
            }
}
