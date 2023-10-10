@extends('buyer.master')

@section('Header')
@include('artistinc.navbar')
@include('artistinc.popup')
@endsection

@section('Body')
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
<body style="font-family:Helvetica Neue">

<div class="container mt-4">
    <!--pr0file-->
    <br>
   <div class="row">
        <div class="row " style="padding-left: 70px; padding-right:70px">
            <div class="col-3" style="padding-right: 40px">
                <div class="container">
                    @if($user->image)
                        <img src="{{ asset('images/'.$user->image) }}" alt="" class="default-profile-images" style="width: 200px; height: 200px;border-radius: 50%; object-fit: cover;">
                    @else
                        <div class="default-profile-image">{{ $user->name[0] }}</div>
                    @endif
                </div>
                <h1 class="profile-user-name mt-4">{{ Auth::user()->name }}</h1>
                <a href="editprofile"><button class="btn btn-outline-secondary profile-edit-btn">Edit Profile</button></a>
                <p>{{ Auth::user()->bio }}</p>
                <a href="{{ Auth::user()->facebook }}">
                 <img src="{{ asset('images/fb.png') }}" class="img-fluid" alt="Image 1">
                </a>
                <a href="{{ Auth::user()->instagram }}">
                    <img src="{{ asset('images/insta.png') }}" class="img-fluid" alt="Image 2">
                </a>
                <a href="{{ Auth::user()->twitter }}"> 
                    <img src="{{ asset('images/tweet.png') }}" class="img-fluid" alt="Image 3">
                </a>
				
            </div>
            <div class="col-8" style="margin-left: 20px">
                <!-- row for the artworks-->
                <div class="row mt-4">
                    <div class="col-lg-4 col-sm-6" style="margin-bottom: 20px">
                        <div class="container artwork-container">
                            <div class="image-container">
                                <img src="images/plus.png" alt="" class="artwork-buyerview" style="object-fit: cover; border-radius: 10%;">
                                <div class="overlay">
                                    <button type="button" class="btn btn-hover text-white" data-toggle="modal" data-target="#uploadModal">
                                        Upload Art
                                    </button>
                                </div>
                            </div>
                        </div>                        
                    </div>
                    @foreach ($artwork as $artworks)
                        <div class="col-lg-4 col-sm-6" style="margin-bottom: 20px">
                            <div class="container artwork-container">
                                <div class="image-container">
                                    <img src="{{ asset('storage/attachments/'.$artworks->image) }}" alt="" class="artwork-buyerview" style="object-fit: cover; border-radius: 10%;">
                                    <div class="overlay"> 
                                        <p class="overlay-text">{{ $artworks->title }}</p><br>   
                                        <button type="button" class="btn btn-hover text-white" data-toggle="modal" data-target="#ARTMODAL_{{ $artworks->id }}">
                                            View Art
                                        </button>
                                    </div>
                                </div>
                            </div>                        
                        </div>
                    <!--modal-->
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
                                    <img src="{{ asset('storage/attachments/'.$artworks->image) }}" alt="" class="img-fluid">
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
                    <div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="artmodal" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="artmodal">Choose What to Upload</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body" style="text-align: center;">
                                    @if($userVerification)
                                        <!-- User has gcash verification, allow art upload -->
                                        <button class="btn btn-outline-dark" type="button" onclick="window.location.href='postitem'">Auction</button>
                                        <button class="btn btn-outline-dark" type="button" onclick="window.location.href='forsale'">For Sale</button>
                                    @else
                                        <!-- User doesn't have gcash verification, show message and link to artistSettings -->
                                        <p>You need to verify your account first before uploading art.</p>
                                        <button class="btn btn-dark" type="button" onclick="window.location.href='artistVerify'">Go to Verify Account</button>
                                    @endif
                                </div>
                                <div class="modal-footer">
                                    <!-- Footer content if needed -->
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
   </div>

   <style>
    .artwork-buyerview{
        width: 225px;
        height: 225px;
    }
    .image-container{
        width: 225px;
        height: 225px;
    }
    /* Initially hide the overlay and overlay-text */
    .artwork-container .image-container {
        position: relative;
        overflow: hidden;
    }

    .artwork-container .artwork-buyerview {
        transition: filter 0.3s;
    }

    .artwork-container:hover .artwork-buyerview {
        filter: brightness(70%);
    }

    .artwork-container .overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        background-color: rgba(0, 0, 0, 0.5);
        opacity: 0;
        transition: opacity 0.3s;
        border-radius: 10%;
        width: 225px;
        height: 225px;
    }

    .artwork-container:hover .overlay {
        opacity: 1;
    }

    .overlay-text {
        color: white;
        font-size: 16px;
        margin-bottom: 10px;
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
   
</div>

@endsection