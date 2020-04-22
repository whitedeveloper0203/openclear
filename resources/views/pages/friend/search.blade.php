@extends('layouts.app')

@section('content')

@include('includes.header-profile')

<div class="container">
	<div class="row">
		<div class="col col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
			<div class="ui-block responsive-flex">
				<div class="ui-block-title">
					<div class="h6 title">Found {{ $users->count() }} results</div>
					<form class="w-search">
						<div class="form-group with-button">
							<input class="form-control" type="text" placeholder="Search Friends...">
							<button>
								<svg class="olymp-magnifying-glass-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-magnifying-glass-icon"></use></svg>
							</button>
						</div>
					</form>
					<a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use></svg></a>
				</div>
			</div>
		</div>
	</div>
</div>


<!-- Friends -->

<div class="container">
	<div class="row">
        @foreach ($users as $user)
        @if (!$user->isAdmin())
		<div class="col col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
			<div class="ui-block">
				
				<!-- Friend Item -->
				
				<div class="friend-item">
					<div class="friend-header-thumb">
						<img src="{{ $user->headerPhoto() }}" alt="friend">
					</div>
				
					<div class="friend-item-content">
				
						<div class="more">
							<svg class="olymp-three-dots-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use></svg>
							<ul class="more-dropdown">
								<li>
									<a href="#">Report Profile</a>
								</li>
								<li>
									<a href="#">Block Profile</a>
								</li>
								<li>
									<a href="#">Turn Off Notifications</a>
								</li>
							</ul>
						</div>
						<div class="friend-avatar">
							<div class="header-avatar-friend">
								<img src="{{ $user->profilePhoto() }}" alt="author">
							</div>
							<div class="author-content">
								<a href="#" class="h5 author-name">{{ $user->fullName() }}</a>
								<div class="country">{{ $user->fullLocation() }}</div>
							</div>
						</div>
				
						<div class="swiper-container" data-slide="fade">
							<div class="swiper-wrapper">
								<div class="swiper-slide">
									<div class="friend-count" data-swiper-parallax="-500">
										<a href="#" class="friend-count-item">
											<div class="h6">{{ $user->getFriendsCount() }}</div>
											<div class="title">Friends</div>
										</a>
										<a href="#" class="friend-count-item">
											<div class="h6">{{ $user->getPhotoCount() }}</div>
											<div class="title">Photos</div>
										</a>
										<a href="#" class="friend-count-item">
											<div class="h6">{{ $user->getVideoCount() }}</div>
											<div class="title">Videos</div>
										</a>
									</div>
									<div class="control-block-button" data-swiper-parallax="-100">
                                        <a class="btn btn-control {{ Auth::user()->canSendFriendRequest($user) ? 'bg-blue btn-add-friend' : 'bg-secondary' }}" 
                                            title="Add Friend" value="{{ $user->id }}">
                                            
                                            <svg class="olymp-happy-face-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-happy-face-icon"></use></svg>
										</a>
				
										<a href="#" class="btn btn-control bg-purple" value="{{ $user->id }}">
											<svg class="olymp-chat---messages-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-chat---messages-icon"></use></svg>
										</a>
				
									</div>
								</div>
				
								<div class="swiper-slide">
									<p class="friend-about text-center" data-swiper-parallax="-500">
										{{ $user->getPersonalDescription() }}
									</p>
								</div>
							</div>
				
							<!-- If we need pagination -->
							<div class="swiper-pagination"></div>
						</div>
					</div>
				</div>
                <!-- ... end Friend Item -->			
            </div>
        </div>
        @endif
        @endforeach
	</div>
</div>

<!-- ... end Friends -->

@endsection

@push('scriptsAfter')
	<script src="{{ asset('js/pages/friends/friend-request.js') }}"></script>
@endpush