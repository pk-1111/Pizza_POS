<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\ProductController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\UserShopController;
use App\Http\Controllers\User\UserContactController;


Route::group(['prefix' => 'user', 'middleware' => 'user'] ,function(){
    Route::get('home',[UserController::class,'userHome'])->name('userHome');
    //detail shop
    Route::get('details/{id}',[ProductController::class,'details'])->name('userList#details');
    Route::post('addToCart',[ProductController::class,'addToCart'])->name('userList#addToCart');
    Route::get('addToCartPage',[ProductController::class,'addToCartPage'])->name('userList#addToCartPage');
    //api call
    Route::get('addToCard/delete',[ProductController::class,'addToCartDelete'])->name('userList#addToCartDelete');
     Route::get('product/list',[ProductController::class,'productList'])->name('userList#productList');

     // payment

    Route::get('cart/temp',[ProductController::class,'cartTemp'])->name('userList#cartTemp');
    Route::get('payment',[ProductController::class,'userPayment'])->name('userList#userPayment');

    Route::post('order',[ProductController::class,'order'])->name('userList#order');


    Route::get('orderList',[ProductController::class,'orderList'])->name('userList#orderList');


    // comment

      Route::post('comment',[ProductController::class,'comment'])->name('userList#comment');
      Route::get('comment/delete/{id}',[ProductController::class,'deleteComment'])->name('userList#deleteComment');



      // rating

       Route::post('rating',[ProductController::class,'rating'])->name('userList#rating');


       // contact

        Route::get('contact',[UserContactController::class,'contact'])->name('userList#contact');
        Route::post('contactCreate',[UserContactController::class,'contactCreate'])->name('userList#contactCreate');


        //shop

          Route::get('shopPage',[UserShopController::class,'shopPage'])->name('shop#shopPage');

           Route::get('sortingType',[UserShopController::class,'sortingType'])->name('shop#sortingType');









    //editProfile
    Route::get('profile',[ProfileController::class,'profile'])->name('user#useraccountProfile');
    Route::get('edit',[ProfileController::class,'editProfile'])->name('user#editProfile');
    Route::post('update',[ProfileController::class,'updateProfile'])->name('user#updateProfile');


    // change passowrd
       Route::get('changePassword',[ProfileController::class,'changePasswordPage'])->name('user#changePasswordPage');
       Route::post('changePassword',[ProfileController::class,'changePassword'])->name('user#changePassword');



});
