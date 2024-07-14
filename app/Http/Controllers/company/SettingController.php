<?php

namespace App\Http\Controllers\company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;use Illuminate\Support\Facades\Auth;use Illuminate\Support\Facades\Hash;use Illuminate\Validation\Rules\Password;
use Toastr;
class SettingController extends Controller
{
     public function companyChangePassword()
        {
            return view('company.pages.settings.changePassword');
        }

        public function companyUpdatePassword(Request $request)
        {
            // Validate the request data
            $request->validate([
                'old_password' => 'required',
                'password' => ['required', 'confirmed', Password::defaults()],
            ]);

            $user = Auth::user();

            // Check if the old password matches
            if (!Hash::check($request->old_password, $user->password)) {
                return back()->withErrors(['old_password' => 'Old password is incorrect']);
            }

            // Update the password
            $user->password = Hash::make($request->password);
            $user->save();

            Toastr::success('Password updated successfully!', 'success');
            return redirect()->back();

        }
}
