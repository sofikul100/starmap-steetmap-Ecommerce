<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    protected $primaryKey = 'id';
    protected $fillable =['product_title','product_code','category','subcategory','brand','tags','purches_price','selling_price','discount_price','unit','size','video_url','description','top_review','best_sell','status','exclusive_template'];

    // public static function getSubcategories ($categorie_id){
    //     $subcategories = SubCategorie::where('category_id',$categorie_id)->get();
    //     return $subcategories;
    // }



    public function categoy (){
        return $this->belongsTo(Category::class,'category','id');
    }

    public function Subcategory(){
        return $this->belongsTo(SubCategorie::class,'subcategory','id');
    }


    public function Brand(){
        return $this->belongsTo(Brand::class,'brand','id');
    }


    public function productImage (){
        return $this->hasMany(ProductImage::class,'product_id','id');
    }


    

}
