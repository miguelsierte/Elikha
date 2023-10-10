@extends('buyer.master')

@include('buyer.Nav') 
@section('Header')
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

<div class="row">
    <div class="col-3 col-lg-2">
    </div>
    <div class="col-8 col-lg-10">
        <span class="border">
            <div class="p-4 pb-4 bg-white rounded">
                <h2>Settings</h2>

                {{-- Edit Profile Picture Section --}}
                <h4>Edit Profile Picture</h4>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Whops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Display Profile Picture --}}
                
                {{-- Form to Update Profile Picture --}}
                    <form method="POST" action="{{ route('buyer.updateProfilePicture') }}" encty                    <div class="col" style="text-align: center ">
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
e" name="image" id="image">
                    </div>

div>

                    <button type="submit" class="btn btn-outline-primary">Save</button>
                </f
                    

                {{-- Change Password Section --}}
                <h4 class="mt-4">Change Password</h4>                        <form method="POST" action="{{ route('buyer.updateBuyerSetting') }}">
">                            


                    @csrf

                    <div class="mb-3">
                        <label for="oldPasswordInput" class="form-label">Old Password</label>
                        <input name="old_password" type="password" class="form-control @error('old_password') is-invalid @enderror" id="oldPasswordInput" placeholder="Old Password">
                        @error('old_password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="newPasswordInput" class="form-label">New Password</label>
                        <input name="new_password" type="password" class="form-control @error('new_password') is-invalid @enderror" id="newPasswordInput" placeholder="New Password">
                        @error('new_password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="confirmNewPasswordInput" class="form-label">Confirm New Password</label>
                        <input name="new_password_confirmation" type="password" class="form-control" id="confirmNewPasswordInput" placeholder="Confirm New Password">
                    </div>

                    <button type="submit" class="btn btn-outline-primary">Update Password</button>
                </form>
            </div>
        </span>
    </div>
</div>

@endsection