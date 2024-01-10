<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()

    {
        $brands = Brand::get();
        return view('admin.brand.brandIndex',['brands'=>$brands]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return view('admin.brand.brandAdd');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'brand_image'=>'required|image|mimes:png,jpg,jpeg'
        ]);

        $brand = new Brand();
        $brand->name = $request->name;
        
        if ($request->hasFile('brand_image')) {

            $location_name = 'images/brand_images/'; //change folder name according to the MODEL

            $file = $request->file('brand_image');
            $name = time() . '.' . $file->getClientOriginalExtension();
            $destinationPath = env('PUBLIC_FILE_LOCATION') ? public_path('../'.$location_name ) : public_path($location_name );
            $file->move($destinationPath, $name);
            $location = $location_name . $name;
            $brand->brand_image = $location;
            $brand->save();
            return redirect()->back()->with('message','Brand Added Successfully');
        }
    }


    public function status (string $id){
        $brand = Brand::findOrFail($id);
         if($brand->status == 1){
            $brand->status = 0;
         }else{
            $brand->status = 1;
         }

         $brand->save();
         return redirect()->back()->with('message','Brand Status Updated Successfully');
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
        $brand = Brand::findOrFail($id);
        return view('admin.brand.brandEdit',['brand'=>$brand]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'=>'required',
            'brand_image'=>'image|mimes:png,jpg,jpeg'
        ]);
        $brand = Brand::findOrFail($id);
        $brand->name = $request->name;

        if ($request->hasFile('brand_image')) {

            $location_name = 'images/brand_images/'; //change folder name according to the MODEL
  
            $file = $request->file('brand_image');
            $name = time() . '.' . $file->getClientOriginalExtension();
            $destinationPath = env('PUBLIC_FILE_LOCATION') ? public_path('../'.$location_name) : public_path($location_name);
            $file->move($destinationPath, $name);
            $location = $location_name . $name;
  
            if ($brand->brand_image) {
  
                if (file_exists(public_path($brand->brand_image))) {
                    unlink(public_path($brand->brand_image));
                }
  
                $brand->brand_image = $location;
            }
        }

        $brand->save();
        return redirect()->route('brand.index')->with('message','Brand  Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $brand = Brand::findOrFail($id);
        if (file_exists(public_path($brand->brand_image))) {
            unlink(public_path($brand->brand_image));
        }
        $brand->delete();
        return redirect()->back()->with('message','Brand Deleted Successfully');
    }
}
