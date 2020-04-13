<!-- Top Header-Profile -->

<div class="container">
	<div class="row">
		<div class="col col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
			<div class="ui-block">
				<div class="top-header">
					<div class="top-header-thumb">
						{{-- <img src="img/top-header1.jpg" alt="nature"> --}}
						<img src="{{ headerPhoto(Auth::user()) }}" alt="nature">
					</div>
					<div class="profile-section">
						<div class="row">
							<div class="col col-lg-5 col-md-5 col-sm-12 col-12">
								<ul class="profile-menu">
									<li>
										<a href="/">Timeline</a>
									</li>
									<li>
										<a href="/about">About</a>
									</li>
									<li>
										<a href="/friends">Friends</a>
									</li>
								</ul>
							</div>
							<div class="col col-lg-5 ml-auto col-md-5 col-sm-12 col-12">
								<ul class="profile-menu">
									<li>
										<a href="/photo">Photos</a>
									</li>
									<li>
										<a href="/video">Videos</a>
									</li>
									<li>
										<div class="more">
											<svg class="olymp-three-dots-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use></svg>
											<ul class="more-dropdown more-with-triangle">
												<li>
													<a href="redirect/facebook">Import From Facebook</a>
												</li>
												<li>
													<a href="redirect/google">Import From Google</a>
												</li>
												<li>
													<a href="#">Report Profile</a>
												</li>
												<li>
													<a href="#">Block Profile</a>
												</li>
											</ul>
										</div>
									</li>
								</ul>
							</div>
						</div>

						<div class="control-block-button">
							<a href="/friend-request" class="btn btn-control bg-blue" title="Friends Request">
								<svg class="olymp-happy-face-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-happy-face-icon"></use></svg>
							</a>

							<a href="/chat-message" class="btn btn-control bg-purple" title="Chat Messages">
								<svg class="olymp-chat---messages-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-chat---messages-icon"></use></svg>
							</a>

							<div class="btn btn-control bg-primary more">
								<svg class="olymp-settings-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-settings-icon"></use></svg>

								<ul class="more-dropdown more-with-triangle triangle-bottom-right">
									<li>
										<a href="#" data-toggle="modal" data-target="#update-profile-photo">Update Profile Photo</a>
									</li>
									<li>
										<a href="#" data-toggle="modal" data-target="#update-header-photo">Update Header Photo</a>
									</li>
									<li>
										<a href="/account-setting">Account Settings</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="top-header-author">
						<a href="/" class="author-thumb header-profile-thumb">
							{{-- <img src="img/author-main1.jpg" alt="author"> --}}
							<img src="{{ profilePhoto(Auth::user()) }}" alt="author">
						</a>
						<div class="author-content">
							<a href="/" class="h4 author-name">{{ Auth::user()->first_name.' '.Auth::user()->last_name }}</a>
							<div class="country">San Francisco, CA</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- ... end Top Header-Profile -->