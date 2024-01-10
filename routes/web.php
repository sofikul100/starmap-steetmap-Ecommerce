<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategorySubcategoryController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\CustomerReview;
use App\Http\Controllers\CustomerReviewController;
use App\Http\Controllers\InfluentialReviewController;
use App\Http\Controllers\OrderProcessController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RolePermissionController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    //users routes=========//
    Route::get('/users',[ProfileController::class,'userIndex'])->name('user.index');
    Route::get('/user-add',[ProfileController::class,'userAdd'])->name('user.add');
    Route::post('/user-store',[ProfileController::class,'userStore'])->name('user.store');
    Route::get('/user-edit/{id}',[ProfileController::class,'userEdit'])->name('user.edit');
    Route::post('/user-update/{id}',[ProfileController::class,'userUpdate'])->name('user.update');
    Route::get('/user-view/{id}',[ProfileController::class,'userView'])->name('user.view');
    Route::delete('/user-destroy/{id}',[ProfileController::class,'userDestroy'])->name('user.destroy');
    Route::get('/user-trashed-items',[ProfileController::class,'userTrashedItems'])->name('user.trashed.items');

    Route::get('/user-restore/{id}',[ProfileController::class,'userRestore'])->name('user.restore');
    Route::delete('/user-parmanent-delete/{id}',[ProfileController::class,'userParmanentDelete'])->name('user.parmanent.delete');

    // change password
    Route::get('/change-password-form',[ProfileController::class,'changePassword'])->name('change.password.form');
    Route::get('/check/current/password',[ProfileController::class,'checkCurrentPassword'])->name('check.current.password');
    Route::post('/update-password',[ProfileController::class,'updatePassword'])->name('update.password');
    //==============Role & Permission Related Routes=============//
    Route::get('/Role-Permission',[RolePermissionController::class,'index'])->name('rolePermission');

    //-----role routes------//
    Route::post('/add-role',[RolePermissionController::class,'addRole'])->name('add.role');

    Route::get('/edit-role',[RolePermissionController::class,'editRole'])->name('edit.role');
    Route::post('/update-role',[RolePermissionController::class,'updateRole'])->name('update.role');
    Route::delete('/delete-role/{id}',[RolePermissionController::class,'deleteRole'])->name('delete.role');

    //------permission routes---------//
    Route::post('/add-permission',[RolePermissionController::class,'addPermission'])->name('add.permission');

    Route::get('/edit-permission',[RolePermissionController::class,'editPermission'])->name('edit.permission');
    Route::post('/update-permission',[RolePermissionController::class,'updatePermission'])->name('update.permission');
    Route::delete('/delete-permission/{id}',[RolePermissionController::class,'deletePermission'])->name('delete.permission');


    // -----role permission route
    Route::get('/assign-permissions-form/{role_id}',[RolePermissionController::class,'assignPermissionForm'])->name('assign.permission.form');
    Route::post('/assign-permission/{role_id}',[RolePermissionController::class,'assignUpdatePermission'])->name('assign.permission.store');
    Route::get('/revoke-permissions/{role_id}',[RolePermissionController::class,'revokePermission'])->name('revoke.permissions');





    //===========category routes here==============//
    Route::get('/category-index',[CategorySubcategoryController::class,'categoryIndex'])->name('category.index');
    Route::get('/category-add',[CategorySubcategoryController::class,'categoryAdd'])->name('category.add');
    Route::post('/category-store',[CategorySubcategoryController::class,'categoryStore'])->name('category.store');
    Route::get('/category-status/{category_id}',[CategorySubcategoryController::class,'categoryStatus'])->name('category.status');
    Route::get('/category-edit/{category_id}',[CategorySubcategoryController::class,'categoryEdit'])->name('category.edit');
    Route::post('/category-update/{category_id}',[CategorySubcategoryController::class,'categoryUpdate'])->name('category.update');
    Route::delete('/category-delete/{category_id}',[CategorySubcategoryController::class,'categoryDelete'])->name('category.delete');
    //==============subcategory routes==============//
    Route::get('/subcategory-index',[CategorySubcategoryController::class,'subcategoryIndex'])->name('subcategory.index');
    Route::get('/subcategory-add',[CategorySubcategoryController::class,'subcategoryAdd'])->name('subcategory.add');
    Route::post('/subcategory-store',[CategorySubcategoryController::class,'subcategoryStore'])->name('subcategory.store');
    Route::get('/subcategory-status/{category_id}',[CategorySubcategoryController::class,'subcategoryStatus'])->name('subcategory.status');
    Route::get('/subcategory-edit/{subcategory_id}',[CategorySubcategoryController::class,'subcategoryEdit'])->name('subcategory.edit');
    Route::post('/subcategory-update/{subcategory_id}',[CategorySubcategoryController::class,'subcategoryUpdate'])->name('subcategory.update');
    Route::delete('/subcategory-delete/{subcategory_id}',[CategorySubcategoryController::class,'subcategoryDelete'])->name('subcategory.delete');


    //==========brand related routes=============//
    Route::resource('/brand',BrandController::class);
    Route::get('/brand-status/{brand_id}',[BrandController::class,'status'])->name('brand.status');

    //=========product related routes here=======//
    Route::resource('/product',ProductController::class);
    Route::get('/getSubcategory-ByCategory',[ProductController::class,'getsubCategoryByCategory'])->name('getSubcategoryByCategory');
    Route::get('/product-status',[ProductController::class,'changeStatus'])->name('product.status');
    Route::get('/product-trashed-items',[ProductController::class,'TrashedItemIndex'])->name('product.trashed.items');
    Route::get('/prouduct/view/{id}',[ProductController::class,'productViewwithTrashed'])->name('product.view');
    Route::get('/product-restore/{id}',[ProductController::class,'productRestore'])->name('product.restore');

    Route::delete('/product-parmanently-delete/{product_id}',[ProductController::class,'productPermanentlyDelete'])->name('product.parmanently.delete');

    //=============coupon routes==========//
    Route::resource('/coupon',CouponController::class);

    Route::get('/coupon-status/{coupon_id}',[CouponController::class,'couponStatus'])->name('coupon.status');
    Route::get('/trashed-coupon-items',[CouponController::class,'couponTrashedItems'])->name('coupon.trashed.items');
    Route::get('/coupon-restore/{id}',[CouponController::class,'couponRestore'])->name('coupon.restore');
    Route::delete('/coupon-parmanent-delete/{id}',[CouponController::class,'couponParmanentlyDelete'])->name('coupon.parmanent.delete');

    //========customer review related routes here========//
    Route::resource('/customerReview',CustomerReviewController::class);
    Route::get('/customerReview-trashed-items',[CustomerReviewController::class,'customerReviewTrashedItems'])->name('customerReview.trashed.items');
    Route::get('/customerReview-status/{customer_id}',[CustomerReviewController::class,'status'])->name('customerReview.status');
    Route::get('/customerReview-restore/{id}',[CustomerReviewController::class,'customerReviewRestore'])->name('customerReview.restore');
    Route::delete('/customerReview-parmanent-delete/{id}',[CustomerReviewController::class,'customerReviewParmanentDelete'])->name('customerReview.parmanent.delete');
    Route::get('/customerReview-view/{id}',[CustomerReviewController::class,'customerReviewView'])->name('customerReview.view');

    //==========Influential review related routes===========//

    Route::resource('/influentialReview', InfluentialReviewController::class);
    Route::get('/influential-review-status/{id}',[InfluentialReviewController::class,'status'])->name('influentialReview.status');
    Route::get('/influential-review-trash-items',[InfluentialReviewController::class,'trashItems'])->name('influentialReview.trashed.items');
    Route::get('/influential-review-restore/{id}',[InfluentialReviewController::class,'restore'])->name('influentialReview.restore');
    Route::delete('/influential-review-parmanent-delete/{id}',[InfluentialReviewController::class,'parmanentDelete'])->name('influentialReview.parmanent.delete');



    //=========== all order routes here===========//
    Route::resource('/order',OrderProcessController::class);

    Route::get('/get-single-order',[OrderProcessController::class,'getSingleOrder'])->name('get.single.order');
    Route::get('/order-trash',[OrderProcessController::class,'orderTrashed'])->name('order.trash');
    Route::post('/orde-change-status',[OrderProcessController::class,'orderStatusChange'])->name('order.change.status');
    Route::get('/bulk-status-change',[OrderProcessController::class,'bulkactionAllOrders'])->name('bulk.status.change'); 

    Route::get('/show-trashed-items',[OrderProcessController::class,'showTrashed'])->name('order.show.trashed.items');
    Route::get('/order-restore',[OrderProcessController::class,'orderRestore'])->name('order.restore');

    Route::get('/bulk-status-change-for-trashed',[OrderProcessController::class,'orderBulkForTrashed'])->name('/bulk-status-change-for-trashed');

    Route::get('/order-parmanent-delete',[OrderProcessController::class,'orderParmanentDelete'])->name('order.parmandent.delete');

    // ============ order tab / all order status ============//
    Route::get('/all-order-status-list-tab',[OrderProcessController::class,'allOrderStatusTab'])->name('order.status.list.tab');
    // ===========end draft  ===========//
    //========ajax=====//
});

require __DIR__.'/auth.php';
