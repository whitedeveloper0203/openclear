<?php

namespace App\Http\Controllers\Pages\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use App\User;

class ChangePasswordController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('pages.account.change-password');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required', 'string', 'min:8', 'regex:/[@$!%*#?&]/'],
            'new_confirm_password' => 'required_with:new_password|same:new_password|min:8',
        ],
        [
            'new_password.regex' => 'Must contain at least one special character'
        ]);
   
        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
            
        $data = [
            'messages'    => ['Successfuly changed'],
        ];
        
        return view('pages.account.change-password')->with($data);
    }
}
