<?php

namespace App\Http\Controllers\company;

use App\Http\Controllers\Controller;
use App\Models\CarOrFleet;
use App\Models\FleetType;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Toastr;
class CarOrFleetController extends Controller
{
        public function index()
        {
            try {
                $cars = CarOrFleet::with('fleetType')->latest()->get();
                $carTypes = FleetType::all();
                return view('company.pages.fleet.index', compact('cars', 'carTypes'));
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
            }
        }

        public function store(Request $request)
        {

            try {
                $request->validate([
                    'car_type_id' => 'required',
                    'plate_no' => 'required|unique:car_or_fleets',
                    'car_name' => 'required',
                    'car_model' => 'required',
                    'car_make' => 'required',
                    'year' => 'required|integer',
                    'car_color' => 'required',
                    'passengers' => 'required|integer',
                    'car_bag' => 'required|integer',
                    'car_base' => 'required',
                    'car_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    'car_register_card' => 'required|image|mimes:jpeg,png,jpg,gif,svg,pdf|max:2048',
                ]);

                $car = new CarOrFleet();
                $car->car_type_id = $request->car_type_id;
                $car->plate_no = $request->plate_no;
                $car->car_name = $request->car_name;
                $car->car_model = $request->car_model;
                $car->car_make = $request->car_make;
                $car->year = $request->year;
                $car->car_color = $request->car_color;
                $car->passengers = $request->passengers;
                $car->car_bag = $request->car_bag;
                $car->car_base = $request->car_base;

                if ($request->hasFile('car_image')) {
                    $image = $request->file('car_image');
                    $imageName = time() . '_' . $image->getClientOriginalName();
                    $image->move(public_path('car_images'), $imageName);
                    $car->car_image = 'car_images/' . $imageName;
                }

                if ($request->hasFile('car_register_card')) {
                    $registerCard = $request->file('car_register_card');
                    $registerCardName = time() . '_' . $registerCard->getClientOriginalName();
                    $registerCard->move(public_path('car_register_cards'), $registerCardName);
                    $car->car_register_card = 'car_register_cards/' . $registerCardName;
                }

                $car->status = 'active';
                $car->save();

                Toastr::success('Car added successfully!', 'Success');
                return redirect()->back();
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
            }
        }

        public function update(Request $request, $id)
        {
            try {
                $validator = Validator::make($request->all(), [
                    'car_type_id' => 'required',
                    'plate_no' => 'required|unique:car_or_fleets,plate_no,' . $id,
                    'car_name' => 'required',
                    'car_model' => 'required',
                    'car_make' => 'required',
                    'year' => 'required|integer',
                    'car_color' => 'required',
                    'passengers' => 'required|integer',
                    'car_bag' => 'required|integer',
                    'car_base' => 'required',
                    'car_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    'car_register_card' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,pdf|max:2048',
                ]);

                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                }

                $car = CarOrFleet::findOrFail($id);
                $car->car_type_id = $request->car_type_id;
                $car->plate_no = $request->plate_no;
                $car->car_name = $request->car_name;
                $car->car_model = $request->car_model;
                $car->car_make = $request->car_make;
                $car->year = $request->year;
                $car->car_color = $request->car_color;
                $car->passengers = $request->passengers;
                $car->car_bag = $request->car_bag;
                $car->car_base = $request->car_base;
                $car->status = $request->status;

                if ($request->hasFile('car_image')) {
                    if (File::exists(public_path($car->car_image))) {
                        File::delete(public_path($car->car_image));
                    }
                    $image = $request->file('car_image');
                    $imageName = time() . '_' . $image->getClientOriginalName();
                    $image->move(public_path('car_images'), $imageName);
                    $car->car_image = 'car_images/' . $imageName;
                }

                if ($request->hasFile('car_register_card')) {
                    if (File::exists(public_path($car->car_register_card))) {
                        File::delete(public_path($car->car_register_card));
                    }
                    $registerCard = $request->file('car_register_card');
                    $registerCardName = time() . '_' . $registerCard->getClientOriginalName();
                    $registerCard->move(public_path('car_register_cards'), $registerCardName);
                    $car->car_register_card = 'car_register_cards/' . $registerCardName;
                }

                $car->save();
                Toastr::success('Car updated successfully!', 'Success');
                return redirect()->back();
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage())->withInput();
            }
        }

        public function destroy($id)
        {
            try {
                $car = CarOrFleet::findOrFail($id);
                if (File::exists(public_path($car->car_image))) {
                    File::delete(public_path($car->car_image));
                }

                if (File::exists(public_path($car->car_register_card))) {
                    File::delete(public_path($car->car_register_card));
                }

                $car->delete();
                Toastr::error('Car deleted successfully!', 'Error');
                return redirect()->back();
            } catch (\Exception $e) {
                return redirect()->route('admin.car.index')->with('error', 'An error occurred: ' . $e->getMessage());
            }
        }
}
