<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Coupon;use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function coupon(Request $request)
    {
        try {
            $coupon = Coupon::with('company')->get();
            if ($coupon) {
                return response()->json($coupon);
            } else {
                return response()->json(['error' => 'Coupon not found'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while retrieving the coupon'], 500);
        }
    }

}
