@extends('layouts.account')

@section('account-content')

<div class="ui-block">
    <div class="ui-block-title">
        <h6 class="title">Change Password</h6>
    </div>
    <div class="ui-block-content">

        
        <!-- Change Password Form -->
        
        <form method="POST" action="{{ route('change-password') }}">
            @csrf 

            @foreach ($errors->all() as $error)
                <p class="text-danger">{{ $error }}</p>
            @endforeach 

            @isset($messages)
                @foreach ($messages as $message)
                    <p class="text-success">{{ $message }}</p>
                @endforeach
            @endisset
            
            <div class="row">
        
                <div class="col col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="form-group label-floating">
                        <label class="control-label">Confirm Current Password</label>
                        <input class="form-control" placeholder="" type="password" name="current_password">
                    </div>
                </div>
        
                <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="form-group label-floating is-empty">
                        <label class="control-label">Your New Password</label>
                        <input class="form-control" placeholder="" type="password" name="new_password">
                    </div>
                </div>
                <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="form-group label-floating is-empty">
                        <label class="control-label">Confirm New Password</label>
                        <input class="form-control" placeholder="" type="password" name="new_confirm_password">
                    </div>
                </div>
        
                <div class="col col-lg-12 col-sm-12 col-sm-12 col-12">
                    <div class="remember">
        
                        <div class="checkbox">
                            <label>
                                <input name="optionsCheckboxes" type="checkbox">
                                Remember Me
                            </label>
                        </div>
        
                        <a href="{{ route('password.request') }}" class="forgot">Forgot my Password</a>
                    </div>
                </div>
        
                <div class="col col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <button class="btn btn-primary btn-lg full-width">Change Password Now!</button>
                </div>
        
            </div>
        </form>
        
        <!-- ... end Change Password Form -->
    </div>
</div>

@endsection

@push('styles')
	
@endpush

@push('scriptsAfter')
	
@endpush