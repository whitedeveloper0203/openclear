@extends('layouts.account')

@section('account-content')

<div class="ui-block">
    <div class="ui-block-title">
        <h6 class="title">Personal Information</h6>
    </div>
    <div class="ui-block-content">
        
        <!-- Personal Information Form  -->
        
        <form method="POST" action="{{ route('personal-info') }}">
            <div class="row">
        
                <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="form-group label-floating">
                        <label class="control-label">First Name</label>
                        <input class="form-control" placeholder="" type="text" name="first_name" value="{{ $user->first_name }}">
                    </div>
        
                    <div class="form-group label-floating">
                        <label class="control-label">Your Email</label>
                        <input class="form-control" placeholder="" type="email" name="email" value="{{ $user->email }}">
                    </div>
        
                    <div class="form-group date-time-picker label-floating">
                        <label class="control-label">Your Birthday</label>
                        <input name="datetimepicker" name="birthday" value="{{ $personalInfo->birthday }}" />
                        <span class="input-group-addon">
                            <svg class="olymp-month-calendar-icon icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-month-calendar-icon"></use></svg>
                        </span>
                    </div>
                </div>
        
                <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="form-group label-floating">
                        <label class="control-label">Last Name</label>
                        <input class="form-control" placeholder="" type="text" name="last_name" value="{{ $user->last_name }}">
                    </div>
        
                    <div class="form-group label-floating">
                        <label class="control-label">Your Website</label>
                        <input class="form-control" placeholder="" type="text" name="website_url" value="{{ $personalInfo->website_url }}">
                    </div>
        
        
                    <div class="form-group label-floating is-empty">
                        <label class="control-label">Your Phone Number</label>
                        <input class="form-control" placeholder="" type="text" name="phone" value="{{ $personalInfo->phone }}">
                    </div>
                </div>
        
                <div class="col col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="form-group label-floating is-select">
                        <label class="control-label">Your Country</label>
                        <select class="form-control" id="country">
                            <option value="" selected disabled>Select</option>
                            @foreach($countries as $country)
                                <option value="{{$country->id}}"> {{$country->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="form-group label-floating is-select">
                        <label class="control-label">Your State / Province</label>
                        <select class="form-control" id="state" name="state">
                        </select>
                    </div>
                </div>
                <div class="col col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="form-group label-floating is-select">
                        <label class="control-label">Your City</label>
                        <select class="form-control" id="city" name="city">
                        </select>
                    </div>
                </div>
                <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="form-group">
                        <textarea class="form-control" placeholder="Write a little description about you" name="description">{{ $personalInfo->description }}</textarea>
                    </div>
        
                    <div class="form-group label-floating is-select">
                        <label class="control-label">Your Gender</label>
                        <select class="form-control">
                            <option value="MA">Male</option>
                            <option value="FE">Female</option>
                        </select>
                    </div>
        
                </div>
                <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
        
                    <div class="form-group label-floating">
                        <label class="control-label">Your Occupation</label>
                        <input class="form-control" placeholder="" type="text" name="occupation" value="{{ $personalInfo->occupation }}">
                    </div>
        
                    <div class="form-group label-floating is-select">
                        <label class="control-label">Status</label>
                        <select class="form-control">
                            <option value="MA">Married</option>
                            <option value="FE">Not Married</option>
                        </select>
                    </div>

                    <div class="form-group label-floating is-empty">
                        <label class="control-label">Religious Belifs</label>
                        <input class="form-control" placeholder="" type="text" name="religious" value="{{ $personalInfo->religious }}">
                    </div>
    
                </div>
                <div class="col col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="form-group with-icon label-floating">
                        <label class="control-label">Your Facebook Account</label>
                        <input class="form-control" type="text" value="www.facebook.com/james-spiegel95321">
                        <i class="fab fa-facebook-f c-facebook" aria-hidden="true"></i>
                    </div>
                    <div class="form-group with-icon label-floating">
                        <label class="control-label">Your Twitter Account</label>
                        <input class="form-control" type="text" value="www.twitter.com/james_spiegelOK">
                        <i class="fab fa-twitter c-twitter" aria-hidden="true"></i>
                    </div>
                    <div class="form-group with-icon label-floating is-empty">
                        <label class="control-label">Your RSS Feed Account</label>
                        <input class="form-control" type="text">
                        <i class="fa fa-rss c-rss" aria-hidden="true"></i>
                    </div>
                    <div class="form-group with-icon label-floating">
                        <label class="control-label">Your Dribbble Account</label>
                        <input class="form-control" type="text" value="www.dribbble.com/thecowboydesigner">
                        <i class="fab fa-dribbble c-dribbble" aria-hidden="true"></i>
                    </div>
                    <div class="form-group with-icon label-floating is-empty">
                        <label class="control-label">Your Spotify Account</label>
                        <input class="form-control" type="text">
                        <i class="fab fa-spotify c-spotify" aria-hidden="true"></i>
                    </div>
                </div>
                <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                    <button class="btn btn-secondary btn-lg full-width">Restore all Attributes</button>
                </div>
                <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                    <button class="btn btn-primary btn-lg full-width">Save all Changes</button>
                </div>
        
            </div>
        </form>
        
        <!-- ... end Personal Information Form  -->
    </div>
</div>

@endsection

@push('styles')
	
@endpush

@push('scriptsAfter')
    <script src="{{ asset('js/pages/settings/personal-information.js') }}"></script>
@endpush