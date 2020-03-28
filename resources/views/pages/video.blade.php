@extends('layouts.app')

@section('content')

@include('includes.header-profile')

<div class="container">
	<div class="row">
		<div class="col col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
			<div class="ui-block">
				<div class="ui-block-title inline-items">
					<div class="btn btn-control btn-control-small bg-yellow">
						<svg class="olymp-trophy-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-trophy-icon"></use></svg>
					</div>
					<h6 class="title">My Featured Video</h6>
					<a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use></svg></a>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="container">
	<div class="row">
		<div class="col col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
			<div class="ui-block">
				<div class="ui-block-title">
					<div class="h6 title">My Videos</div>

					<div class="align-right">
						<a href="#" class="btn btn-primary btn-md-2" data-toggle="modal" data-target="#update-local-video">Upload Video  +</a>
					</div>

					<a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use></svg></a>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="container">
	<div class="row">

		@foreach($videos as $video)
		<div class="col col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
			
			<div class="ui-block video-item">
				<div class="video-player">
					<img src="{{$video->thumbnail_url}}" alt="photo">
					<a href="{{$video->url}}" class="play-video">
						<svg class="olymp-play-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-play-icon"></use></svg>
					</a>
					<div class="overlay overlay-dark"></div>
			
					<div class="more"><svg class="olymp-three-dots-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use></svg></div>
				</div>
			
				<div class="ui-block-content video-content">
					<a href="#" class="h6 title">{{date('Y-m-d', strtotime($video->created_at))}}</a>
					<time class="published" datetime="2017-03-24T18:18">{{$video->duration}}</time><span>sec</span>
				</div>
			</div>
			
		</div>
		@endforeach

	</div>
</div>

<!-- Window-popup Upload Video -->

<div class="modal fade" id="update-local-video" tabindex="-1" role="dialog" aria-labelledby="update-header-photo" aria-hidden="true">
	<div class="modal-dialog window-popup update-header-photo" role="document">
		<div class="modal-content">
			<a href="#" class="close icon-close" data-dismiss="modal" aria-label="Close">
				<svg class="olymp-close-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-close-icon"></use></svg>
			</a>

			<div class="modal-header">
				<h6 class="title">Update Video</h6>
			</div>

			<div class="modal-body">
				<div class="upload-photo-item">
					<h6>Video Title</h6>
					<span>Please describe your video.</span>
					<input class="form-control" id="id-photo-title" type="text" placeholder="">
				</div>

				<div class="upload-photo-item">
					<div class="photo-button-container file-upload">
						<label for="upload" class="file-upload__label">Select video</label>
						<input id="upload" class="file-upload__input file-photo-upload" type="file" accept="video/*" name="file-upload">
					</div>
					<div class="photo-preview-container d-none">
						<video class="w-100" id="blah" src="" ></video>
						<button class="btn btn-primary btn-sm" id="blash-upload">
							<span class="spinner-grow spinner-grow-sm d-none" role="status" aria-hidden="true"></span>
							Upload
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

@push('styles')
	<link href="{{ asset('css/import/import.css') }}" rel="stylesheet">
@endpush

@push('scriptsAfter')
	<script src="{{ asset('js/pages/video/action.js') }}"></script>
@endpush