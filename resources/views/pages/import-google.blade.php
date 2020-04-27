@extends('layouts.app')

@section('content')

<!--Videos-->
<div class="container">
    <div class="row">
		<div class="col col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
			<div class="ui-block">
				<div class="ui-block-title">
					<div class="h6 title">Videos</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="container">
	<div class="row">
        @foreach($videos as $video)
		<div class="col col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12" id="video-wrapper-{{$video['id']}}">
			
			<div class="ui-block video-item">
				<div class="video-player">
					<img class="video-thumbnail" src="{{$video['picture']}}" alt="photo">
					<a href="{{$video['source']}}" class="play-video video-link">
						<svg class="olymp-play-icon"><use xlink:href="#olymp-play-icon"></use></svg>
					</a>
					<div class="overlay overlay-dark"></div>
			
					<div class="more"><svg class="olymp-three-dots-icon"><use xlink:href="#olymp-three-dots-icon"></use></svg></div>
				</div>
			
				<div class="ui-block-content video-content">
					<a href="#" class="h6 title">{{date('Y-m-d', strtotime($video['created_time']))}}</a>
					<time class="published video-duration" datetime="2017-03-24T18:18">{{$video['length']}}</time><span>sec</span>

					@if (alreadyImported(Auth::user(), $video['id']))
						<button class="btn btn-sm disabled float-right" type="submit">Imported</button>
					@else
						<button class="btn btn-sm btn-blue import-video float-right" type="submit" id="{{$video['id']}}">
							<span class="spinner-grow spinner-grow-sm d-none" role="status" aria-hidden="true"></span>
							Import
						</button>
					@endif
				</div>
			</div>
			
		</div>
        @endforeach
	</div>
</div>

<!--Photos-->
<div class="container">
    <div class="row">
		<div class="col col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
			<div class="ui-block">
				<div class="ui-block-title">
					<div class="h6 title">Photos</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="container">
	<div class="row">
		<div class="col col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
			<!-- Tab panes -->
            <div class="photo-album-wrapper">
                
                @foreach($photos as $photo)
                <div class="photo-album-item-wrap col-4-width" id="photo-wrapper-{{$photo['id']}}">
                    
                    <div class="photo-album-item" data-mh="album-item" style="height: 424.172px;">
                        <div class="photo-item">
                            <img src="{{$photo['images'][0]['source']}}" alt="photo">
                            <div class="overlay overlay-dark"></div>
                        </div>
                    
                        <div class="content">
                            <a href="#" class="title h5">{{$photo['alt_text']}}</a>
                            <span class="sub-title">{{date('Y-m-d', strtotime($photo['created_time']))}}</span>

							@if (alreadyImported(Auth::user(), $photo['id']))
								<button class="btn btn-sm disabled" type="submit">Imported</button>
							@else
								<button class="btn btn-sm btn-blue import-photo" type="submit" id="{{$photo['id']}}">
									<span class="spinner-grow spinner-grow-sm d-none" role="status" aria-hidden="true"></span>
									Import
								</button>
							@endif
                        </div>
                    </div>

                </div>     
                @endforeach
            </div>

		</div>
	</div>
</div>

<!--Friends-->
<div class="container">
    <div class="row">
		<div class="col col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
			<div class="ui-block">
				<div class="ui-block-title">
				    <div class="h6 title">Friends</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="container">
	<div class="row">
        @foreach($friends as $friend)
		<div class="col col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="ui-block">
                
                <div class="birthday-item inline-items">
                    <div class="author-thumb">
                        <img src="img/avatar2-sm.jpg" alt="author">
                    </div>
                    <div class="birthday-author-name google-friend-container" style="width: 50%;">
                        <a href="#" class="h6 author-name friend-name">{{ $friend['title'] }} </a>
                        <div class="birthday-date friend-email">{{ $friend['email'] }}</div>
                    </div>
                    <a href="javascript:void(0)" class="btn btn-sm bg-blue google-friend-request">Request</a>
                </div>
            
            </div>
        </div>
        @endforeach
    </div>
</div>

<!--Friends-->
<div class="container">
</div>

@endsection

@push('styles')
	<link href="{{ asset('css/import/import.css') }}" rel="stylesheet">
@endpush

@push('scriptsAfter')
	<script src="{{ asset('js/pages/import/google-action.js') }}"></script>
@endpush