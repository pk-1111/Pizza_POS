<?php

namespace App\Http\Controllers\User;

use App\Models\c;
use App\Models\Comment;
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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(c $c)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(c $c)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, c $c)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(c $c)
    {
        //
    }
}

