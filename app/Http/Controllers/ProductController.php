<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;
use App\Models\Discount;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    // admin add products page
    public function addProducts(){

        $categories = Category::get();

        return view('admin.products.addProducts',compact('categories'));
    }


    // admin create product
    public function addProductsCreate(Request $request){
        $this->checkProductValidation($request,"create");
       $product = $this->getProductData($request);


       if($request->hasFile('image')){
         $fileName = uniqid() . $request->file('image')->getClientOriginalName();
         $request->file('image')->move(public_path() . '/product/',$fileName);
         $product['image'] = $fileName;
       }

       $newProduct = Product::create($product);
       if($request->rate != null){

        Discount::create([
        'product_id' => $newProduct->id,
        'rate' => $request->rate
       ]);

       }

        Alert::success('Product Create', 'Product Created Successfully...');


                 return to_route('List#productsList');

    }


    





    // check product validation
    public function checkProductValidation($request,$action){
        $rules =[
            'name'  => 'required|unique:products,name,' . $request->productId ,
            'categoryId'  => 'required',
            'price'  => 'required|numeric|min:1',
            'stock'  => 'required|numeric|max:999',
            'rate'    => 'required|numeric|min:0',
            'description'  => 'required|max:2000',
        ];

        $rules['image'] = $action == 'create'  ?   'required|mimes:png,jpg,jpeg,webp,svg|file'  :  'mimes:png,jpg,jpeg,webp,svg|file';

        $message = [];

        $request->validate($rules,$message);
    }

     // admin products list page
    public function productsList($amt = 'default'){

        $products = Product::select('categories.title as category_name','products.id','products.name','products.image','products.price','products.category_id','products.stock')
        ->leftJoin('categories','products.category_id','categories.category_id','categories.title as category_name')
        ->when(request('searchKey'),function($query){
            $query->whereAny(['products.name','categories.title'] , 'like', '%'.request('searchKey').'%');

        // dd($products->toArray());

        });



        if($amt != 'default') {
            $products = $products->where('stock',"<=",3);
        }


        $products = $products->orderBy('products.created_at','desc')->get();
        return view('admin.List.productsList',compact('products'));
    }

    //admin update page

    public function updatePage($id){
        $categories = Category::get();
        $product = Product::where('id',$id)->first();

        return view('admin.products.edit',compact('product','categories'));
    }

    //admin update product

    public function update(Request $request){
         $this->checkProductValidation($request,'update');

 $product = $this->getProductData($request);

    $this->checkProductValidation($request,'update');
    $productData = $this->getProductData($request);

     if($request->hasFile('image')){
          // store new image
            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path() . '/product/',$fileName);

            $productData['image'] = $fileName;
        }

      Product::where('id',$request->productId)->update($productData);

         if($request->filled('rate')){
            Discount::updateOrCreate([
              'product_id' => $request->productId,
              'rate' => $request->rate,
            ]);
         }

        Alert::success('Product Update', 'Product Updated Successfully...');

                  return to_route('List#productsList');

    }

    // admin detail product

    public function detailProduct($id){

    $productDetails = Product::select('products.id','products.name','products.price','products.description','products.image','products.stock as available_item','categories.title as category_name')
        ->leftJoin('categories','products.category_id','categories.category_id')
        ->where('id',$id)
        ->first();

        return view('admin.list.productDetail',compact('productDetails'));
    }

    // back product list page



    //delete product

    public function delete($id){
        Product::where('id',$id)->delete();

         Alert::success('Product Delete', 'Product Deleted Successfully...');

          return back();
    }


    //  creat porudct 

//    public function createProduct(Request $request) {

//     $product = Product::create([
//         'name' => $request->name,
//         'price' => $request->price,
//         'category_id' => $request->category_id,
//         'image' => $fileName,
//     ]);

//    }


   // request product data
    private function getProductData($request){
        return [

            'name'         =>  $request->name,
            'price'        =>  $request->price,
            'description'  =>  $request->description,
            'category_id'  =>  $request->categoryId,
            'stock'        =>  $request->stock


        ];
    }




}
