<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PaymentController extends Controller
{
   //  payment page
    public function adminPayment(){
        $payments = Payment::get();
        return view('admin.paymentMethod.payment',compact('payments'));
    }


    // paymentcreate

    public function adminPaymentCreate(Request $request){
          $this->checkAdminPaymentValidation($request);

         Payment::create([
        'account_number'  => $request->accountNumber,
        'account_name'  => $request->accountName,
        'type'  => $request->accountType,

      ]);


      Alert::success('PaymentMethod Create', 'Category Created Successfully...');


      return back();
    }






    // payment validation

      private function checkAdminPaymentValidation($request) {
        $request->validate([

            'accountNumber' => 'required|digits_between:8,20',
            'accountName' => 'required',
            'accountType' => 'required'


        ],[

        ],[
        ]);
    }
}
