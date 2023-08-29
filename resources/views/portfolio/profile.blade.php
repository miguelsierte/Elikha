@extends('layout.master')

@section('Header')
@include('artistinc.navbar')
@include('artistinc.popup')
<style>
	.art-wrapper {
		position: relative;
		overflow: hidden;
		margin-bottom: 30px;
	}
	
	.art {
		display: block;
		width: 295px;
		height: 295px;
	}
	
	.overlay {
		position: absolute;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		display: flex;
		align-items: center;
		justify-content: center;
		background-color: rgba(0, 0, 0, 0.5);
		opacity: 0;
		transition: opacity 0.3s ease;
	}
	
	.art-wrapper:hover .overlay {
		opacity: 1;
	}
	
	.btn-hover {
		display: none;
	}
	
	.art-wrapper:hover .btn-hover {
		display: block;
		position: absolute;
		top: 50%;
		left: 50%;
		transform: translate(-50%, -50%);
		z-index: 1;
		color: aliceblue
	}
	.fixed-modal-dialog {
					max-width: 900px; /* Adjust the desired maximum width */
					width: 100%;
					margin: auto;
					}

					.image-container {
					text-align: center;
					}

					.image-container img {
					max-width: 400px;
					height: 400px;
					}

					.image-description {
					margin-top: 10px; /* Adjust the spacing between the image and description */
					}
					.default-profile-image {
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: #3a3a3a;
    color: #ffffff;
    font-size: 100px;
    font-weight: bold;
    border-radius: 50%;
    width: 152px;
    height: 152px;
	
}
.profile-image {
  max-width: 500px;
  max-height: 500px;
}


</style>
@endsection

@section('Body')
<div class="container">
	
<header>
	@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
    <link rel="stylesheet" href={{ asset('css/profile.css')}}>
	<div class="container">

		<div class="profile">

			<div class="profile-image">

				@if($user->image)
				<img src="{{ asset('images/'.$user->image) }}" class="default-profile-image">
			@else
				<div class="default-profile-image">{{ $user->name[0] }}</div>
			@endif
			</div>

			<div class="profile-user-settings">

				<h1 class="profile-user-name">{{ Auth::user()->name }}</h1>
				<a href="editprofile"><button class="btn btn-outline-secondary profile-edit-btn">Edit Profile</button></a>

				
			</div>

			<div class="profile-bio">

				<p>{{ Auth::user()->bio }}</p>
				
			</div>
			<div class="social-media">
				<div class="row">
					<div class="col-sm-1">
					  <a href="{{ Auth::user()->facebook }}">
						<img src="images/fb.png" class="img-fluid" alt="Image 1">
					  </a>
					</div>
					<div class="col-sm-1">
					  <a href="{{ Auth::user()->instagram }}">
						<img src="images/insta.png" class="img-fluid" alt="Image 2">
					  </a>
					</div>
					<div class="col-sm-1">
					  <a href="{{ Auth::user()->twitter }}">
						<img src="images/tweet.png" class="img-fluid" alt="Image 3">
					  </a>
					</div>
				</div>
			</div>
			

		</div>
		<!-- End of profile section -->

	</div>
	<!-- End of container -->

</header>


<Body>

	<div class="container">
		<div class="row">
			<div class="col-lg-4 col-sm-6">
				<div class="art-wrapper">
					<img src="images/plus.png" alt="" class="art">
					<div class="overlay">
						<button type="button" class="btn btn-hover" data-toggle="modal" data-target="#UPLOAD">
							Upload Art
						</button>
					</div>
				</div>
			</div>
			@foreach ($artwork as $artworks)
			<div class="col-lg-4 col-sm-6">
				<div class="art-wrapper">
					<img src="{{ asset('artworks/'.$artworks->image) }}" alt="" class="art">
					<div class="overlay">
						<button type="button" class="btn btn-hover" data-toggle="modal" data-target="#ARTMODAL_{{ $artworks->id }}">
							View Art
						</button>
					</div>
				</div>
			</div>
			
			<!--MOdal-->
			
			<div class="modal fade" id="ARTMODAL_{{ $artworks->id }}" tabindex="-1" role="dialog" aria-labelledby="artmodal" aria-hidden="true">
				<div class="modal-dialog fixed-modal-dialog" role="document">
				  <div class="modal-content">
					<div class="modal-header">
					  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					  </button>
					</div>
					<div class="modal-body">
					  <div class="row">
						<div class="col-6">
						  <div class="image-container">
							<img src="{{ asset('artworks/'.$artworks->image) }}" alt="" class="img-fluid">
						  </div>
						</div>
						<div class="col-6">
						  <H1>{{ $artworks->title }}</H1>
						  <h5>{{ $artworks->user->name }}</h5>
						  <br>
						  <p>Description:</p>
						  <p>{{ $artworks->description }}</p>
						</div>
					  </div>
					  <p style="color: rgba(142, 146, 149, 0.491)">{{ $artworks->dimension }}</p>
					</div>
					<div class="modal-footer">
					  <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
					</div>
				  </div>
				</div>
			</div>			  
			
			@endforeach
			  <!--MOdal for upload-->
			<div class="modal fade" id="UPLOAD" tabindex="-1" role="dialog" aria-labelledby="artmodal" aria-hidden="true" >
				<div class="modal-dialog" role="document">
				  <div class="modal-content">
					<div class="modal-header">
					  <h5 class="modal-title" id="artmodal">Choose What to Upload</h5>
					  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					  </button>
					</div>
					<div class="modal-body" style="text-align: center;">
						<button class="btn btn-outline-primary" type="button" onclick="window.location.href='postitem'">Auction</button>
						<button class="btn btn-outline-primary" type="button" onclick="window.location.href='forsale'">For Sale</button>
						
					</div>
					<div class="modal-footer">
		
					</div>
				  </div>
				</div>
			</div>
			
		</div>
	</div>

</Body>
</div>
@endsection