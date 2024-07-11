<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\FleetMake;use App\Models\FleetType;use Illuminate\Http\Request;use Illuminate\Support\Facades\Validator;
use Toastr;
class FleetMakeController extends Controller
{
    public function index()
    {

        try {
            $fleetMaker = FleetMake::with('fleetType')->latest()->get();
            $carTypes = FleetType::all();
            return view('admin.pages.fleetMake.index', compact('fleetMaker', 'carTypes'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {

        try {
            $request->validate([
                'fleet_type_id' => 'required',
                'car_make_name' => 'required',
            ]);

            $fleetMaker = new FleetMake();
            $fleetMaker->fleet_type_id = $request->fleet_type_id;
            $fleetMaker->car_make_name = $request->car_make_name;
            $fleetMaker->save();
            Toastr::success('Car Maker Info added successfully!', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                 'fleet_type_id' => 'required',
                 'car_make_name' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $fleetMaker = FleetMake::findOrFail($id);
            $fleetMaker->fleet_type_id = $request->fleet_type_id;
            $fleetMaker->car_make_name = $request->car_make_name;
            $fleetMaker->status = $request->status;
            $fleetMaker->save();
            Toastr::success('Car Maker Info updated successfully!', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $fleetMaker = FleetMake::findOrFail($id);
            $fleetMaker->delete();
            Toastr::error('Car Maker info deleted successfully!', 'Error');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->route('admin.car.index')->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
}
