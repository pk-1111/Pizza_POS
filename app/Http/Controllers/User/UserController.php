<?php

namespace App\Http\Controllers\User;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    // direct  user home page
    public function userHome($categoryId = null){
        $categories = Category::get();

       // best taste
        $products = Product::select('products.id','categories.title as category_name','products.name','products.price','products.description','products.image')
        ->leftJoin('categories','products.category_id','categories.category_id','categories.title as category_name')
        ->when(request('searchKey')  , function($query){
            $query = $query->where('products.name' , 'like', '%'.request('searchKey').'%');
        } )
        // sort by
         ->when(request('sortingType')  , function($query){
            $sortRule = explode(",",request('sortingType'));
            $sortName = trim('products.'.$sortRule[0]); // products. name,price,created_at
            $sortBy   = isset($sortRule[1])? trim($sortRule[1]) : 'asc'; // asc ,desc
            $query = $query->orderBy($sortName,$sortBy);
        } )
        // search by category
          ->when(request('categoryId'),function($query) {
            $query->where('products.category_id',request('categoryId'));
        })
        // min = true | max = true
        ->when(request('minPrice') != null  && request('maxPrice') != null , function($query){
            $query = $query->whereBetween('products.price',[request('minPrice'),request('maxPrice')]);
        } )
         // min = true | max = false
        ->when(request('minPrice') != null  && request('maxPrice') == null , function($query){
            $query = $query->where('products.price','>=',request('minPrice'));
        } )
        // min = false | max = true
         ->when(request('minPrice') == null  && request('maxPrice') != null , function($query){
            $query = $query->where('products.price','<=',request('maxPrice'));
        } )
       ->get();


       $veggiePizza = Product::where('id',8)->first();
       $products =  Product::select('products.id','categories.title as category_name','products.name','products.price','products.description','products.image')
        ->leftJoin('categories','products.category_id','categories.category_id','categories.title as category_name')
                            ->get();





        return view('user.home.list',compact('products','categories','veggiePizza'));





    }






}
