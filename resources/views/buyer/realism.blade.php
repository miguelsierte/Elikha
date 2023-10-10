@extends('buyer.master')

@section('Body')
@include('artistinc.popup')
@include('buyer.Nav')
@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="container shop-container">
  <div class="row row0 d-flex justify-content-center align-items-center">
    <div class="row row-container1 shadow-1-strong d-flex rounded mb-4 justify-content-center align-items-center ">
      <div class="col justify-content-center align-items-center ">
        <div class="content text-md-left">
          <h5 style="font-size: 40px; font-family: 'Helvetica Nue';">Get the Latest Art Trends</h5> <br>
        </div>
        
      <style>
        .row0{
          padding-top: 75px;
        }
        .row-container1{
          background: linear-gradient(to right, #9ea2a1, #efece6, #c8cccb, #8d8a8a, #3e4040);
          width: 1300px; 
          height: 300px;
          
        }
        .item1{
          width:80rem ;
          height: 20rem; 
        }
        .no-underline {
    text-decoration: none;
}


      </style>
      </div>
      <!-- Content for the carousel goes here -->
      <div class="col">
        <div id="carouselExampleIndicators" class="carousel slide carousel">
          <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
          </div>
          @if ($highlightsData)
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="{{ asset('storage/images/' . $highlightsData->highlight1) }}" class="carousel-image" alt="...">
            </div>
            <div class="carousel-item">
              <img src="{{ asset('storage/images/' . $highlightsData->highlight2) }}" class="carousel-image" alt="...">
            </div>
            <div class="carousel-item">
              <img src="{{ asset('storage/images/' . $highlightsData->highlight3) }}" class="carousel-image " alt="...">
            </div>
          </div>
          @else
            <p>No highlights data available.</p>
          @endif
        </div>
      </div>
      <script>
        $(document).ready(function () {
          var interval = 5000; 
      
          function autoAdvanceCarousel() {
            $('.carousel').carousel('next'); 
          }
      
          var carouselInterval = setInterval(autoAdvanceCarousel, interval);
      
          $('.carousel').hover(
            function () {
              clearInterval(carouselInterval);
            },
            function () {
              carouselInterval = setInterval(autoAdvanceCarousel, interval);
            }
          );
        });
      </script>      
    </div >

    <div class="row mt-2 row-container2 shadow-1-strong d-flex rounded mb-4 justify-content-center align-items-center ">
      <div class="col-md-4 fixed-column">
        <!-- Content for the fixed left column/ categories goes here -->
        <div class="row">
            <a href="{{url('shopbuyer')}}" class="card card1 homecard text-align-center justify-content-center align-items-center" style="text-decoration: none;">
              <div class="card-text  " >
                <h3>Home</h3>               
              </div>          
            </a>

            <a href="{{url('popart')}}" class="card card1 popcard text-align-center justify-content-center align-items-center" style="text-decoration: none;">
              <div class="card-text" >
                <h3>Pop Art</h3>                
              </div>
            </a>

            <a href="{{url('realism')}}" class="card card1 realismcard text-align-center justify-content-center align-items-center" style="text-decoration: none;">
              <div class="card-text " >
                <h3>Realism</h3>
              </div>
            </a>

            <a href="{{url('portrait')}}" class="card card1 portraitcard text-align-center justify-content-center align-items-center" style="text-decoration: none;">
              <div class="card-text " >
                <h3>Portrait</h3>
              </div>
            </a>
            <a href="{{url('abstract')}}" class="card card1 abstractcard text-align-center justify-content-center align-items-center" style="text-decoration: none;">
              <div class="card-text " >
                <h3>Abstract</h3>
              </div>
            </a>
            <a href="{{url('expressionism')}}" class="card card1 expresscard text-align-center justify-content-center align-items-center" style="text-decoration: none;">
              <div class="card-text " >
                <h5>Expressionism</h5>
              </div>
            </a>
            <a href="{{url('impressionism')}}" class="card card1 impresscard text-align-center justify-content-center align-items-center" style="text-decoration: none;">
              <div class="card-text " >
                <h5>Impressionism</h5>
              </div>
            <a href="{{url('photorealism')}}" class="card card1 landscapecard text-align-center justify-content-center align-items-center" style="text-decoration: none;">
              <div class="card-text " >
                <h5>Photorealism</h5>
              </div>
            </a>
            </a>
            

           
         </div>
        
        <style>
            .carousel-image{
              width: 800px;
              height: 250px;
              object-fit: cover;
            }
            .homecard{
              margin-right: 40px;
            }
          
            .popcard{
              background-image: url('images/popart.png');
              background-size: cover;
              margin-right: 20px;
              
            }

            .realismcard{
              background-image: url('images/realism.png');
              background-size: cover;
            }

            .portraitcard{
              background-image: url('images/portrait.png');
              background-size: cover;
            }

            .abstractcard{
              background-image: url('images/abstract.png');
              background-size: cover;
            }

            .expresscard{
              background-image: url('images/expression.png');
              background-size: cover;
            }
            
            .landscapecard{
              background-image: url('images/landscape.png');
              background-size: cover;
            }
            
            .impresscard{
              background-image: url('images/impression.png');
              background-size: cover;
            }

            .btn:hover {
              background-color: #000000; 
              color: #fff; 
            }

            .card1{
                    width: 150px; 
                    height: 150px; 
                    border-radius: 10px; 
                    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
                    margin-block: 10px;
                    margin-right: 10px;

            }
        </style>

    </div>
    @php
    $sortType = request()->input('sort_type', 'for_sale');
@endphp
    <div class="col">
      <h2>Home</h2>
      <div class="row d-flex">
        <div class="d-flex align-items-center justify-content-between mb-4">
          <div class="col-md-6">
          <form class="d-flex" role="search" action="{{ route('shopbuyer') }}" method="GET">
              <input id="searchInput" class="form-control me-2" type="search" name="search" placeholder="Search artwork" aria-label="Search" value="{{ request('search') }}">
              <button id="searchButton" class="btn btn-outline-dark" type="submit">Search</button>
          </form>
      </div>
        <div class="col-md-6">
          <div class="d-flex justify-content-end">
          <div class="dropdown">
              <button class="btn btn-outline-dark dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Sort
              </button>
              <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="{{ route('shopbuyer', ['sort_type' => 'for_sale', 'search' => request('search')]) }}">For Sale</a></li>
                  <li><a class="dropdown-item" href="{{ route('shopbuyer', ['sort_type' => 'for_auction', 'search' => request('search')]) }}">For Auction</a></li>
              </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="row-md-8 scrollable-row" style="padding-left: 20px">
        <!-- Content for the scrollable right column/ arts goes here -->
        <div class="row mt-4"> 
          <!-- Display the error message here -->
          @if(session('error'))
          <div class="alert alert-danger">
              {{ session('error') }}
          </div>
      @endif
      @if(session('success'))
      <div class="alert alert-success">
          {{ session('success') }}
      </div>
  @endif
          @foreach($artwork as $artworks)
    @php
        $currentDateTime = now(); // Get the current date and time
    @endphp

    {{-- Check if the artwork is for auction and the start_date has passed --}}
    @if($artworks->start_price && $currentDateTime >= $artworks->start_date && $currentDateTime <= $artworks->end_date)
        <div class="col-md-4">
            <div class="card clickable-card" style="width: 16rem; margin-block: 10px; margin-right: 50px;"
                 data-toggle="modal" data-target="#Modal{{ $artworks->start_price ? 'Auction' : 'Sale' }}_{{ $artworks->id }}">
                <img src="{{ asset('storage/attachments/'.$artworks->image) }}" class="card-img-top art-image" alt="Artwork Image">
                <div class="card-body">
                    <h5 class="card-title">{{ $artworks->title }}</h5>
                    <h6>{{ $artworks->user->name }}</h6>
                    <h6 class="price">₱{{ $artworks->price }}{{ $artworks->start_price }}</h6>
                    <h6 class="type">{{ $artworks->start_price ? 'Auctioned' : 'For Sale' }}</h6>
                    <p class="card-text">{{ \Illuminate\Support\Str::limit($artworks->description, 20) }}</p>
                </div>
            </div>
        </div>
    @endif
    
    {{-- Display artworks that are "For Sale" --}}
    @if(!$artworks->start_price)
        <div class="col-md-4">
            <div class="card clickable-card" style="width: 16rem; margin-block: 10px; margin-right: 50px;"
                 data-toggle="modal" data-target="#ModalSale_{{ $artworks->id }}">
                <img src="{{ asset('storage/attachments/'.$artworks->image) }}" class="card-img-top art-image" alt="Artwork Image">
                <div class="card-body">
                    <h5 class="card-title">{{ $artworks->title }}</h5>
                    <h6>{{ $artworks->user->name }}</h6>
                    <h6 class="price">₱{{ $artworks->price }}</h6>
                    <h6 class="type">For Sale</h6>
                    <p class="card-text">{{ \Illuminate\Support\Str::limit($artworks->description, 20) }}</p>
                </div>
            </div>
        </div>
    @endif
<!-- Modal for Auction Artwork -->
@if ($artworks->start_price)
<div class="modal fade" id="ModalAuction_{{ $artworks->id }}" role="dialog" aria-labelledby="artmodal" aria-hidden="true">
  <div class="modal-dialog fixed-modal-dialog " role="document">
        <div class="modal-content modalart">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>   
                </button>
            </div>
            <div class="modal-body">
              <div class="row">
                  <div class="col-6">
                      <div class="row image-container">
                          <img src="{{ asset('storage/attachments/'.$artworks->image) }}" alt="" class="img-fluid">
                      </div>
                  </div>
                  <div class="col-6">
                      <h1>Title: {{ $artworks->title }}</h1>
                      
                      <h5><a class="no-underline" href="{{ route('portfolio', ['id' => $artworks->user->id]) }}">{{ $artworks->user->name }}</a></h5>
                      <h6 class="price">₱{{ $artworks->price }}{{ $artworks->start_price }}</h6>
                      <br>
                      <p class="list-group-item"><strong>Duration: </strong>
                        <span id="countdown_{{ $artworks->id }}">
                              <span id="days_{{ $artworks->id }}">0</span> days
                              <span id="hours_{{ $artworks->id }}">0</span> hours
                              <span id="minutes_{{ $artworks->id }}">0</span> minutes
                              <span id="seconds_{{ $artworks->id }}">0</span> seconds
                      </span></p>
                      <script>
                        function startCountdown_{{ $artworks->id }}(endDate) {
                            const targetDate_{{ $artworks->id }} = new Date(endDate).getTime();
                            const countdownInterval_{{ $artworks->id }} = setInterval(function () {
                                const now_{{ $artworks->id }} = new Date().getTime();
                                const timeRemaining_{{ $artworks->id }} = targetDate_{{ $artworks->id }} - now_{{ $artworks->id }};
                                
                                const days_{{ $artworks->id }} = Math.floor(timeRemaining_{{ $artworks->id }} / (1000 * 60 * 60 * 24));
                                const hours_{{ $artworks->id }} = Math.floor((timeRemaining_{{ $artworks->id }} % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                const minutes_{{ $artworks->id }} = Math.floor((timeRemaining_{{ $artworks->id }} % (1000 * 60 * 60)) / (1000 * 60));
                                const seconds_{{ $artworks->id }} = Math.floor((timeRemaining_{{ $artworks->id }} % (1000 * 60)) / 1000);
                                
                                document.getElementById('days_{{ $artworks->id }}').textContent = days_{{ $artworks->id }};
                                document.getElementById('hours_{{ $artworks->id }}').textContent = hours_{{ $artworks->id }};
                                document.getElementById('minutes_{{ $artworks->id }}').textContent = minutes_{{ $artworks->id }};
                                document.getElementById('seconds_{{ $artworks->id }}').textContent = seconds_{{ $artworks->id }};
                                
                                if (timeRemaining_{{ $artworks->id }} < 0) {
                                    clearInterval(countdownInterval_{{ $artworks->id }});
                                    document.getElementById('countdown_{{ $artworks->id }}').innerHTML = "Expired";
                                    setTimeout(function () {
                                        document.getElementById('countdown_{{ $artworks->id }}').innerHTML = "<b><span id='days_{{ $artworks->id }}'>0</span> days <span id='hours_{{ $artworks->id }}'>0</span> hours <span id='minutes_{{ $artworks->id }}'>0</span> minutes <span id='seconds_{{ $artworks->id }}'>0</span> seconds</b>";
                                        startCountdown_{{ $artworks->id }}(endDate); // Restart the countdown
                                    }, 5000);
                                }
                            }, 1000);
                        }
                      
                        const initialEndDate_{{ $artworks->id }} = '{{$artworks->end_date}}';
                        startCountdown_{{ $artworks->id }}(initialEndDate_{{ $artworks->id }});
                      </script>  
                      <br>
<p><strong>Highest Bid: </strong> ₱{{ number_format($artworks->bids->max('amount'), 2) }}</p>                      <p><strong>Description:</strong></p>
                      <p>{{ $artworks->description }}</p>
                      <div class="row">
                        <div class="col">
        <div class="d-inline">
          <form action="{{ route('cart.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="artwork_id" value="{{ $artworks->id }}">
                            <input type="hidden" name="price" value="{{ $artworks->price }}">
                            <button type="submit" class="btn btn-outline-dark buttonaddtocart">Add to Cart</button>
                        </form>
            
        </div>
    </div>
    <div class="col">
                              <form id="bidForm_{{ $artworks->id }}" action="{{ route('place.bid', ['artworkId' => $artworks->id]) }}" method="POST">
                                @csrf 
                                <button type="submit" class="btn btn-dark">Place Bid</button>
                                <div class="form-group">
                                  <label for="bidAmount_{{ $artworks->id }}">Enter the Amount:</label>
                                  <input type="number" class="form-control" id="bidAmount_{{ $artworks->id }}" name="amount" required>
                              </div>
                              
                                <div class="text-end">
                                  <br>
                              
                          </form>
                          

                      </div>
                        
                              
                            
                          <!-- Modal for Bidding -->

<div class="modal fade" id="ModalBid" role="dialog" aria-labelledby="bidModal" aria-hidden="true">
  <div class="modal-dialog right-modal-dialog" role="document">
    <div class="modal-content right-modal-content">
             
      </div>
  </div>
</div>
                          </div>
                      </div>
                  </div>
              </div>
              <p style="color: rgba(142, 146, 149, 0.491)">{{ $artworks->dimension }}cm</p>
          </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
    
</div>
@endif
<!-- Modal for Sale Artwork -->
<div class="modal fade" id="ModalSale_{{ $artworks->id }}" role="dialog" aria-labelledby="artmodal" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content modalart">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-6">
                        <div class="row image-container">
                            <img src="{{ asset('storage/attachments/'.$artworks->image) }}" alt="" class="img-fluid">
                        </div>
                    </div>
                    <div class="col-6">
                        <h1>Title: {{ $artworks->title }}</h1>
                        <h5><a class="no-underline" href="{{ route('portfolio', ['id' => $artworks->user->id]) }}">{{ $artworks->user->name }}</a></h5>
                        <h6 class="price">₱{{ $artworks->price }}{{ $artworks->start_price }}</h6>
                        <br>
                        <p><strong>Description:</strong></p>
                        <p>{{ $artworks->description }}</p>
                        <div class="row">
    <div class="col">
        <div class="d-inline">
          <form action="{{ route('cart.add') }}" method="POST">
            @csrf
            <input type="hidden" name="artwork_id" value="{{ $artworks->id }}">
            <button type="submit" class="btn btn-outline-dark buttonaddtocart">Add to Cart</button>
        </form>
            
        </div>
    </div>
    <div class="col">
      <form method="post" action="{{ route('sendMessageToArtist', $artworks->id) }}">
    @csrf
    
    <button class="btn btn-dark" type="submit">
        Buy
    </button>
</form>
    </div>
</div>
                    </div>
                </div>
                <p style="color: rgba(142, 146, 149, 0.491)">{{ $artworks->dimension }}cm</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endforeach
	   
        </div>
      </div>
      </div>
    </div>

    <style>
        .art-image{
          width: 255px;
          height:290px;
          object-fit: cover;


         }
        .buttonaddtocart{
          width: 110px;
        }
        .buttonbuy{
          width: 110px;
        }
        .fixed-column {
            position: sticky;
            top: 0;
            height: 100vh;
            
        }

        .scrollable-row {
            overflow-y: auto;
            height: 100vh;
        }

        .scrollable-content {
            padding: 20px; 
        }
        .price{
          color: #007bff;
        }
        .type{
          color: red;
        }
        .modalart{
          width: 800px;
          align-self: center;
          justify-content: center;
        }
        .close {
    font-size: 24px;
    color: #000000; 
    background-color: transparent; 
    border: none; 
    padding: 0; 
    
}
    

    </style>

    
    </div>

  </div>
</div>

@endsection

@section('Footer')
@include('buyer.footer')
@endsection