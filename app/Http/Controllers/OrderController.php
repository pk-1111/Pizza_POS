<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\PaymentHistory;


class OrderController extends Controller
{
    //  order page
    public function adminOrder(){
        $order = Order::select('orders.id','orders.status','orders.order_code','orders.created_at','users.name as user_name')
        ->leftJoin('users','orders.user_id','users.id')
        ->when(request('searchKey'),function($query){
            $query->whereAny(['orders.order_code','users.name'] , 'like', '%'.request('searchKey').'%');
        })
        ->orderBy('orders.created_at','desc')
        ->groupBy('orders.order_code')
        ->get();

        return view('admin.orderBoard.order',compact('order'));
    }

    // order details

    public function details($orderCode){
        $order = Order::select('orders.count as order_count','orders.order_code as order_code','orders.created_at as created_at','products.id as product_id','products.name as product_name','products.price as product_price','products.stock as available_stock','products.image as product_image','users.name as user_name','users.nickname as user_nickname','users.phone as user_phone','users.email as user_email','users.address as user_address')
                               ->leftJoin('products','orders.product_id','products.id')
                               ->leftJoin('users','orders.user_id','users.id')
                               ->where('orders.order_code',$orderCode)
                               ->get();

      $payslipData  = PaymentHistory::where('order_code',$orderCode)->first();

      $confirmStatus = [];
      $status = true ;
      foreach ($order as $item) {
       array_push($confirmStatus,$item->available_stock < $item->order_count ? false : true) ;
      }

       foreach ($confirmStatus as $item) {
           if($item == false){
            $status = false ; break ;
           }
      }

     



    return view('admin.orderBoard.details',compact('order','payslipData','status'));
    }

     // accept pending

    public function changeStatus(Request $request){
              Order::where('order_code',$request->order_code)->update([
                'status'  => $request['status'],
              ]);

              return response()->json([
                'status' => 'success'
              ],200);
    }

    // confirm order

    public function confirmOrder(Request $request){

        // logger($request->all());
          Order::where('order_code',$request[0]['order_code'])->update([
            'status' => 1
          ]);

          foreach ($request->all() as $item) {
            Product::where('id',$item['product_id'])->decrement('stock',$item['order_count']);

          }

          return response()->json([
                'status' => 'success'
              ],200);
    }

     // cancle order

    public function cancleOrder(Request $request){

        // logger($request->all());
          Order::where('order_code',$request['orderCode'])->update([
            'status' => 2
          ]);

            return response()->json([
                'status' => 'success'
              ],200);

        }

}
