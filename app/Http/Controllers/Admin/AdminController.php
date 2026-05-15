<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Order;
use App\Models\PaymentHistory;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    // direct  admin home page

    public function adminHome(){
         $total_sell_amt = number_format( PaymentHistory::sum('total_amt'));

         $order = number_format( Order::where('status',1)->count('status'));

         $user_count = number_format( User::where('role','user')->count('id'));
        return view('admin.home.list',compact('total_sell_amt','order','user_count'));
    }

    
}
