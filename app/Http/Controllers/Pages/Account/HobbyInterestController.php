<?php

namespace App\Http\Controllers\Pages\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;
use App\Hobby;

class HobbyInterestController extends Controller
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
        $user = Auth::user();
        $hobby = $user->hobby();

        if (!$hobby)
        {
            $hobby = new Hobby();
            $hobby->user_id = $user->id;
            $hobby->save();
        }

        $data = [
            'hobby' => $hobby,
        ];
        return view('pages.account.hobby-interest')->with($data);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $hobby = $user->hobby();

        $hobby->fill($request->all());
        $hobby->save();

        $data = [
            'hobby' => $hobby,
            'messages'  => ['Successfuly changed'],
        ];
        return view('pages.account.hobby-interest')->with($data);
    }
}
