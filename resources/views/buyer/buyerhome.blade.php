@extends('buyer.master')

@section('Header')
@include('buyer.Nav')
@include('artistinc.popup')
@endsection
<br>
@section('Body')

<div class="container">
    <div class="row">  
        <div class="col min-vh-100 d-flex justify-content-center align-items-center ">
            <div class="content text-md-center">
                <h3 style="font-size: 80px; font-family:Helvetica Neue">Let your Imagination<br> take over</h3>
                <p class="narrow-paragraph">
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Laudantium ullam atque, quidem perferendis saepe deleniti ea sapiente modi quisquam praesentium? Illum autem porro adipisci eaque aut error iure doloremque eveniet.
                </p>
            </div>
        </div>
        <div class="col" style="padding-top: 90px">
            <div id="carouselExampleIndicators" class="carousel slide carousel-size " data-bs-ride="carousel" data-bs-interval="3000" >
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner ">
                    <div class="carousel-item active">
                        <img src="images/art.png" class="d-block w-75 mx-auto carousel-image shadow p-3 mb-5 bg-body-tertiary rounded" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="images/art1.png" class="d-block w-75 mx-auto carousel-image shadow p-3 mb-5 bg-body-tertiary rounded" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="images/art3.png" class="d-block w-75 mx-auto carousel-image shadow p-3 mb-5 bg-body-tertiary rounded" alt="...">
                    </div>
                </div>
            </div>
        </div>
        <script>
          $(document).ready(function () {
            var interval = 20000; 
        
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
    </div>

    
    <div class="row">
      <div class="col justify-content-center align-items-center ">
          <div class="content text-md-center">
              <h4 style="font-size: 40px; font-family:Helvetica Neue">Buy and Sell ARTS</h3>      
          </div>
      </div>
       
  </div> 

  <div class="row mt-4">
      <div class="container ">
          <div class="row row-cols-4 d-flex justify-content-center">
            <div class="col text-md-center">
              <div class="card cardhome">
                 <br><br>
                  <img src="images/upload.png" class="card-img-top cardhomeimg" alt="...">
                  <br>
                  <h5 style="margin-left: 20px">Upload Artwork</h5>
                  <p style="margin-left: 20px; margin-right:20px"> Create your collection, add social links and set prices to your artworks</p>
              </div>
            </div>

            <div class="col text-md-center">
              <div class="card cardhome">
                 <br><br>
                  <img src="images/hammer.png" class="card-img-top cardhomeimg" alt="...">  
                  <br>
                  <h5>Auction Art</h5>
                  <p style="margin-left: 20px; margin-right:20px">Set a Schedule, Bid and Auction artworks</p>
              </div>
            </div>

            <div class="col text-md-center">
              <div class="card cardhome">
                  <br><br>
                  <img src="images/book.png" class="card-img-top cardhomeimg" alt="...">
                  <br>
                  <h5>Guides and Community</h5>
                  <p style="margin-left: 20px; margin-right:20px">A Private Community where we can showcase, sell and auction artworks</p>
                </div>
            </div>

            <div class="col text-md-center">
              <div class="card cardhome">
                  <br><br>
                  <img src="images/cart.png" class="card-img-top cardhomeimg" alt="...">
                  <br>
                  <h5>Shop</h5>
                  <p style="margin-left: 20px; margin-right:20px">Buy and view your favourite <br>artworks and artist</p>
                </div>
            </div>

           
          </div>

          <style>
              .cardhome{
                width: 300px; 
                height: 300px;
                border-radius: 10px; 
                box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
              }
              .cardhomeimg{
                width: 80px;
                height: 80px;
                align-self: center;
              }
          </style>
      </div>

  </div>
  <br><br><br>
  <div class="row mt-4 padding-top:100px">
      <div class="col justify-content-center align-items-center ">
          <div class="content text-md-center">
              <h4 style="font-size: 40px; font-family:Helvetica Neue">Upcoming Auctions</h3>      
          </div>
      </div>
  </div> 

  <div class="row mt-4">
   
     <!-- Gallery -->
     
  <div class="row">
    <div class="container">
      <div class="row d-flex justify-content-center">
    @if(isset($artwork[0]))
    <div class="col-lg-4 col-md-12 mb-4 mb-lg-0">
      <div class="image-container">
        <div class="image-info">
            <h3>{{ $artwork[0]->title }} <span style="margin-block: 0; font-size:10px;">{{ $artwork[0]->dimension }} cm</span></h3>
            <p>Artist: <b>{{ $artwork[0]->user->name }}</b></p>
            <p>Starting Price: <span class="price"><b>{{ $artwork[0]->start_price }}</b></span></p>
            <p>Auction Date:<br> <span><b>{{ date('F j, Y', strtotime($artwork[0]->start_date)) }}</b></span></p>
            <p style="font-size: 12px">{{ \Illuminate\Support\Str::limit($artwork[0]->description, 200) }}</p>
        </div>
        <img
            src="{{ asset('storage/attachments/'.$artwork[0]->image) }}"
            class="mb-4 upcomingauction1"
            alt=""
        />
      </div>
      @endif

      @if(isset($artwork[1]))
      <div class="image-container">
        <div class="image-info">
          <h3>{{ $artwork[1]->title }} <span style="margin-block: 0; font-size:10px;">{{ $artwork[1]->dimension }} cm</span></h3>
          <p>Artist: <b>{{ $artwork[1]->user->name }}</b></p>
          <p>Starting Price: <span class="price"><b>{{ $artwork[1]->start_price }}</b></span></p>
          <p>Auction Date:<br> <span><b>{{ date('F j, Y', strtotime($artwork[1]->start_date)) }}</b></span></p>
          <p style="font-size: 12px">{{ \Illuminate\Support\Str::limit($artwork[1]->description, 200) }}</p>
      </div>
          <img
          src="{{ asset('storage/attachments/'.$artwork[1]->image) }}"
            class="mb-4 upcomingauction2"
            alt=""
          />
      </div>
    </div>
    @endif

    <!---->

    @if(isset($artwork[2]))
    <div class="col-lg-4 mb-4 mb-lg-0">
      <div class="image-container">
        <div class="image-info">
          <h3>{{ $artwork[2]->title }} <span style="margin-block: 0; font-size:10px;">{{ $artwork[2]->dimension }} cm</span></h3>
          <p>Artist: <b>{{ $artwork[2]->user->name }}</b></p>
          <p>Starting Price: <span class="price"><b>{{ $artwork[2]->start_price }}</b></span></p>
          <p>Auction Date:<br> <span><b>{{ date('F j, Y', strtotime($artwork[2]->start_date)) }}</b></span></p>
          <p style="font-size: 12px">{{ \Illuminate\Support\Str::limit($artwork[2]->description, 200) }}</p>
      </div>
          <img
          src="{{ asset('storage/attachments/'.$artwork[2]->image) }}"
            class="mb-4 upcomingauction2"
            alt=""
          />
      </div>
      @endif

      @if(isset($artwork[3]))
      <div class="image-container">
        <div class="image-info">
          <h3>{{ $artwork[3]->title }} <span style="margin-block: 0; font-size:10px;">{{ $artwork[3]->dimension }} cm</span></h3>
          <p>Artist: <b>{{ $artwork[3]->user->name }}</b></p>
          <p>Starting Price: <span class="price"><b>{{ $artwork[3]->start_price }}</b></span></p>
          <p>Auction Date:<br> <span><b>{{ date('F j, Y', strtotime($artwork[3]->start_date)) }}</b></span></p>
          <p style="font-size: 12px">{{ \Illuminate\Support\Str::limit($artwork[3]->description, 200) }}</p>
      </div>
          <img
          src="{{ asset('storage/attachments/'.$artwork[3]->image) }}"
            class="mb-4 upcomingauction1"
            alt=""
          />
      </div>
      @endif
    </div>

    @if(isset($artwork[4]))
    <div class="col-lg-4 mb-4 mb-lg-0">
      <div class="image-container">
        <div class="image-info">
          <h3>{{ $artwork[4]->title }} <span style="margin-block: 0; font-size:10px;">{{ $artwork[4]->dimension }} cm</span></h3>
          <p>Artist: <b>{{ $artwork[4]->user->name }}</b></p>
          <p>Starting Price: <span class="price"><b>{{ $artwork[4]->start_price }}</b></span></p>
          <p>Auction Date:<br> <span><b>{{ date('F j, Y', strtotime($artwork[4]->start_date)) }}</b></span></p>
          <p style="font-size: 12px">{{ \Illuminate\Support\Str::limit($artwork[4]->description, 200) }}</p>
      </div>
          <img
          src="{{ asset('storage/attachments/'.$artwork[4]->image) }}"
            class="shadow-1-strong rounded mb-4 upcomingauction1"
            alt=""
          />
      </div>
      @endif

      @if(isset($artwork[5]))
      <div class="image-container">
        <div class="image-info">
          <h3>{{ $artwork[5]->title }} <span style="margin-block: 0; font-size:10px;">{{ $artwork[5]->dimension }} cm</span></h3>
          <p>Artist: <b>{{ $artwork[5]->user->name }}</b></p>
          <p>Starting Price: <span class="price"><b>{{ $artwork[5]->start_price }}</b></span></p>
          <p>Auction Date:<br> <span><b>{{ date('F j, Y', strtotime($artwork[5]->start_date)) }}</b></span></p>
          <p style="font-size: 12px">{{ \Illuminate\Support\Str::limit($artwork[5]->description, 200) }}</p>
      </div>
          <img
          src="{{ asset('storage/attachments/'.$artwork[5]->image) }}"
            class="shadow-1-strong rounded mb-4 upcomingauction2"
            alt=""
          />
      </div>
      @endif
    </div>
  </div>  
    </div>
  </div>  
    <style>
      .price{
        
      }
      .upcomingauction1{
        width: 408px;
        height: 272px;
        object-fit: cover;
        border-radius: 10px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.5);
      }
      .upcomingauction2{
        width: 408px;
        height: 612px;
        object-fit: cover;
        border-radius: 10px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.5);
      }
      .image-container {
        position: relative;
        display: inline-block;
      }
      .image-info {
          position: absolute;
          top: 0;
          left: 0;
          width:408px;
          height:100%;
          background: rgba(0, 0, 0, 0.5);
          color: #fff;
          opacity: 0;
          transition: opacity 0.3s ease;
          text-align:start;
          padding: 20px;
          box-sizing: border-box;
      }
      .image-container:hover .image-info {
          opacity: 1;
          backdrop-filter: blur(5px); 
      }

    </style>
    

