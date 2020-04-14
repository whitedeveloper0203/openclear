<?php

namespace App\Http\Controllers\Pages\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;
use App\Country;
use App\State;
use App\City;
use App\UsersPersonalInfo;

class PersonalInfoController extends Controller
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

        $personalInfo = $user->personalInfo();
        
        if (!$personalInfo)
        {
            $personalInfo = new UsersPersonalInfo();
            $personalInfo->user_id = $user->id;
            $personalInfo->save();
        }

        $countries = Country::all();

        $data = [
            'user'    => $user,
            'personalInfo' => $personalInfo,
            'countries' => $countries,
        ];
        return view('pages.account.personal-info')->with($data);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(Request $request)
    {

    }

    /**
     * Get states list by country id
     *
     * @param Request $request
     * @return void
     */
    public function getStateList(Request $request)
    {
        $country_id = $request->country_id;

        $states = Country::find($country_id)->states()->get();
        return response()->json($states);
    }

    /**
     * Get cities list by state id
     *
     * @param Request $request
     * @return void
     */
    public function getCityList(Request $request)
    {
        $state_id = $request->state_id;

        $cities = State::find($state_id)->cities()->get();
        return response()->json($cities);
    }
}
