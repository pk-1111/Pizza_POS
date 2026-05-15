<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{


    // category list page
        public function listCategory(){
        $categories = Category::orderBy('created_at','desc')->paginate(5);
        return view('admin.category.listCategory',compact('categories'));
    }

    //create

    public function create(Request $request){
      $this->checkValidation($request);

      Category::create([
        'title'  => $request->categoryName,

      ]);


      Alert::success('Category Create', 'Category Created Successfully...');


      return back();
    }

    // delete

    public function delete($id){
        Category::where('category_id',$id)->delete();


         Alert::success('Category Delete', 'Category Deleted Successfully...');


      return back();
    }


    // update category page


    public function updatePage($id) {



        $category = Category::where('category_id',$id)->first();

        return view('admin.category.update',compact('category'));
    }

     // update category 


    public function update($id, Request $request) {
       $this->checkValidation($request);

        Category::where('category_id',$id)->update([
            'title' => $request->categoryName ,

        ]);


      Alert::success('Category Update', 'Category upated Successfully...');


      return to_route('category#listCategory');
    }

    // check category validation
    private function checkValidation($request){
         $request->validate([
        'categoryName' => 'required'
       ],[
        'categoryName.required' => 'အမျိုုးအစားအမည် လိုအပ်သည်'
       ]);
    }


}
