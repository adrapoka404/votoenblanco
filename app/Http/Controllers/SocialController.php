<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use Laravel\Socialite\Facades\Socialite;
use Exception;
 use Illuminate\Support\Facades\Auth;

class SocialController extends Controller
{
    public function redirectFacebook(){
        return Socialite::driver('facebook')->redirect();
    }

    public function callbackFacebook(){
        try{
            $fbUser = Socialite::driver('facebook')->user();
            $findUser = User::where('fb_id', $fbUser->id)->first();

            if(!$findUser) {
                
                $findUser = User::create([
                    'name'      => $fbUser->name,
                    'email'     => $fbUser->email,
                    'fb_id'     => $fbUser->id,
                    'password'  => encrypt('12345678'),
                ]);
            }

            Auth::login($findUser);
            return redirect()->intended('dashboard');


        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
