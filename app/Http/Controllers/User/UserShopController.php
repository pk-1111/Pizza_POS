<?php

namespace App\Http\Controllers\User;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserShopController extends Controller
{
    // shop

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



    public function sortingType(Request $request)
{
    // ၁။ Query အခြေခံ တည်ဆောက်ခြင်း
    // Category Name ပါ တစ်ခါတည်းသိချင်ရင် Join သုံးထားတာ ပိုကောင်းပါတယ်
   
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

    // ၄။ Sorting (A-Z, Price Low to High စသည်ဖြင့်)
    $sortColumn = 'products.created_at'; // Default sort
    $sortDirection = 'desc';

    if ($request->filled('sortingType')) {
        $sortData = explode(',', $request->sortingType); // "name,asc" ကို split လုပ်တာပါ
        if (count($sortData) == 2) {
            $sortColumn = 'products.' . $sortData[0];
            $sortDirection = $sortData[1];
        }
    }

    $products = $products->orderBy($sortColumn, $sortDirection)->get();

     return view('user.shop.shopPage',compact('products'));
}



}
