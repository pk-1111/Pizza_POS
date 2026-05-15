<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    // change password
    public function changePasswordPage(){
         return view('user.userProfile.changePasswordProfile');
    }

     // edit user profile

    public function profile(){
        return view('user.userProfile.userProfile');
    }

    // edit user profile

    public function editProfile(){
        return view('user.userProfile.editProfile');
    }

     // update profile

    public function updateProfile(Request $request){
      $this->profileValidationCheck($request);


       $data =  $this->requestProfileData($request);

    if($request->hasFile('image')) {



        //delete old image

        if(Auth::user()->profile != null ){
            if(file_exists(public_path('profile/' . Auth::user()->profile))){
                unlink(public_path('profile/' . Auth::user()->profile)) ;
            }
        }

        //storage new image

        $fileName = uniqid() . $request->file('image')->getClientOriginalName();
        $request->file('image')->move(public_path() . '/profile/',$fileName);
        $data['profile'] = $fileName;
    }else{
           $data['profile'] =  Auth::user()->profile ;
       }

        User::where('id' , Auth::user()->id )->update($data);

         Alert::success('Profile Change', 'Profile Change Successfully...');


                 return to_route('user#useraccountProfile');

    }

     // request user profile data

    private function requestProfileData($request){

        return [
            'name' => $request->userName,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address
        ];

    }

    // check profile validation

    private function profileValidationCheck($request) {
        $request->validate([

            'userName' => 'required',
            'email' => 'required|unique:users,email,'.Auth::user()->id,
            'phone' => 'required|min:8|max:15|unique:users,phone,'.Auth::user()->id ,
            'address'  => 'required',
            'image' => 'mimes:png,jpg,jpeg,svg|file'

        ],[
            'userName'  => 'ကျေးဇူးပြူ၍ အမည် ထည့်သွင်းပါ',
            'email' => 'ကျေးဇူးပြူ၍  အီးမေးလိပ်စာ ထည့်သွင်းပါ' ,
            'phone' =>  'ကျေးဇူးပြူ၍  ဖုန်းနံပါတ် ထည့်သွင်းပါ' ,

        ],[
        ]);
    }

    // change Password
    public function changePassword(Request $request){

          $this->passwordValidationCheck($request);

          $currentLoginPassword = auth()->user()->password;

          if(Hash::check($request->oldPassword , $currentLoginPassword)){
               User::where('id',auth()->user()->id)->update([
                 'password' => Hash::make($request->newPassword)
               ]);

                 Alert::success('Password Change', 'Password Change Successfully...');


                 return to_route('userHome');


                //  Auth::logout();

                //  $request->session()->invalidate();
                //  $request->session()->regenerateToken();

                //  return redirect('/');


          }else{
              Alert::success('Error Message', 'Old Password Do Not Match ! Try Again');


                 return back();

          }



          /*
           1. all must be validate

           2. newPassword = confirmPassword
           3. oldPasswrd must be same with current login account password
           4. password change

          */

        //   return view('admin.profile.changePassword');
    }

 // check password validation

    private function passwordValidationCheck($request) {
        $request->validate([

            'oldPassword' => 'required',
            'newPassword' => 'required',
            'confirmPassword' => 'required|same:newPassword|min:6|max:15',
        ]);
    }

}
