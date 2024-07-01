<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Agent;use Illuminate\Http\Request;use Illuminate\Support\Facades\File;use Illuminate\Support\Facades\Validator;
use Toastr;
class AgentController extends Controller
{
           public function index()
           {
               try {
                   $agent = Agent::latest()->get();
                   return view('admin.pages.agent.index', compact('agent'));
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
                       'profile' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                       'password' => 'required|min:6',

                   ]);
                   $agent = new Agent();
                   $agent->name = $request->name;
                   $agent->email = $request->email;
                   $agent->phone = $request->phone;
                   $agent->address = $request->address;

                   if ($request->hasFile('profile')) {
                       $profile = $request->file('profile');
                       $profileName = time() . '_' . $profile->getClientOriginalName();
                       $profile->move(public_path('agent'), $profileName);
                       $agent->profile = 'agent/' . $profileName;
                   }
                   $agent->password = bcrypt($request->password);
                   $agent->save();
                   Toastr::success('Profile added successfully!', 'Success');
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
                       'profile' => 'nullable|image',
                       'password' => 'nullable|min:6',

                   ]);

                   if ($validator->fails()) {
                       return redirect()->back()->withErrors($validator)->withInput();
                   }
                   $agent = Agent::findOrFail($id);
                   $agent->name = $request->name;
                   $agent->email = $request->email;
                   $agent->phone = $request->phone;
                   $agent->address = $request->address;
                   $agent->status = $request->status;

                   if ($request->hasFile('profile')) {
                       $profile = $request->file('profile');
                       $profileName = time() . '_' . $profile->getClientOriginalName();
                       $profile->move(public_path('agent'), $profileName);
                       $agent->profile = 'agent/' . $profileName;
                   }
                   if ($request->filled('password')) {
                       $agent->password = bcrypt($request->password);
                   }
                   $agent->save();
                   Toastr::success('Agent updated successfully!', 'Success');
                   return redirect()->back();
               } catch (\Exception $e) {
                   return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage())->withInput();
               }
           }

            public function destroy($id)
            {
               try {
                   $agent = Agent::findOrFail($id);
                   if ($agent->profile && File::exists(public_path($agent->logo))) {
                       File::delete(public_path($agent->profile));
                   }

                   $agent->delete();
                   Toastr::error('Profile deleted successfully!', 'Error');
                   return redirect()->back();
               } catch (\Exception $e) {
                   return redirect()->route('admin.agent')->with('error', 'An error occurred: ' . $e->getMessage());
               }
            }
}
