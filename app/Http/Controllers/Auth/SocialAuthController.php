<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Socialite;
use App\User;
use Auth;
use Google_Service_People;

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
        if (Auth::user() && $service == 'google')
            return Socialite::driver($service)->scopes(['openid', 'profile', 'email', Google_Service_People::CONTACTS_READONLY, 'https://www.google.com/m8/feeds'])->redirect();
        
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
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'password' => ['required', 'string', 'min:8', 'confirmed', 'regex:/[@$!%*#?&]/'],
            'password_confirmation' => 'required_with:password|same:password|min:8'
        ],
        [
            'password.regex' => 'Must contain at least one special character'
        ]);
    }

    /**
     * Update user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    public function accountRegister(Request $data)
    {
        $validator = $this->validator($data->all());
        if ($validator->fails())
        {
            return back()->withInput()->withErrors($validator->messages());
        }

        $user = Auth::user();
        $user->password = Hash::make($data->password);
        $user->passed_register = true;
        $user->save();
        return redirect('/');
    }
}