<!-- Gallery -->
  </div>

  <br><br>
<div class="row mt-4 padding-top:100px justify-content-center align-items-center" id="about-section">
    <div class="col justify-content-center align-items-center ">
        <div class="content text-md-center">
            <h4 style="font-size: 40px; font-family:Helvetica Neue">About Us</h4>      
        </div>
    </div>
</div> 

<div class="row mt-4 padding-top:100px justify-content-center align-items-center">
  <div class="col justify-content-center align-items-center ">
      <div class="content text-md-center">
        <h3 style="font-size: 80px; font-family:Helvetica Neue">E-Likha</h3>
              
        <p class="narrow-paragraph">
          "Welcome to E-Likha, a thriving online art community born out of a shared passion 
          for creativity and artistic expression. Founded in 2023, we are a group of artists dedicated 
          to showcasing the beauty of visual arts to the world."</p>
      </div>
  </div>
</div>

<div class="row mt-4 padding-top:100px justify-content-center align-items-center">
  <div class="col justify-content-center align-items-center ">
      <div class="content text-md-center">
        <h5 style="font-size: 40px; font-family:Helvetica Neue">Get the Latest Art Trends</h5>
              
        <p class="narrow-paragraph">Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus ipsa cupiditate at ab deleniti deserunt aut, quo voluptatum autem amet repudiandae excepturi corporis dolorum dolore aspernatur ducimus nihil vitae? Temporibus?
          </p>
      </div>
  </div>
  <div class="col justify-content-center align-items-center ">
    <div class="content text-md-center">
     
      <h5 style="font-size: 40px; font-family:Helvetica Neue">Place you bid on Auctions</h5>  
      <p class="narrow-paragraph">Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus ipsa cupiditate at ab deleniti deserunt aut, quo voluptatum autem amet repudiandae excepturi corporis dolorum dolore aspernatur ducimus nihil vitae? Temporibus?
        </p>
    </div>
</div>
</div>
</div> 


</div>
@endsection

@section('Footer')
@include('buyer.footer')
@endsection