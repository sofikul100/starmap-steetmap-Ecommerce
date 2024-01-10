<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File; 

class CategorySubcategoryController extends Controller
{
    public function categoryIndex (){
        $categories = Category::orderBy('id','DESC')->get();
        return view('admin.category&subcategory.categoryIndex',compact('categories'));
    }


    public function categoryAdd (){
        return view('admin.category&subcategory.categoryAdd');
    }


    public function categoryStore (Request $request){
        $request->validate([
            'category_name'=>'required',
            'category_image'=>'required|image|mimes:png,jpg,jpeg'
        ]);


        $categorie = new Category();
        $categorie->categoy_name = $request->category_name;
        
        if ($request->hasFile('category_image')) {

            $location_name = 'images/category_images/'; //change folder name according to the MODEL

            $file = $request->file('category_image');
            $name = time() . '.' . $file->getClientOriginalExtension();
            $destinationPath = env('PUBLIC_FILE_LOCATION') ? public_path('../'.$location_name ) : public_path($location_name );
            $file->move($destinationPath, $name);
            $location = $location_name . $name;
            $categorie->category_image = $location;
            $categorie->save();
            return redirect()->back()->with('message','Category Added Successfully');
        }
        

    }

    public function categoryStatus (string $id){
         $categorie = Category::findOrFail($id);
         if($categorie->status == 1){
            $categorie->status = 0;
         }else{
            $categorie->status = 1;
         }

         $categorie->save();
         return redirect()->back()->with('message','Category Status Updated Successfully');
    }



    public function categoryEdit (string $id){
        $categorie = Category::findOrFail($id);
        return view('admin.category&subcategory.categoryEdit',compact('categorie'));
    }



    public function categoryUpdate (Request $request,string $id){
        $request->validate([
            'category_name'=>'required',
            'category_image'=>'image|mimes:png,jpg,jpeg'
        ]);

        $categorie = Category::findOrFail($id);
        $categorie->categoy_name = $request->category_name;

        if ($request->hasFile('category_image')) {

            $location_name = 'images/category_images/'; //change folder name according to the MODEL
  
            $file = $request->file('category_image');
            $name = time() . '.' . $file->getClientOriginalExtension();
            $destinationPath = env('PUBLIC_FILE_LOCATION') ? public_path('../'.$location_name) : public_path($location_name);
            $file->move($destinationPath, $name);
            $location = $location_name . $name;
  
            if ($categorie->category_image) {
  
                if (file_exists(public_path($categorie->category_image))) {
                    unlink(public_path($categorie->category_image));
                }
  
                $categorie->category_image = $location;
            }
        }

        $categorie->save();
        return redirect()->route('category.index')->with('message','Category  Updated Successfully');
    }

    public function categoryDelete(string $id){
        $categorie = Category::findOrFail($id);
        if (file_exists(public_path($categorie->category_image))) {
            unlink(public_path($categorie->category_image));
        }
        $categorie->delete();
        return redirect()->back()->with('message','Category Deleted Successfully');
    }


    //=======subcategory related methods here==============//



    public function subcategoryIndex (){
        //for eluquent
        $subcategories = SubCategorie::with('category')->get();

        // query builder 
        // $subcategories = DB::table('sub_categories')
        //                 ->join('categories','sub_categories.category_id','=','categories.id')
        //                 ->select('sub_categories.*','categories.categoy_name','categories.id')->get();            
        return view('admin.category&subcategory.subcategoryIndex',compact('subcategories'));
    }


    public function subcategoryAdd (){
        $categories = Category::all();
        return view('admin.category&subcategory.subcategoryAdd',compact('categories'));
    }


    public function subcategoryStore (Request $request){
        $request->validate([
            'category_id'=>'required',
            'subcategory_name'=>'required',
            'subcategory_image'=>'required|image|mimes:png,jpg,jpeg'
        ]);


        $subcategorie = new SubCategorie();
        $subcategorie->category_id = $request->category_id;
        $subcategorie->subcategory_name = $request->subcategory_name;
        
        if ($request->hasFile('subcategory_image')) {

            $location_name = 'images/subcategory_images/'; //change folder name according to the MODEL

            $file = $request->file('subcategory_image');
            $name = time() . '.' . $file->getClientOriginalExtension();
            $destinationPath = env('PUBLIC_FILE_LOCATION') ? public_path('../'.$location_name ) : public_path($location_name );
            $file->move($destinationPath, $name);
            $location = $location_name . $name;
            $subcategorie->subcategory_image = $location;
            $subcategorie->save();
            return redirect()->back()->with('message','Subcategory Added Successfully');
        }


    }


    public function subcategoryStatus (string $id){
        $subcategorie = SubCategorie::findOrFail($id);
        if($subcategorie->status == 1){
           $subcategorie->status = 0;
        }else{
           $subcategorie->status = 1;
        }

        $subcategorie->save();
        return redirect()->back()->with('message','Subcategory Status Updated Successfully');
    }



    public function subcategoryEdit(string $id){
        $categories = Category::all();
        $subcategorie = SubCategorie::findOrFail($id)->with('category')->first();
        return view('admin.category&subcategory.subcategoryEdit',compact('categories','subcategorie'));
    }



    public function subcategoryUpdate (Request $request,string $id){
        $request->validate([
            'category_id'=>'required',
            'subcategory_name'=>'required',
            'subcategory_image'=>'image|mimes:png,jpg,jpeg'
        ]);


        $subcategorie = SubCategorie::findOrFail($id);
        $subcategorie->category_id = $request->category_id;
        $subcategorie->subcategory_name = $request->subcategory_name;

        if ($request->hasFile('subcategory_image')) {

            $location_name = 'images/subcategory_images/'; //change folder name according to the MODEL
  
            $file = $request->file('subcategory_image');
            $name = time() . '.' . $file->getClientOriginalExtension();
            $destinationPath = env('PUBLIC_FILE_LOCATION') ? public_path('../'.$location_name) : public_path($location_name);
            $file->move($destinationPath, $name);
            $location = $location_name . $name;
  
            if ($subcategorie->subcategory_image) {
  
                if (file_exists(public_path($subcategorie->subcategory_image))) {
                    unlink(public_path($subcategorie->subcategory_image));
                }
  
                $subcategorie->subcategory_image = $location;
            }
        }

        $subcategorie->save();
        return redirect()->route('subcategory.index')->with('message','Subcategory  Updated Successfully');


    }






    public function subcategoryDelete (string $id){
        $subcategorie = SubCategorie::findOrFail($id);
        if (file_exists(public_path($subcategorie->subcategory_image))) {
            unlink(public_path($subcategorie->subcategory_image));
        }
        $subcategorie->delete();
        return redirect()->back()->with('message','Subcategory Deleted Successfully');
    }




















}
