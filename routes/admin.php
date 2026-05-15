<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProfileController;


Route::group(['prefix' => 'admin' , 'middleware' => 'admin' ] ,function(){
    Route::get('home',[AdminController::class,'adminHome'])->name('adminHome');

    // category

    Route::group(['prefix' => 'category'],function(){
       Route::get('listCategory',[CategoryController::class,'listCategory'])->name('category#listCategory');
       Route::post('create',[CategoryController::class,'create'])->name('category#create');

         //update
         Route::get('update/{id}',[CategoryController::class,'updatePage'])->name('category#updatePage');
         Route::post('update/{id}',[CategoryController::class,'update'])->name('category#update');



       //delete
        Route::get('delete/{id}',[CategoryController::class,'delete'])->name('category#delete');




    });



    // profile

       Route::group(['prefix' => 'profile'],function(){
       Route::get('changePassword',[ProfileController::class,'changePasswordPage'])->name('profile#changePasswordPage');
       Route::post('changePassword',[ProfileController::class,'changePassword'])->name('profile#changePassword');

        Route::get('profile',[ProfileController::class,'profile'])->name('profile#accountProfile');
        Route::get('profileEdit',[ProfileController::class,'profileEdit'])->name('profile#profileEdit');
        Route::post('update',[ProfileController::class,'updateProfile'])->name('profile#updateProfile');

         Route::group(['middleware' => 'superadmin'],function(){
            // new admin account
         Route::get('add/newAdmin',[ProfileController::class,'createNewAdminAccount'])->name('profile#createNewAdminAccount');
         Route::post('add/newAdmin',[ProfileController::class,'createAdminAccount'])->name('profile#createAdminAccount');
         Route::get('admin/list',[ProfileController::class,'adminList'])->name('profile#adminList');
         Route::get('user/list',[ProfileController::class,'userList'])->name('profile#userList');


         //delete
        Route::get('delete/{id}',[ProfileController::class,'delete'])->name('profile#delete');
        // Route::get('delete/{id}',[ProfileController::class,'deleteUserList'])->name('profile#deleteUserList');





         });







     });





    // add products

    Route::group(['prefix' => 'products'],function(){
       Route::get('addProducts',[ProductController::class,'addProducts'])->name('products#addProducts');
       Route::post('addProducts',[ProductController::class,'addProductsCreate'])->name('products#addProductsCreate');
       Route::get('productsList/{amt?}',[ProductController::class,'productsList'])->name('List#productsList');
       Route::get('update/page/{id}',[ProductController::class,'updatePage'])->name('product#updatePage');
       Route::post('update/page',[ProductController::class,'update'])->name('product#update');




       //detail product
         Route::get('detailProduct/{id}',[ProductController::class,'detailProduct'])->name('product#detailProduct');



        //delete
       Route::get('delete/{id}',[ProductController::class,'delete'])->name('product#delete');



    });



     //  payment methods

    Route::group(['prefix' => 'paymentMethod'],function(){
       Route::get('payment',[PaymentController::class,'adminPayment'])->name('paymentMethod#adminPayment');
       Route::post('payment/create',[PaymentController::class,'adminPaymentCreate'])->name('paymentMethod#adminPaymentCreate');
    });

    //  sale information

    Route::group(['prefix' => 'info'],function(){
       Route::get('saleInfo',[Controller::class,'adminSaleInfo'])->name('info#adminSaleInfo');
    });

    //  contact

    Route::group(['prefix' => 'contact'],function(){
       Route::get('customerContact',[ContactController::class,'customerContact'])->name('contact#customerContact');
    });

    //  order

    Route::group(['prefix' => 'orderBoard'],function(){
       Route::get('order',[OrderController::class,'adminOrder'])->name('info#adminOrder');
       Route::get('order/details/{orderCode}',[OrderController::class,'details'])->name('info#details');

       // pending accept

      Route::get('changeStatus',[OrderController::class,'changeStatus'])->name('info#changeStatus');
      Route::get('confirmOrder',[OrderController::class,'confirmOrder'])->name('info#confirmOrder');

      Route::get('cancleOrder',[OrderController::class,'cancleOrder'])->name('info#cancleOrdancle');
    });
});



