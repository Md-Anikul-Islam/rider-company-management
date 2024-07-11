<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\FleetMake;use App\Models\FleetModel;use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;use Toastr;
class FleetModelController extends Controller
{
        public function index()
        {

            try {
                $carMakeTypes = FleetMake::latest()->get();
                $fleetModel = FleetModel::with('fleetMake')->latest()->get();
                return view('admin.pages.fleetModel.index', compact('carMakeTypes', 'fleetModel'));
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
            }
        }

        public function store(Request $request)
        {

            try {
                $request->validate([
                    'fleet_make_id' => 'required',
                    'car_model_name' => 'required',
                    'car_base_fare' => 'required',
                    'car_passenger_capacity' => 'required',
                    'car_bag_capacity' => 'required',
                ]);

                $fleetModel = new FleetModel();
                $fleetModel->fleet_make_id = $request->fleet_make_id;
                $fleetModel->car_model_name = $request->car_model_name;
                $fleetModel->car_base_fare = $request->car_base_fare;
                $fleetModel->car_passenger_capacity = $request->car_passenger_capacity;
                $fleetModel->car_bag_capacity = $request->car_bag_capacity;
                $fleetModel->save();
                Toastr::success('Car Model Info added successfully!', 'Success');
                return redirect()->back();
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
            }
        }

        public function update(Request $request, $id)
        {
            try {
                $validator = Validator::make($request->all(), [
                   'fleet_make_id' => 'required',
                   'car_model_name' => 'required',
                   'car_base_fare' => 'required',
                   'car_passenger_capacity' => 'required',
                   'car_bag_capacity' => 'required',
                ]);

                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                }

                $fleetModel = FleetModel::findOrFail($id);
                $fleetModel->fleet_make_id = $request->fleet_make_id;
                $fleetModel->car_model_name = $request->car_model_name;
                $fleetModel->car_base_fare = $request->car_base_fare;
                $fleetModel->car_passenger_capacity = $request->car_passenger_capacity;
                $fleetModel->car_bag_capacity = $request->car_bag_capacity;
                $fleetModel->status = $request->status;
                $fleetModel->save();
                Toastr::success('Car Model Info updated successfully!', 'Success');
                return redirect()->back();
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage())->withInput();
            }
        }

        public function destroy($id)
        {
            try {
                $fleetModel = FleetModel::findOrFail($id);
                $fleetModel->delete();
                Toastr::error('Car Model info deleted successfully!', 'Error');
                return redirect()->back();
            } catch (\Exception $e) {
                return redirect()->route('admin.car.index')->with('error', 'An error occurred: ' . $e->getMessage());
            }
        }
}
