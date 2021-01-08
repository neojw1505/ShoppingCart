<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CouponController extends Controller
{
    public function store(Request $request)
    {
        // dd($coupon);
        $coupon = request('coupon_code');
        $couponData = Coupon::where('name', $coupon)->first();
        if (!$couponData) {
            return back()->with('error_msg', 'Invalid Coupon, Please try again');
        }
        $condition = new \Darryldecode\Cart\CartCondition(array(
            'name' => $couponData->name,
            'type' => $couponData->type,
            'target' => 'total',
            'value' => $couponData->value,
            'order' => 1 // the order of calculation of cart base conditions. The bigger the later to be applied.
        ));

        \Cart::session(Auth::user()->id)->condition($condition);
        return view('cart-checkout')->with('success_msg', 'Coupon Applied')->with('condition', $condition);
    }

    public function destroy()
    {
        \Cart::clearCartConditions();
        return redirect()->route('cart.checkout')->with('success_msg', 'Coupon removed');
    }
}
