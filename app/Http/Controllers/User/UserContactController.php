<?php

namespace App\Http\Controllers\User;
use App\Models\UserContact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;


class UserContactController extends Controller
{
    // contact direct

    public function contact(){
        return view('user.userList.contact');
    }

     // customer commet

    public function contactCreate(Request $request) {


    $customer_contacts = UserContact::get();



        UserContact::create([
        'user_name'   => $request->name ,
        'phone'       =>  $request->phone ,
        'address'     =>  $request->address ,
        'contact_reason' =>  $request->reason ,

      ]);

        Alert::success('Contact Send', 'Send Successfully...');

        return back();

    }

  
}

