<?php

namespace App\Http\Controllers;

use App\Models\UserContact;
use Illuminate\Http\Request;

class ContactController extends Controller
{

      // customer contact

    public function customerContact(){

     $customer_contacts = UserContact::select('user_name','phone','address','contact_reason','created_at')
                           ->orderBy('user_contacts.created_at','desc')
                          ->get();

        return view('admin.contact.customer_contact',compact('customer_contacts'));
    }
}
