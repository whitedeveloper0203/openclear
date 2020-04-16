@extends('layouts.account')

@section('account-content')

<div class="ui-block">
    <div class="ui-block-title">
        <h6 class="title">Hobbies and Interests</h6>
    </div>
    <div class="ui-block-content">

        
        <!-- Form Hobbies and Interests -->
        
        <form method="POST" action="{{ route('hobby-interest') }}">
            @csrf 

            @isset($messages)
                @foreach ($messages as $message)
                    <p class="text-success">{{ $message }}</p>
                @endforeach
            @endisset

            <div class="row">
        
                <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="form-group">
                        <textarea class="form-control" placeholder="Hobbies" name="txt_hobbies">{{ $hobby->txt_hobbies }}</textarea>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" placeholder="Favourite TV Shows" name="txt_favorite_tv">{{ $hobby->txt_favorite_tv }}</textarea>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" placeholder="Favourite Movies" name="txt_favorite_movie">{{ $hobby->txt_favorite_movie }}</textarea>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" placeholder="Favourite Games" name="txt_favorite_game">{{ $hobby->txt_favorite_game }}</textarea>
                    </div>
        
                    <button class="btn btn-secondary btn-lg full-width">Cancel</button>
                </div>
        
                <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="form-group">
                        <textarea class="form-control" placeholder="Favourite Music Bands / Artists" name="txt_favorite_music">{{ $hobby->txt_favorite_music }}</textarea>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" placeholder="Favourite Books" name="txt_favorite_book">{{ $hobby->txt_favorite_book }}</textarea>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" placeholder="Favourite Writers" name="txt_favorite_writer">{{ $hobby->txt_favorite_writer }}</textarea>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" placeholder="Other Interests" name="txt_other_interest">{{ $hobby->txt_other_interest }}</textarea>
                    </div>
        
                    <button class="btn btn-primary btn-lg full-width">Save all Changes</button>
                </div>
        
            </div>
        </form>
        
        <!-- ... end Form Hobbies and Interests -->

    </div>
</div>

@endsection

@push('styles')
	
@endpush

@push('scriptsAfter')
	
@endpush