<?php

namespace App\Http\Controllers\company;

use App\Http\Controllers\Controller;
use App\Models\CarOrFleet;use App\Models\Driver;use App\Models\TripHistory;use Carbon\Carbon;use Illuminate\Http\Request;use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;use Toastr;
class DriverController extends Controller
{
    public function index()
    {
        $car = CarOrFleet::where('company_id', Auth::user()->id)->get();
        $availableCar = CarOrFleet::where('company_id', Auth::user()->id)->where('is_selected', 'no')->get();
        $drivers = Driver::where('company_id', Auth::user()->id)->get();
        return view('company.pages.driver.index', compact('car', 'drivers', 'availableCar'));
    }

    public function store(Request $request)
    {

        try {
            $request->validate([
                'name' => 'required|string',
                'email' => 'required|email|unique:drivers',
                'phone' => 'required|string|unique:drivers',
                'driving_licence_font_image' => 'required|mimes:jpeg,png,jpg,pdf|max:2048',
                'driving_licence_back_image' => 'required|mimes:jpeg,png,jpg,pdf|max:2048',
                'rta_card_font_image' => 'required|mimes:jpeg,png,jpg,pdf|max:2048',
                'rta_card_back_image' => 'required|mimes:jpeg,png,jpg,pdf|max:2048',
            ]);

            $driver = new Driver();
            $driver->company_id = auth()->user()->id;
            $driver->car_id = $request->car_id??null;
            $driver->name = $request->name;
            $driver->email = $request->email;
            $driver->phone = $request->phone;
            $driver->address = $request->address;
            $driver->gender = $request->gender;
            $driver->dob = $request->dob;
            $driver->password = bcrypt($request->password);
            $driver->ratting = 0;

            if ($request->hasFile('driving_licence_font_image')) {
                $drivingLicenceFrontImage = time() . '_' . $request->file('driving_licence_font_image')->getClientOriginalName();
                $request->file('driving_licence_font_image')->move(public_path('images/driving_licence_front'), $drivingLicenceFrontImage);
                $driver->driving_licence_font_image = 'images/driving_licence_front/' . $drivingLicenceFrontImage;
            }

            if ($request->hasFile('driving_licence_back_image')) {
                $drivingLicenceBackImage = time() . '_' . $request->file('driving_licence_back_image')->getClientOriginalName();
                $request->file('driving_licence_back_image')->move(public_path('images/driving_licence_back'), $drivingLicenceBackImage);
                $driver->driving_licence_back_image = 'images/driving_licence_back/' . $drivingLicenceBackImage;
            }

            if ($request->hasFile('rta_card_font_image')) {
                $rtaCardFrontImage = time() . '_' . $request->file('rta_card_font_image')->getClientOriginalName();
                $request->file('rta_card_font_image')->move(public_path('images/rta_card_front'), $rtaCardFrontImage);
                $driver->rta_card_font_image = 'images/rta_card_front/' . $rtaCardFrontImage;
            }

            if ($request->hasFile('rta_card_back_image')) {
                $rtaCardBackImage = time() . '_' . $request->file('rta_card_back_image')->getClientOriginalName();
                $request->file('rta_card_back_image')->move(public_path('images/rta_card_back'), $rtaCardBackImage);
                $driver->rta_card_back_image = 'images/rta_card_back/' . $rtaCardBackImage;
            }
            $driver->save();
            // Update the CarOrFleet is_selected field
            $car = CarOrFleet::find($request->car_id);
            if ($car) {
                $car->is_selected = 'yes';
                $car->save();
            }

            Toastr::success('Driver added successfully!', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required|string',
                'email' => 'required|email|unique:drivers,email,' . $id,
                'phone' => 'required|string|unique:drivers,phone,' . $id,
                'driving_licence_font_image' => 'nullable|mimes:jpeg,png,jpg,pdf|max:2048',
                'driving_licence_back_image' => 'nullable|mimes:jpeg,png,jpg,pdf|max:2048',
                'rta_card_font_image' => 'nullable|mimes:jpeg,png,jpg,pdf|max:2048',
                'rta_card_back_image' => 'nullable|mimes:jpeg,png,jpg,pdf|max:2048',
            ]);

            $driver = Driver::findOrFail($id);
            $previousCarId = $driver->car_id;
            $driver->company_id = auth()->user()->id;
            $driver->car_id = $request->car_id??null;
            $driver->name = $request->name;
            $driver->email = $request->email;
            $driver->phone = $request->phone;
            $driver->address = $request->address;
            $driver->gender = $request->gender;
            $driver->dob = $request->dob;
            $driver->status = $request->status;
            if ($request->password) {
                $driver->password = bcrypt($request->password);
            }

            if ($request->hasFile('driving_licence_font_image')) {
                $drivingLicenceFrontImage = time() . '_' . $request->file('driving_licence_font_image')->getClientOriginalName();
                $request->file('driving_licence_font_image')->move(public_path('images/driving_licence_front'), $drivingLicenceFrontImage);
                $driver->driving_licence_font_image = 'images/driving_licence_front/' . $drivingLicenceFrontImage;
            }

            if ($request->hasFile('driving_licence_back_image')) {
                $drivingLicenceBackImage = time() . '_' . $request->file('driving_licence_back_image')->getClientOriginalName();
                $request->file('driving_licence_back_image')->move(public_path('images/driving_licence_back'), $drivingLicenceBackImage);
                $driver->driving_licence_back_image = 'images/driving_licence_back/' . $drivingLicenceBackImage;
            }

            if ($request->hasFile('rta_card_font_image')) {
                $rtaCardFrontImage = time() . '_' . $request->file('rta_card_font_image')->getClientOriginalName();
                $request->file('rta_card_font_image')->move(public_path('images/rta_card_front'), $rtaCardFrontImage);
                $driver->rta_card_font_image = 'images/rta_card_front/' . $rtaCardFrontImage;
            }

            if ($request->hasFile('rta_card_back_image')) {
                $rtaCardBackImage = time() . '_' . $request->file('rta_card_back_image')->getClientOriginalName();
                $request->file('rta_card_back_image')->move(public_path('images/rta_card_back'), $rtaCardBackImage);
                $driver->rta_card_back_image = 'images/rta_card_back/' . $rtaCardBackImage;
            }
            $driver->save();


            // Expire tokens if the driver status is inactive
            if ($driver->status === 'inactive') {
                $this->expireDriverTokens($driver->id);
            }


            // Update the previously assigned car's is_selected to 'no'
            if ($previousCarId && $previousCarId != $driver->car_id) {
                CarOrFleet::where('id', $previousCarId)->update(['is_selected' => 'no']);
            }

            // Update the CarOrFleet is_selected field if car_id is provided
            if ($request->car_id) {
                $car = CarOrFleet::find($request->car_id);
                if ($car) {
                    $car->is_selected = 'yes';
                    $car->save();
                }
            }

            Toastr::success('Driver updated successfully!', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }


    protected function expireDriverTokens($driverId)
    {
        DB::table('personal_access_tokens')
            ->where('tokenable_id', $driverId)
            ->where('tokenable_type', 'App\Models\Driver') // Adjust this if your model namespace is different
            ->update(['expires_at' => Carbon::now()]);
    }





    public function destroy($id)
    {
        try {
            $driver = Driver::findOrFail($id);

            // Delete driving licence front image if exists
            if ($driver->driving_licence_font_image && file_exists(public_path($driver->driving_licence_font_image))) {
                unlink(public_path($driver->driving_licence_font_image));
            }

            // Delete driving licence back image if exists
            if ($driver->driving_licence_back_image && file_exists(public_path($driver->driving_licence_back_image))) {
                unlink(public_path($driver->driving_licence_back_image));
            }

            // Delete RTA card front image if exists
            if ($driver->rta_card_font_image && file_exists(public_path($driver->rta_card_font_image))) {
                unlink(public_path($driver->rta_card_font_image));
            }

            // Delete RTA card back image if exists
            if ($driver->rta_card_back_image && file_exists(public_path($driver->rta_card_back_image))) {
                unlink(public_path($driver->rta_card_back_image));
            }

            // Delete profile image if exists
            if ($driver->profile && file_exists(public_path($driver->profile))) {
                unlink(public_path($driver->profile));
            }

            // Delete the driver record
            $driver->delete();
            Toastr::success('Driver deleted successfully!', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $driver = Driver::where('id', $id)->with('car')->first();
        $trip = TripHistory::where('driver_id', $id)->with('passenger')->paginate(50);
        return view('company.pages.driver.driverDetails', compact('driver', 'trip'));
    }


}
