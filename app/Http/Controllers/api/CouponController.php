<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Coupon;use App\Models\CouponApply;use Carbon\Carbon;use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function coupon(Request $request)
    {
        try {
            $coupon = Coupon::latest()->get();
            if ($coupon) {
                return response()->json(['coupon' => $coupon]);
            } else {
                return response()->json(['error' => 'Coupon not found'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while retrieving the coupon'], 500);
        }
    }

    public function applyCoupon(Request $request)
    {

        $request->validate([
            'coupon_id' => 'required|exists:coupons,id',
        ]);

        $couponId = $request->coupon_id;
        $customerId = $request->user()->id;
        // Find the coupon
        $coupon = Coupon::find($couponId);
        if (!$coupon) {
            return response()->json(['message' => 'Coupon not found'], 200);
        }
        // Check if the coupon has expired
        if (Carbon::now()->gt($coupon->valid_to)) {
            return response()->json(['message' => 'Coupon has expired'], 200);
        }
        // Check if the user has reached the maximum usage limit for the coupon

       // dd($coupon->id);
        $userCouponCount = CouponApply::where('coupon_id', $coupon->id)->where('apply_status', 1)
            ->where('customer_id', $customerId)
            ->count();

       // dd($userCouponCount);

        if ($userCouponCount >= $coupon->max_uses) {
            return response()->json(['message' => 'Coupon not valid for you'], 200);
        }else{
            $couponUser = new CouponApply();
            $couponUser->coupon_id = $couponId;
            $couponUser->customer_id = $customerId;
            $couponUser->apply_status = 1;
            $couponUser->save();
            return response()->json(['message' => 'Coupon applied successfully'], 200);
        }
    }




}
