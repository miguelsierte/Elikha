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