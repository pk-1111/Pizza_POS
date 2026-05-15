<?php

namespace App\Http\Controllers\User;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserShopController extends Controller
{
    // shop page direct 

    public function shopPage($amt = 'default'){

      $products = Product::select('categories.title as category_name','products.id','products.name','products.image','products.price','products.category_id','products.stock')
        ->leftJoin('categories','products.category_id','categories.category_id','categories.title as category_name')
        ->when(request('searchKey'),function($query){
            $query->whereAny(['products.name','categories.title'] , 'like', '%'.request('searchKey').'%');
        });

        if($amt != 'default') {
            $products = $products->where('stock',"<=",3);
        }

        


        $products = $products->orderBy('products.created_at','desc')->get();

        return view('user.shop.shopPage',compact('products'));
    }


    // sorting Type

    public function sortingType(Request $request)
{
   
   
      $products = Product::select('categories.title as category_name','products.id','products.name','products.image','products.price','products.category_id','products.stock')
        ->leftJoin('categories','products.category_id','categories.category_id','categories.title as category_name')
        ->when(request('searchKey'),function($query){
            $query->whereAny(['products.name','categories.title'] , 'like', '%'.request('searchKey').'%');
        });
    // ၃။ Price Filter (Budget Range)
    if ($request->filled('minPrice')) {
        $products = $products->where('products.price', '>=', $request->minPrice);
    }
    if ($request->filled('maxPrice')) {
        $products = $products->where('products.price', '<=', $request->maxPrice);
    }

    //  Sorting (A-Z, Price Low to High)
    $sortColumn = 'products.created_at'; 
    $sortDirection = 'desc';

    if ($request->filled('sortingType')) {
        $sortData = explode(',', $request->sortingType);
        if (count($sortData) == 2) {
            $sortColumn = 'products.' . $sortData[0];
            $sortDirection = $sortData[1];
        }
    }

    $products = $products->orderBy($sortColumn, $sortDirection)->get();

     return view('user.shop.shopPage',compact('products'));
}



}
