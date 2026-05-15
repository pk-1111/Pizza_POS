<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    //  direct chage password page

     // direct  admin home page
    public function changePasswordPage(){

          return view('admin.profile.changePassword');
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


                 return to_route('adminHome');


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



    // direct profile


    public function profile(){


        return view('admin.profile.accountProfile');
    }



    // edit profile

    public function profileEdit(){


        return view('admin.profile.profileEdit');
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


                 return to_route('profile#accountProfile');
    }


    // request user profile data

    private function requestProfileData($request){

        return [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address
        ];

    }


    // create new admin account

    public function createNewAdminAccount()  {

        return view('admin.adminAccount.create');

    }

    // create admin account

    public function createAdminAccount(Request $request){

    $this->checkNewAdminAccountValidation($request);

    $data = $this->requestAdminAccountData($request);


    User::create($data);

    Alert::success('Admin Account Create', 'Admin Account Created Successfully...');


                 return to_route('profile#accountProfile');


    }

    // request new admin account validation

    private function requestAdminAccountData($request) {
         return [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
             'role'  => 'admin'

        ];
    }

 // check newAdminAccount validation

    private function checkNewAdminAccountValidation($request) {
        $request->validate([

            'name' => 'required|min:5|max:20',
            'email' => 'required|unique:users,email,'.Auth::user()->id,
            'password' => 'required|min:6|max:15',
            'confirmPassword' => 'required|same:password|min:6|max:15',

        ],[
            'name'  => 'ကျေးဇူးပြူ၍ အမည် ထည့်သွင်းပါ',
            'email' => 'ကျေးဇူးပြူ၍  အီးမေးလိပ်စာ ထည့်သွင်းပါ' ,
            'phone' =>  'ကျေးဇူးပြူ၍  ဖုန်းနံပါတ် ထည့်သွင်းပါ' ,

        ],[
        ]);
    }

     //  admin list

    public function adminList(Request $request)  {

        //searchKey

          $admin = User::select('id','name','email','phone','address','created_at','role','provider')
           ->whereIn('role',['admin','superadmin'])
           ->when(request('searchKey'),function($query){
            $query->whereAny(['name','email','phone','address','provider','role'] , 'like', '%'.request('searchKey').'%');

           })

            ->paginate(6);


        return view('admin.adminAccount.adminList',compact('admin'));

    }


    //delete admin account

    public function delete($id){
        User::where('id',$id)->delete();

         Alert::success('Admin Account Delete', 'Admin Account Deleted Successfully...');

          return back();

    }



//   //delete admin account

//     public function deleteUserList($id){
//         User::where('id',$id)->deleteUserList();

//          Alert::success('User Account Delete', 'User Account Deleted Successfully...');

//           return back();

//     }





    // user list

    public function userList(){
         //searchKey

          $user = User::select('id','name','email','phone','address','created_at','role','provider')
            ->whereIn('role',['user'])
        //    ->when(request('searchKey'),function($query){
        //     $query->whereAny(['name','email','phone','address','provider','role'] , 'like', '%'.request('searchKey').'%');

        //    })

            ->paginate(6);
        return view('user.userList.userList',compact('user'));
    }

    // check profile validation

    private function profileValidationCheck($request) {
        $request->validate([

            'name' => 'required',
            'email' => 'required|unique:users,email,'.Auth::user()->id,
            'phone' => 'required|min:8|max:15|unique:users,phone,'.Auth::user()->id ,
            'image' => 'mimes:png,jpg,jpeg,svg|file'

        ],[
            'name'  => 'ကျေးဇူးပြူ၍ အမည် ထည့်သွင်းပါ',
            'email' => 'ကျေးဇူးပြူ၍  အီးမေးလိပ်စာ ထည့်သွင်းပါ' ,
            'phone' =>  'ကျေးဇူးပြူ၍  ဖုန်းနံပါတ် ထည့်သွင်းပါ' ,

        ],[
        ]);
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
