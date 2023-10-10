@extends ('artistlayouts.master')
@section('header')
        
@include('artistinc.navbar')
@include('artistinc.popup')
        <title>Home - @yield('title')</title>
@endsection
  
        @section('body')
      <body style="font-family:Helvetica Neue">
        <div class="row">
            <div class="col-4 col-lg-3">
               @include('artistinc.sidebar')
            </div>
            
            <div class="col-8 col-lg-9">
                <span class="border">
                <div class="p-3 pb-5 bg-white rounded">
                    
                    <h3>IMPORTANT</h3>
                    <br>
                    
                    <br>
                    
                    <div class="row grid text-center">
                        <div class="col-sm-4 p-2 text-align: center">
                            <h2>{{$activeArtworksCount}}</h2>
                            <p>Active Artworks</p>
                            
                        </div>
                        <div class="col-sm-4 p-2 text-align: center">
                            <h2>{{$pendingArtworksCount}}</h2>
                            <p>Pending Artworks</p>
                        </div>
                        <div class="col-sm-4 p-2 text-align: center">
                            <h2>{{$soldArtworksCount}}</h2>
                            <p>Sold Artworks</p>
                        </div>
                        
                      </div>
                </div>
                
            </span>
            
                    <br>
                    <div class="row grid text-center">
                        <div class="col-sm-4 p-2"><h4>Engagements</h4>  
                            <br>
                        <img class="engage" src="artistimg/icon metro-chart-line.png" alt="..." height="105" width="105">
                        <div class="m-1">
                        <h3>---</h3>
                        <p>have seen your posts</p>
                        </div>
                    </div>
                        <div class="col-sm-4 p-2"><h4>Profile Views</h4> <br>
                            <img class="view" src="artistimg/icon metro-eye.png" alt="..." height="80" width="120">
                            <div class="m-1">
                            <h3>---</h3>engagements
                            <p>have viewed your profile</p>
                        </div>
                        </div>
                        
                        <div class="col-sm-4 p-2"><h4>Status</h4>
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
                        </div>
                        @endif

                        </div>
                      </div>     
            </div>
        </span>
        </div>
        </div>
        </div>
        
        @endsection