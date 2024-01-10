<?php

namespace App\Http\Controllers;

use App\Models\InfluentialReview;
use Illuminate\Http\Request;

class InfluentialReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $influentialReviews = InfluentialReview::all();
        $totalInfluentialReview = InfluentialReview::withTrashed()->count();
        $totalTrashed = InfluentialReview::onlyTrashed()->count();
        return view('admin.influentialReview.influentialReviewIndex', compact('influentialReviews', 'totalInfluentialReview', 'totalTrashed'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.influentialReview.influentialReviewAdd');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'required|image|mimes:png,jpg,jpeg',
            'ratings' => 'required',
            'review' => 'required'
        ]);

        $influentialReview = new InfluentialReview();
        $influentialReview->name = $request->name;
        $influentialReview->ratings = $request->ratings;
        $influentialReview->review = $request->review;
        $influentialReview->date = date('d-m-Y');
        if ($request->hasFile('image')) {

            $location_name = 'images/influential_review_images/'; //change folder name according to the MODEL

            $file = $request->file('image');
            $name = time() . '.' . $file->getClientOriginalExtension();
            $destinationPath = env('PUBLIC_FILE_LOCATION') ? public_path('../' . $location_name) : public_path($location_name);
            $file->move($destinationPath, $name);
            $location = $location_name . $name;
            $influentialReview->image = $location;
            $influentialReview->save();
            return redirect()->back()->with('message', 'Influential Review Added Successfully');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $influentialReview = InfluentialReview::withTrashed()->findOrFail($id);
        return view('admin.influentialReview.influentialReviewView',compact('influentialReview'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
      $influentialReview = InfluentialReview::findOrFail($id);  
      return view('admin.influentialReview.influentialReviewEdit',compact('influentialReview'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'image|mimes:png,jpg,jpeg',
            'ratings' => 'required',
            'review' => 'required'
        ]);

        $influentialReview =InfluentialReview::findOrFail($id);
        $influentialReview->name = $request->name;
        $influentialReview->ratings = $request->ratings;
        $influentialReview->review = $request->review;
        $influentialReview->date = date('d-m-Y');
        if ($request->hasFile('image')) {

            $location_name = 'images/influential_review_images/'; //change folder name according to the MODEL
  
            $file = $request->file('image');
            $name = time() . '.' . $file->getClientOriginalExtension();
            $destinationPath = env('PUBLIC_FILE_LOCATION') ? public_path('../'.$location_name) : public_path($location_name);
            $file->move($destinationPath, $name);
            $location = $location_name . $name;
  
            if ($influentialReview->image) {
  
                if (file_exists(public_path($influentialReview->image))) {
                    unlink(public_path($influentialReview->image));
                }
  
                $influentialReview->image = $location;
            }
        }

        $influentialReview->save();
        return redirect()->route('influentialReview.index')->with('message','Inflential Review  Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $influentialReview = InfluentialReview::findOrFail($id);
        $influentialReview->delete();
        return redirect()->back()->with('message','Influential Review Trashed Successfully');
    }


    public function status ($id){
        $influentialReview = InfluentialReview::findOrFail($id);
        if($influentialReview->status == 0){
            $influentialReview->status = 1;
            $influentialReview->save();
            return redirect()->back()->with('message','Influential Review Active Successfully');
         }else{
            $influentialReview->status = 0;
            $influentialReview->save();
            return redirect()->back()->with('message','Influential Review Inactive Successfully');
         }
    }

    public function trashItems(){
        $influentialReviews = InfluentialReview::onlyTrashed()->get();
        $totalInfluentialReview = InfluentialReview::withTrashed()->count();
        $totalTrashed = InfluentialReview::onlyTrashed()->count();
        return view('admin.influentialReview.influentialReviewTrash',compact('influentialReviews', 'totalInfluentialReview', 'totalTrashed'));
    }


    public function restore($id){
        $influentialReview = InfluentialReview::withTrashed()->findOrFail($id);
        $influentialReview->restore();
        return redirect()->back()->with('message','Influential Review Restore Successfully');
    }


    public function parmanentDelete($id){
        $influentialReview = InfluentialReview::withTrashed()->findOrFail($id);
        if (file_exists(public_path($influentialReview->image))) {
            unlink(public_path($influentialReview->image));
        }
        $influentialReview->forceDelete();
        return redirect()->back()->with('message','Influential Review Parmanent Deleted Successfully');
    }
}
