<?php

namespace App\Http\Controllers;

use App\Models\CustomerReview;
use Illuminate\Http\Request;

class CustomerReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customerReviews = CustomerReview::orderBy('id','DESC')->get();
        $totalCustomerReview = CustomerReview::withTrashed()->count();
        $totalApproved = CustomerReview::withTrashed()->where('status',1)->count();
        $totalUnApproved = CustomerReview::withTrashed()->where('status',0)->count();
        $totalTrashed = CustomerReview::onlyTrashed()->count();

        return view('admin.customer_review.customerReviewIndex',compact('customerReviews','totalCustomerReview','totalApproved','totalUnApproved','totalTrashed'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $customerReview = CustomerReview::findOrFail($id);
        $customerReview->delete();
        return redirect()->back()->with('message','Customer Review Trashed Successfully');
    }


    public function customerReviewView (string $id){
        $customerReview = CustomerReview::withTrashed()->findOrFail($id);

        return view('admin.customer_review.customerReviewView',compact('customerReview'));
    }



    public function status($id){
        $customerReview = CustomerReview::findOrFail($id);
        if($customerReview->status == 0){
           $customerReview->status = 1;
           $customerReview->save();
           return redirect()->back()->with('message','Customer Review Approved Successfully');
        }else{
           $customerReview->status = 0;
           $customerReview->save();
           return redirect()->back()->with('message','Customer Review UnApproved Successfully');
        }

        

       
    }


    public function customerReviewTrashedItems(){
        $customerReviews = CustomerReview::onlyTrashed()->get();
        return view('admin.customer_review.customerRviewTrashed',compact('customerReviews'));
    }


    public function customerReviewRestore($id){
        $customerReview = CustomerReview::withTrashed()->findOrFail($id);
        $customerReview->restore();
        return redirect()->back()->with('message','Customer Review Restore Successfully');
    }


    public function customerReviewParmanentDelete($id){
        $customerReview = CustomerReview::withTrashed()->findOrFail($id);
        if(!empty($customerReview->image)){
            if (file_exists(public_path($customerReview->image))) {
                unlink(public_path($customerReview->image));
            }
        }
        $customerReview->forceDelete();
        return redirect()->back()->with('message','Customer Review Parmanent Deleted Successfully');
    }


}
