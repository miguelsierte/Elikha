@extends ('artistlayouts.master')
        @section('header')
        
        @include('artistinc.navbar')
        @include('artistinc.popup')
        <title>Home - @yield('title')</title>
        <style>
        .art {
          display: block;
          width: 285px;
          height: 285px;
        }
      </style>
@endsection
  
        @section('body')
      
        <div class="row">
            <div class="col-4 col-lg-3">
               @include('artistinc.sidebar')
            </div>
            
            <div class="col-8 col-lg-9">
                <span class="border">
                <div class="p-2 pb-5 bg-white rounded">
                    <h3>My Auctions</h3>
                    <br>
                    <br>
                    <div class="row">
                      @foreach($artwork as $artworks)
                      <div class="col-sm-4 mb-4">
                          <div class="card" style="width: 18rem;">
                              <img src="{{ asset('artworks/'.$artworks->image) }}" alt="" class="art">
                              <div class="card-body">
                                  <h5 class="card-title">{{ $artworks->title }}</h5>
                                  <p class="card-text">{{ $artworks->description }}</p>
                              </div>
                              <ul class="list-group list-group-flush">
                                  <li class="list-group-item">Total Bids: {{ $artworks->total_bids }}</li>
                                  <li class="list-group-item">Highest Bid: ₱{{ $artworks->highest_bid }}</li>
                                  <li class="list-group-item">Duration: {{ $artworks->duration }} days</li>
                              </ul>
                              <div class="card-body">
                                  <div class="d-grid gap-2 col-6 mx-auto">
                                      <button class="btn btn-outline-info" type="button">View</button>
                                  </div>
                              </div>
                          </div>
                      </div>
                      @if($loop->iteration % 3 == 0)
                      </div>
                      <div class="row">
                      @endif
                      @endforeach
                </div>
                
            </span>
            </div>
        </span>
        </div>
        </div>
        </div>
        
        @endsection