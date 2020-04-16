<?php

namespace App\Http\Controllers\Pages\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Auth;
use App\Country;
use App\State;
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
        $states = $personalInfo->country_id == null ? [] : Country::find($personalInfo->country_id)->states()->get(); 
        $cities = $personalInfo->state_id == null ? [] : State::find($personalInfo->state_id)->cities()->get();

        $data = [
            'user'    => $user,
            'personalInfo' => $personalInfo,
            'countries' => $countries,
            'states' => $states,
            'cities' => $cities,
        ];
        return view('pages.account.personal-info')->with($data);
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
            'first_name'    => ['required', 'string', 'min:1'],
            'last_name'     => ['required', 'string', 'min:1'],
            'birthday'      => ['string', 'date_format:d/m/Y', 'nullable'],
            'website_url'   => ['string', 'nullable'],
            'phone'         => ['regex:/[0-9]/', 'nullable'],
            'country_id'    => ['numeric', 'nullable'],
            'state_id'      => ['numeric', 'nullable'],
            'city_id'       => ['numeric', 'nullable'],
            'gender'        => ['string', 'nullable'],
            'occupation'    => ['string', 'nullable'],
            'religious'     => ['string', 'nullable'],
            'married'       => ['boolean'],
        ],
        [
            'phone.regex' => 'Phone number format is wrong'
        ]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $personalInfo = $user->personalInfo();
        $countries = Country::all();

        $validator = $this->validator($request->all());
        if ($validator->fails())
        {
            return back()->withInput()->withErrors($validator->messages());
        }
   
        // User update
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->save();

        $personalInfo->website_url  = $request->input('website_url');

        $birthday = str_replace('/', '-', $request->input('datetimepicker'));
        $personalInfo->birthday     = date('Y-m-d', strtotime($birthday));

        $personalInfo->phone        = $request->input('phone');
        $personalInfo->country_id   = $request->input('country_id');
        $personalInfo->state_id     = $request->input('state_id');
        $personalInfo->city_id      = $request->input('city_id');
        $personalInfo->gender       = $request->input('gender');
        $personalInfo->occupation   = $request->input('occupation');
        $personalInfo->religious    = $request->input('religious');
        $personalInfo->married      = $request->input('married');
        $personalInfo->description  = $request->input('description');
        $personalInfo->save();

        $states = $personalInfo->country_id == null ? [] : Country::find($personalInfo->country_id)->states()->get(); 
        $cities = $personalInfo->state_id == null ? [] : State::find($personalInfo->state_id)->cities()->get();

        $data = [
            'messages'  => ['Successfuly changed'],
            'user'      => $user,
            'personalInfo' => $personalInfo,
            'countries' => $countries,
            'states' => $states,
            'cities' => $cities,
        ];
        
        return view('pages.account.personal-info')->with($data);
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
