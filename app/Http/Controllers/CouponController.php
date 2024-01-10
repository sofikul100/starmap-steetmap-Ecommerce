<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coupons = Coupon::all();
        $totalCoupon = Coupon::withTrashed()->count();
        $totalTrashed = Coupon::onlyTrashed()->count();
        return view('admin.coupon.couponIndex',compact('coupons','totalCoupon','totalTrashed'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return view('admin.coupon.couponAdd');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'coupon_name'=>'required',
            'coupon_code'=>'required',
            'start_date'=>'required|date',
            'end_date'=>'required|date'
        ]);

        $coupon = new Coupon();
        $coupon->coupon_name = $request->coupon_name;
        $coupon->coupon_code = $request->coupon_code;
        $coupon->start_date = $request->start_date;
        $coupon->end_date = $request->end_date;
        $coupon->save(); 
        return redirect()->back()->with('message','Coupon Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $coupon = Coupon::findOrFail($id);
        return view('admin.coupon.couponEdit',compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $request->validate([
            'coupon_name'=>'required',
            'coupon_code'=>'required',
            'start_date'=>'required|date',
            'end_date'=>'required|date'
        ]);


        $coupon = Coupon::findOrFail($id);
        $coupon->coupon_name = $request->coupon_name;
        $coupon->coupon_code = $request->coupon_code;
        $coupon->start_date = $request->start_date;
        $coupon->end_date = $request->end_date;
        $coupon->save(); 
        return redirect()->back()->with('message','Coupon Updated Successfully');
       
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->delete();
        return redirect()->back()->with('message','Coupon add to trashed succcessfully');
    }



    public function couponStatus ($id){
        $coupon = Coupon::findOrFail($id);
        if($coupon->status == 1){
           $coupon->status = 0;
        }else{
           $coupon->status = 1;
        }

        $coupon->save();
        return redirect()->back()->with('message','Coupon Status Updated Successfully');
    }




    public function couponTrashedItems (){
        $coupons = Coupon::onlyTrashed()->get();
        return view('admin.coupon.couponTrashedItems',compact('coupons'));
    }


    public function couponRestore ($id){
        $coupon = Coupon::withTrashed()->findOrFail($id);
        $coupon->restore();
        return redirect()->back()->with('message','Coupon Restore  Successfully');
    }



    public function couponParmanentlyDelete (string $id){
        $coupon = Coupon::withTrashed()->findOrFail($id);
        $coupon->forceDelete();
        return redirect()->back()->with('message','Coupon Parmanently Deleted Successfully');
    }
}
