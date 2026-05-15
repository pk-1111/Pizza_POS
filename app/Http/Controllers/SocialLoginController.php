<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
    // redirect
    public function redirect($provider){
      return Socialite::driver($provider)->redirect();
    }

    // callback
     public function callback($provider){
       $socialUser = Socialite::driver($provider)->user();

      $user = User::updateOrCreate([
        'provider_id' =>  $socialUser->id,
    ], [
        'name' =>  $socialUser->name,
        'nickname' =>  $socialUser->name,
        'email' => $socialUser->email,
        'provider_token' =>  $socialUser->token,
        'provider'  => $provider,
        'role'  => 'user'

    ]);

    Auth::login($user);

   return to_route('userHome');

    }
}
