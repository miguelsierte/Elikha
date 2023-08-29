@extends('layout.master')
@section('Header')
        
@include('artistinc.navbar')
@include('artistinc.popup')
<style>
  .profile-image img {
  border-radius: 50%;
  max-width: 200px;
  max-height: 200px;
  margin: 50px;
  
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
border-radius: 50%;
}
</style>
@endsection

@section('Body')
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="container container-fluid text-align:center  " style="padding-left:100px; padding-right:100px" >
    <!--<a href="javascript:history.back()"><i class="fa fa-arrow-left"></i> <span><i class="fa fa-arrow-left"></i></span>
        <img src="images/back.png" alt="Image" style="width: 40px; height: 25px;"/></a>-->

<div class="row">
    <div class="col">
    <h2>Edit Profile</h2><br>
    </div>
    <div class="col">
        <h4>Personal Info</h4>
    </div>
    <div class="col">
        <h4>Social Media Links</h4>
    </div>
    
</div>
<div class="row">
 <div class="col" style="text-align: center ">
  <form method="POST" action="{{ route('update') }}" enctype="multipart/form-data">
    @csrf
    @method('Post')
    <div class="profile-image">
        <img id="profile-image" src="{{ asset('images/'.$user->image) }}" alt="{{ $user->name[0] }}" class="default-profile-image">
    </div>
    
    <h6>Edit Profile Picture</h6>
    <input class="form-control" type="file" name="image" id="image">
    
    <script>
      function displayImage() {
        const fileInput = document.getElementById('image');
        const profileImage = document.getElementById('profile-image');
        const file = fileInput.files[0];
        const reader = new FileReader();
    
        reader.onload = function (e) {
          profileImage.src = e.target.result;
        };
    
        reader.readAsDataURL(file);
      }
    
      document.getElementById('image').addEventListener('change', displayImage);
    </script>
    
 </div>
 <div class="col">
   
    <h6>Full Name</h6>
    <input required type="text" name="name" id="name" value="{{$user->name}}" class="form-control"  ><br>
    <h6>Email Address</h6>
    <input required type="email" class="form-control" name="email" id="email" value="{{$user->email}}"  ><br>
    <h6>Mobile Number</h6>
    <input required type="text" class="form-control" name="mobile" id="mobile" value="{{$user->mobile}}" ><br>
    <h6>Bio</h6>
    <textarea type="text" class="form-control" name="bio" id="bio" value="{{$user->bio}}"  rows="6"></textarea>
    <br>
 </div>
 <div class="col">
   
    <h6>Facebook</h6>
    <input required type="text" name="facebook" id="facebook" value="{{$user->facebook}}" class="form-control"  ><br>
    <h6>Instagram</h6>
    <input required type="text" name="instagram" id="instagram" value="{{$user->instagram}}" class="form-control"  ><br>
    <h6>Twitter</h6>
    <input required type="text" name="twitter" id="twitter" value="{{$user->twitter}}" class="form-control"  ><br>
    <br>
    
    <div class="d-grid gap-2 d-md-flex justify-content-center grid text-center">
        <a href="javascript:history.back()"><button class="btn btn-outline-danger" type="button">Cancel</button></a>
    <input class="btn btn-outline-primary" type="submit" value="Save">
    </div>
 </div>
</form>
</div>
</div>


@endsection