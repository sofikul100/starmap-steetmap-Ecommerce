<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\SubCategorie;
use Faker\Core\Number;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use \Yajra\DataTables\DataTables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)

    {
        if ($request->ajax()) {
            $main_thumbnail_path = asset('');
            $products = Product::with('categoy','Subcategory')->get();
            return DataTables::of($products)
                ->addIndexColumn()
                ->editColumn('main_thumbnail', function ($row) use ($main_thumbnail_path) {
                    return '<img src="' . $main_thumbnail_path . '' . $row->main_thumbnail . '" class="img-circle" width="50" height="50">';
                })
                ->addColumn('categoy_name', function (Product $product) {
                    return ucwords('---'.$product->categoy->categoy_name.'---');
                })
                ->addColumn('subcategory_name', function (Product $product) {
                    if(empty($product->Subcategory->subcategory_name)){
                        return 'Empty';
                    }else{
                        return ucwords('-'.$product->Subcategory->subcategory_name.'-');
                    }
                    
                })
                ->editColumn('status',function ($row){
                     if($row->status ==0){
                        return ' <div>
                                <label class="switch">
                                    <input type="checkbox"  data-product_id="' . $row->id . '"  name="status" id="status">
                                    <span class="slider"></span>
                                </label>
                            </div>';
                     }else{
                         return '
                         <div>
                            <label class="switch">
                             <input type="checkbox"   data-product_id="' . $row->id . '" checked  name="status" id="status">
                             <span class="slider"></span>
                            </label>
                           </div>
                         ';
                     }
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '';

                    $actionBtn .= ' <a type="button" href="'. route('product.view',$row->id) .'" class="btn-view btn-xs"><i
                    class="fa fa-eye"></i> 
                    </a>';




                    $actionBtn .= '<a type="button" href="'. route('product.edit',$row->id) .'" class="btn-edit btn-xs"><i
                    class="fa fa-pencil"></i> 
                    </a>';

                    $actionBtn .= '<a type="button" id="TempdeleteButton" data-product_id="'. $row->id .'" class="btn-delete btn-xs"><i
                    class="fa fa-trash"></i> 
                    </a>';

                    return $actionBtn;
                })

                ->rawColumns(['action', 'main_thumbnail','categoy_name','subcategory_name','status'])
                ->make(true);
        } else {
            $products = Product::all();
            $totalProducts = Product::get()->count();
            $totalTrushedProducts = Product::onlyTrashed()->get()->count();
            return view('admin.product.productIndex', compact('products','totalProducts','totalTrushedProducts'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::get();
        $subcategories = SubCategorie::get();
        return view('admin.product.productAdd', compact('categories', 'subcategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $product = new Product();
        $product->product_title = $request->product_title;
        $product->product_code = rand(10000000, 99999999);
        $product->category = $request->category;
        $product->subcategory = $request->subcategory;
        $product->brand = $request->brand;
        $product->selling_price = $request->selling_price;
        $product->discount_price = $request->discount_price;
        $product->video_url = $request->video_url;
        $product->top_review = $request->top_review ?? 0;
        $product->best_sell = $request->best_sell ?? 0;
        $product->exclusive_template = $request->exclusive_template ?? 0;
        $product->status = $request->status ?? 0;
        //=========thumbnail image upload 
        $location_name = 'images/thumbnail_images/'; //change folder name according to the MODEL

        $file = $request->file('main_thumbnail');
        $name = time() . '.' . $file->getClientOriginalExtension();
        $destinationPath = env('PUBLIC_FILE_LOCATION') ? public_path('../' . $location_name) : public_path($location_name);
        $file->move($destinationPath, $name);
        $location = $location_name . $name;
        $product->main_thumbnail = $location;
        $product->save();

        if ($files = $request->file('product_image')) {
            foreach ($files as  $image) {
                $product_image = new ProductImage();
                $location_name = 'images/product_images/'; //change folder name according to the MODEL

                $file = $image;
                $image_name = md5(rand(1000, 10000));
                $name = strtolower($file->getClientOriginalExtension());
                $image_full_name = $image_name . '.' . $name;
                // $name = $time . '.' . $file->getClientOriginalExtension();
                $destinationPath = env('PUBLIC_FILE_LOCATION') ? public_path('../' . $location_name) : public_path($location_name);
                $file->move($destinationPath, $image_full_name);
                $location = $location_name . $image_full_name;
                $product_image->product_image = $location;
                $product_image->product_id = $product->id;
                $product_image->save();
            }
        }
        return redirect()->back()->with('message', 'Product Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    // public function show(string $id)
    // {
    //    
    // }


    public function productViewwithTrashed(string $id){
        $product = Product::withTrashed()->with('categoy','Subcategory','productImage')->findOrFail($id);
        return view('admin.product.productItemShow',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::with('categoy','Subcategory','Brand','productImage')->findOrFail($id);
        $categories = Category::all();
        $brands = Brand::all();
        $subcategories = SubCategorie::all();
        return view('admin.product.productEdit',compact('product','categories','brands','subcategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)

    {
        $request->validate([
            'product_title'=>'required',
            'category'=>'required',
            'selling_price'=>'required',
            'discount_price'=>'required',
            'main_thumbnail'=>'image|mimes:jpg,jpeg,png,svg',
        ]);

        $product = Product::with('productImage')->findOrFail($id);

       

        $product->product_title = $request->product_title;
        $product->product_code = rand(10000000, 99999999);
        $product->category = $request->category;
        $product->subcategory = $request->subcategory;
        $product->brand = $request->brand;
        $product->selling_price = $request->selling_price;
        $product->discount_price = $request->discount_price;
        $product->video_url = $request->video_url;
        $product->top_review = $request->top_review ?? 0;
        $product->best_sell = $request->best_sell ?? 0;
        $product->exclusive_template = $request->exclusive_template ?? 0;
        $product->status = $request->status ?? 0;

        if($request->hasFile('main_thumbnail')){
            $location_name = 'images/thumbnail_images/'; //change folder name according to the MODEL
            $file = $request->file('main_thumbnail');
            $name = time() . '.' . $file->getClientOriginalExtension();
            $destinationPath = env('PUBLIC_FILE_LOCATION') ? public_path('../' . $location_name) : public_path($location_name);
            $file->move($destinationPath, $name);
            $location = $location_name . $name;
            if ($product->main_thumbnail) {
                if (file_exists(public_path($product->main_thumbnail))) {
                    unlink(public_path($product->main_thumbnail));
                }
                $product->main_thumbnail = $location;
            }
        }
        $product->save();


        
        // multiple image update
        if ($files = $request->file('product_image')) {

            $product_image = ProductImage::where('product_id',$id)->get();
          
            
            //-------unlink preview image--------//
            foreach($product_image as $image){
                if (file_exists(public_path($image->product_image))) {
                    unlink(public_path($image->product_image));
                }
                $image->delete();
            }

            foreach ($files as  $image) {
                $location_name = 'images/product_images/'; //change folder name according to the MODEL
                $product_image = new ProductImage();
                $file = $image;
                $image_name = md5(rand(5000, 50000));
                $name = strtolower($file->getClientOriginalExtension());
                $image_full_name = $image_name . '.' . $name;
                $destinationPath = env('PUBLIC_FILE_LOCATION') ? public_path('../' . $location_name) : public_path($location_name);
                $file->move($destinationPath, $image_full_name);
                $location = $location_name . $image_full_name;
                $product_image->product_image = $location;
                $product_image->product_id = $product->id;
                $product_image->save();
            }

            


        }

        return redirect()->back()->with('message', 'Product Updated  Successfully');

        

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $product->delete();
        return response()->json(['success' => true]);
    }


    public function productRestore ($id){
        $product = Product::withTrashed()->findOrFail($id);
        if($product->trashed()) {
            $product->restore();
            return redirect()->back()->with('message', 'Product Restore  Successfully');
        }
        
    }



    public function productPermanentlyDelete ($id){
        $product  = Product::withTrashed()->with('productImage')->findOrFail($id);
        if (file_exists(public_path($product->main_thumbnail))) {
            unlink(public_path($product->main_thumbnail));
        }

        $productImage = ProductImage::where('product_id',$id)->get();

        foreach($productImage as $image){
            if (file_exists(public_path($image->product_image))) {
                unlink(public_path($image->product_image));
            }
        }
        $product->forceDelete();
        return redirect()->back()->with('message', 'Product Parmanently Deleted  Successfully');
    }






    public function changeStatus (Request $request){
        $product = Product::findOrFail($request->product_id);
        $product->status = $request->status;
        $product->save();
        return response()->json(['success' => true]);
    }




    public function getsubCategoryByCategory(Request $request)
    {
        $subcategory = SubCategorie::where('category_id', $request->category_id)->get();
        return response()->json($subcategory);
    }



    public function TrashedItemIndex (){
        $products = Product::onlyTrashed()->with('categoy','Subcategory')->get();
        $totalTrushedProducts = Product::onlyTrashed()->get()->count();
        return view('admin.product.productTrashedItems',compact('totalTrushedProducts','products'));
    }
}


// ->join('categories','products.category','=','categories.id')
//                         ->select('products.*','categories.categoy_name')