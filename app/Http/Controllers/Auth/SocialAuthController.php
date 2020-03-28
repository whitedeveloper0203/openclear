<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Socialite;
use App\User;
use Auth;

class SocialAuthController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Return Socialite Driver
     *
     * @return Socialite::driver
     */
    public function redirect($service)
    {
        return Socialite::driver($service)->redirect();
    }
    
    /**
     *  After success social login
     *
     */

    public function callback($service)
    {
        $user = Socialite::with($service)->user();
        $social_email = $this->getSocialEmail($user, $service);
        $social_user = User::where('email', $social_email) -> first();

        // If the user is already logged in, then redirect to import page
        if ($auther = Auth::user())
        {
            // do what you need to do
            $auther -> social_token = $user->token;
            $auther -> save();
            return redirect('/import-' . $service);
        }

        if ($social_user) 
        {
            $social_user -> social_token = $user->token;
            $social_user -> save();

            Auth::login($social_user);

            if ($social_user -> passed_register) {
                return redirect('/');
            } 
            else {
                return redirect('/account-register');
            }
        } else {
            $new_user = User::create([
                'email' => $social_email,
            ]);
            $new_user->social_token = $user->token;
            $new_user->save();
            
            Auth::login($new_user);
            return redirect('account-register');
        }
    }

    /**
     * Get social email addres
     *
     */
    public function getSocialEmail($user, $service)
    {
        if ($service == 'facebook') {
            return $user['email'];
        } elseif ($service == 'google') {
            return $user['email'];
        } elseif ($service == 'graph') {
            return $user['userPrincipalName'];
        } else {
            return null;
        }
    }

    /**
     *
     */
    public function accountShow()
    {
        $user = Auth::user();
        if ($user->passed_register)
            return redirect('/');
        return view('auth.register', ['user' => $user]);
    }

    /**
     * Update user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    public function accountRegister(Request $data)
    {
        $user = Auth::user();
        $user->first_name = $data->first_name;
        $user->last_name = $data->last_name;
        // $user->email = $data->email;
        $user->password = Hash::make($data->password);
        $user->passed_register = true;
        $user->save();
        return redirect('/');
    }
}