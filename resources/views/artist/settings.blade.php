@extends ('artistlayouts.master')
        @section('header')
        
        @include('artistinc.navbar')
        <title>App Name - @yield('title')</title>
@endsection
  
        @section('body')
      
        <div class="row">
            <div class="col-4 col-lg-3">
               @include('artistinc.sidebar')
            </div>
            
            <div class="col-8 col-lg-9">
                <span class="border">
                <div class="p-4  pb-5 bg-white rounded">
                    <h2>Settings</h2>
                    <br>
                    <h4>Verification Status</h4>
                    @if($userVerification)
                    <svg xmlns="http://www.w3.org/2000/svg" width="100" height="120" fill="currentColor" class="bi bi-person-check" viewBox="0 0 16 16">
                        <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm1.679-4.493-1.335 2.226a.75.75 0 0 1-1.174.144l-.774-.773a.5.5 0 0 1 .708-.708l.547.548 1.17-1.951a.5.5 0 1 1 .858.514ZM11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z"/>
                        <path d="M8.256 14a4.474 4.474 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10c.26 0 .507.009.74.025.226-.341.496-.65.804-.918C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4s1 1 1 1h5.256Z"/>
                      </svg>
                    <div class="m-1">
                    <h3>Verified</h3>
                </div>
                    @else
                    <svg xmlns="http://www.w3.org/2000/svg" width="100" height="120" fill="currentColor" class="bi bi-person-x" viewBox="0 0 16 16">
                        <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm.256 7a4.474 4.474 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10c.26 0 .507.009.74.025.226-.341.496-.65.804-.918C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4s1 1 1 1h5.256Z"/>
                        <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm-.646-4.854.646.647.646-.647a.5.5 0 0 1 .708.708l-.647.646.647.646a.5.5 0 0 1-.708.708l-.646-.647-.646.647a.5.5 0 0 1-.708-.708l.647-.646-.647-.646a.5.5 0 0 1 .708-.708Z"/>
                      </svg>
                      <div class="m-1">
                    <h3>Unverified</h3>
                    <button class="btn btn-outline-primary"><a href="{{route('artistVerify')}}">Verify Account</a></button>
                </div>
                @endif
                    

                    
                    <br>
                    <br>
                    
                    <div class="container-fluid">
                      <div class="row">
                          
                              
                          </div>
                      </div> 
                      <div class="row">
                          <div class="col-mb-8">
                              
                                  <div class="row no-gutters align-items-center">
                                    <h4>Change Password</h4>
                                      
              
                                  <form action="{{ route('updateartistSetting') }}" method="POST">
                                      @csrf
                                      <div class="card-body">
                                          @if (session('status'))
                                              <div class="alert alert-success" role="alert">
                                                  {{ session('status') }}
                                              </div>
                                          @elseif (session('error'))
                                              <div class="alert alert-danger" role="alert">
                                                  {{ session('error') }}
                                              </div>
                                          @endif
                                          
                                          <div class="forms">
                                          <div class="col-md-5">
                                              <label for="oldPasswordInput" class="form-label">Old Password</label>
                                              <input name="old_password" type="password" class="form-control @error('old_password') is-invalid @enderror" id="oldPasswordInput"
                                                  placeholder="Old Password">
                                              @error('old_password')
                                                  <span class="text-danger">{{ $message }}</span>
                                              @enderror
                                          </div><br>
                                          <div class="col-md-5">
                                              <label for="newPasswordInput" class="form-label">New Password</label>
                                              <input name="new_password" type="password" class="form-control @error('new_password') is-invalid @enderror" id="newPasswordInput"
                                                  placeholder="New Password">
                                              @error('new_password')
                                                  <span class="text-danger">{{ $message }}</span>
                                              @enderror
                                          </div><br>
                                          <div class="col-md-5">
                                              <label for="confirmNewPasswordInput" class="form-label">Confirm New Password</label>
                                              <input name="new_password_confirmation" type="password" class="form-control" id="confirmNewPasswordInput"
                                                  placeholder="Confirm New Password">
                                          </div><br>
                                          <button class="btn btn-outline-primary">Update</button>
                                      </div>
                                  </form>
                              </div>
                          
                      </div>
                  </div>  
              </div>
                </div>
                
            </span>
 
                      </div>     
            </div>
        </span>
    
        
        @endsection