<?php

namespace App\Http\Controllers;
use App\Models\UserContact;


class ContactController extends Controller
{

      // admin customer contact page

    public function customerContact(){

     $customer_contacts = UserContact::select('user_name','phone','address','contact_reason','created_at')
                           ->orderBy('user_contacts.created_at','desc')
                          ->get();

        return view('admin.contact.customer_contact',compact('customer_contacts'));
    }
}
