<?php

namespace App\Http\Controllers\Coupon;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function allCouponsPage()
    {
        $coupons = Coupon::all();
        return view('admin.coupons.all_coupons', compact('coupons'));
    }

    public function addCoupons()
    {
        return view('admin.coupons.add_coupons');
    }


    public function storeCoupons(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:255|unique:coupons,code',
            'discount' => 'required|numeric|min:0|max:100',
            'expiry_date' => 'required|date|after_or_equal:today',
            'is_active' => 'required|boolean',
        ]);

        Coupon::create([
            'code' => $request->input('code'),
            'discount' => $request->input('discount'),
            'expiry_date' => $request->input('expiry_date'),
            'is_active' => $request->input('is_active'),
        ]);


        return redirect()->route('admin.allCoupons')->with('success_coupons', 'Coupon added successfully!');
    }


    public function editCoupons($id)
    {
        $coupon = Coupon::findOrFail($id);
        return view('admin.coupons.edit_coupons', compact('coupon'));
    }

    public function update(Request $request, $id)
    {
        $coupon = Coupon::findOrFail($id);

        $request->validate([
            'code' => 'required|string|max:255|unique:coupons,code,' . $coupon->id,
            'discount' => 'required|numeric|min:0|max:100',
            'expiry_date' => 'required|date|after_or_equal:today',
            'is_active' => 'required|boolean',
        ]);

        $coupon->update([
            'code' => $request->input('code'),
            'discount' => $request->input('discount'),
            'expiry_date' => $request->input('expiry_date'),
            'is_active' => $request->input('is_active'),
        ]);

        return redirect()->route('admin.allCoupons')->with('success_updated', 'Coupon updated successfully!');
    }


    public function destroy($id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->delete();

        return redirect()->route('admin.allCoupons')->with('success_coupons_deleted', 'Coupon deleted successfully.');
    }
}
