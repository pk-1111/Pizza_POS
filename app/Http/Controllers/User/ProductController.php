<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Rating;
use App\Models\Comment;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Discount;
use App\Models\ActionLog;
use Illuminate\Http\Request;
use App\Models\PaymentHistory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    // product details
    public function details($id){
        $product = Product::select('products.id','products.name','products.price','products.description','products.image','products.stock as available_item','categories.title as category_name')
        ->leftJoin('categories','products.category_id','categories.category_id')
        ->where('id',$id)
        ->first();

        $productList = Product::select('products.id','products.name','products.price','products.description','products.image','categories.title as category_name')
        ->leftJoin('categories','products.category_id','categories.category_id','categories.title as category_name')
        ->where('categories.title',$product['category_name'])
        ->where('products.id','!=',$product['id'])
        ->get();

        $comment = Comment::select('comments.*','users.name as user_name','users.profile as user_profile')
                            ->leftJoin('users','comments.user_id','users.id')
                            ->where('comments.product_id',$id)
                            ->orderBy('comments.created_at','desc')
                            ->get();

        $rating = Rating::where('product_id',$id)->avg('count');

        $user_rating = Rating::where('product_id',$id)->where('user_id',Auth::user()->id)->first('count');

        $user_rating  = $user_rating == null ? 0 : $user_rating['count'];


        // activity logs

        $this->actionLogAdd(Auth::user()->id , $id , 'seen');


        // view count

        $view_count = ActionLog::where('product_id',$id)->where('action','seen')->get();

        $view_count =count($view_count);


        return view('user.userList.details',compact('product','productList','comment','rating','user_rating','view_count'));
    }

    // add to card

    public function addToCart(Request $request){
       Cart::create([
         'user_id' => $request->userId,
         'product_id' => $request->productId,
         'qty'      => $request->count
       ]);

       // activity logs

        $this->actionLogAdd($request->userId, $request->productId, 'addToCart');

        return to_route('userHome');
    }


    // add to cart page


    public function addToCartPage(Request $request){
        $cart = Cart::select('products.id as product_id','carts.id as cart_id','products.image','products.name','products.price','products.description','products.category_id','carts.qty','categories.title as category_name')
                     ->leftJoin('products','carts.product_id','products.id')
                     ->leftJoin('categories','products.category_id','categories.category_id','categories.title as category_name')
                     ->where('carts.user_id',Auth::user()->id)
                     ->get();

        $total =0;

        foreach($cart as $item){

          if ( $item['category_name'] == 'Vegetarian'){
            $finalPrice = $item->price * 0.7 ;
          }else{
            $finalPrice =$item->price;
          }




            $total += $finalPrice * $item->qty;
        }

        return view('user.userList.addCart',compact('cart','total'));
    }


    // cart delete
    public function addToCartDelete(Request $request){

       $cartId = $request->cartId;


       Cart::where('id',$cartId)->delete();

        return response()->json([
                'status' => 'success',
                'message' => 'cart delete successfully'
            ],200);

    }
      // http://127.0.0.1:8000/user/product/list    api list
     public function productList(){
            $product = Product::get();

            return response()->json([
                'data' => $product ,
                'status' => 'success'
            ],200);
    }


    // payment

    public function cartTemp(Request $request){
        $orderArr = [];


         foreach($request->all() as $item){
           array_push($orderArr,[
             'user_id'  =>$item['user_id'],
            'product_id'  =>$item['product_id'],
            'count'   =>  $item['qty'],
            'status'  => 0 ,
            'order_code'  =>$item['order_code'],
            'total_amount' => $item['total_amount']
           ]);
         }

         Session::put('tempCart',$orderArr);
         return response()->json([
            'status'  => 'success'
         ],200);
    }

    public function userPayment(){
          $payments = Payment::orderBy('type','asc')->get();
          $orderProduct = Session::get('tempCart');

        return view('user.userList.payment',compact('payments','orderProduct'));


        // {
        //     payment_name : $paymentName ,
        //     amt : {
        //         amount : $amount
        //     }
             //bank  card ,name,amount,bank
        // }
    }


    //  order

    public function order(Request $request){
       $request->validate([

          'name'  => 'required',
          'phone'  => 'required',
          'address'  => 'required',
          'paymentType'  => 'required',
          'payslipImage'  => 'required',

       ]);

     // store payslip history


      $paymentHistoryData = [
        'user_name' => $request->name,
        'phone' => $request->phone,
        'address' => $request->address,
        'payslip_image'  => $request->payslipImage,
        'payment_method' => $request->paymentType,
        'order_code' => $request->orderCode,
        'total_amt' => $request->totalAmount

      ];

      if($request->hasFile('payslipImage')){
        $fileName = uniqid() . $request->file('payslipImage')->getClientOriginalName();
        $request->file('payslipImage')->move(public_path() . '/payslip/' , $fileName);
        $paymentHistoryData['payslip_image'] = $fileName;
      }

      PaymentHistory::create($paymentHistoryData);


      // order and clear cart

         $orderProduct = Session::get('tempCart');

         foreach($orderProduct as $item){
            Order::create([

                'user_id' => $item['user_id'],
                'product_id' => $item['product_id'],
                 'count' => $item['count'],
                 'status' => $item['status'], // 0 -> pending | 1 -> confirm | 2 -> reject
                 'order_code' => $item['order_code']

            ]);

            Cart::where('user_id',$item['user_id'])->where('product_id',$item['product_id'])->delete();

         }

         Alert::success('Order', 'Order Successfully...');

         return to_route('userList#orderList');

    }


    // orderList

    public function orderList(){
        $order = Order::where('user_id',Auth::user()->id)
                 ->groupBy('order_code')
                 ->orderBy('created_at','desc')
                 ->get();
        return view('user.userList.orderList',compact('order'));
    }


    // customer commet

    public function comment(Request $request) {

     $request->validate([
        'comment' => 'required'
     ]);

     if($request->commentId) {
        Comment::where('id',$request->commentId)->update([
           'product_id'  => $request->productId ,
        'user_id'   =>  Auth::user()->id,
        'message'   =>  $request->comment
        ]);

        return back()->with(['updateSuccess' => 'Edit Success']);
     }else{

        Comment::create([
        'product_id'  => $request->productId ,
        'user_id'   =>  Auth::user()->id,
        'message'   =>  $request->comment
      ]);

        $this->actionLogAdd( Auth::user()->id, $request->productId, 'comment');


      return back();

     }


    }

    // delete comment

    public function deleteComment($id){
        Comment::where('id',$id)->delete();
        return back();
    }

    // edit comment page

     public function editCommentPage(){

        return view('user.comment.editComment');
    }




    public function rating(Request $request) {

        Rating::updateOrCreate([
            'user_id'  => Auth::user()->id ,
             'product_id' =>$request->productId,
        ],[

            'count'  => $request->productRating
        ]);

            $this->actionLogAdd( Auth::user()->id, $request->productId, 'rating');

        return back();

    }
 
    // action log process
    private function actionLogAdd($user_id,$product_id , $action){
       ActionLog::create([
           'user_id'  => $user_id,
           'product_id'  => $product_id,
           'action'  => $action
        ]);

    }



}
