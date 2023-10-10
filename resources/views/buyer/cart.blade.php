@extends('buyer.master')
@include('artistinc.popup')
@section('Header')
    @include('buyer.nav')
 @endsection
@if(session()->has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
{{ session('success') }}
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if(session()->has('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
{{ session('error') }}
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<script>
$(document).ready(function(){
$('.alert').on('closed.bs.alert', function () {
adjustBodyMarginTop();
});

adjustBodyMarginTop();
});

function adjustBodyMarginTop() {
var navbarHeight = $('.navbar').outerHeight() || 0;
var alertHeight = $('.alert').outerHeight() || 0;
var marginTopValue = navbarHeight + alertHeight + 20; //margin for success/error message

$('body').css('margin-top', marginTopValue + 'px');
}
</script>
<style>
.alert {
position: fixed;
top: 80px;
right: 0;
left: 0;
z-index: 1000;
}
</style>
@section('Body')
    <br><br><br>
    <div class="container mt-4">
        <!-- Cart title and sorting options -->
        <div class="row mb-4">
            <div class="col-md-6">
                <h4 style="font-size: 30px; font-family: 'Helvetica Neue;">Cart</h4>
            </div>
            <div class="col-md-6">
                <div class="btn-group">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Sort
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item sort-option" data-sort-type="all">All Artworks</a></li>
                        <li><a class="dropdown-item sort-option" data-sort-type="for_sale">For Sale</a></li>
                        <li><a class="dropdown-item sort-option" data-sort-type="auctioned">Auctioned</a></li>
                        
                    </ul>
                    <script>
                        // JavaScript for handling sort functionality
                        $('.sort-option').on('click', function() {
                            var sortType = $(this).data('sort-type');
                            
                            // Show/hide artworks based on selected sort type
                            if (sortType === 'all') {
                                $('.card[data-artwork-type]').show(); // Show all artworks
                            } else if (sortType === 'for_sale') {
                                $('.card[data-artwork-type="auctioned"]').hide(); // Hide auctioned artworks
                                $('.card[data-artwork-type="for_sale"]').show(); // Show for sale artworks
                            } else if (sortType === 'auctioned') {
                                $('.card[data-artwork-type="for_sale"]').hide(); // Hide for sale artworks
                                $('.card[data-artwork-type="auctioned"]').show(); // Show auctioned artworks
                            }
                            // Always show order details
                            $('.order-details').show();
                        });
                    </script>
                    
                </div>
            </div>
            
        </div>
        <!-- Displaying cart items (70% width) -->
        <div class="row">
            <div class="col-md-7">
                <!-- Display Auctioned Artworks in Cart -->
                <h2 style="font-family:Helvetica Neue">Auction Items</h2>
                @foreach($auctionItems as $artwork)
                    @php
                        $leadingBid = $artwork->artwork->bids->max('amount');
                        
                    @endphp
                    <div class="card mb-3" data-artwork-type="auctioned">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="{{ asset('storage/attachments/'.$artwork->artwork->image) }}" alt="Artwork Image"
                                    class="img-fluid">
                            </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h4 class="card-title">{{ $artwork->artwork->title }}</h5>
                                <p>Dimensions: {{ $artwork->artwork->dimension }} cm</p>
                                <p class="card-subtitle mb-2 text-muted">{{ $artwork->artwork->user->name }}</p>
                                <p class="card-text">{{ $artwork->artwork->description }}</p>
                                <p class="card-text">Leading Bid: ₱{{ $leadingBid ? number_format($leadingBid, 2) : 'N/A' }}</p>
                                <div class="row">
                                    <div class="col">
                                            <button type="button" class="btn btn-outline-dark bid-button" data-bs-toggle="modal" data-bs-target="#bidModal{{ $artwork->artwork->id }}">
                                                Bid
                                            </button>
                                    </div>
                                            <!-- Bid Modal -->
                                            <div class="modal fade" id="bidModal{{ $artwork->artwork->id }}" tabindex="-1" aria-labelledby="bidModalLabel" aria-hidden="true">
                                            
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="bidModalLabel">Enter Bid Amount</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('place.bid', ['artworkId' => $artwork->artwork->id]) }}" method="POST">
                                                                @csrf
                                                                <label for="bidAmount">Enter Bid Amount:</label>
                                                                <input type="number" id="bidAmount" name="amount" required>

                                                                <button type="submit" class="btn btn-dark" onclick="placeBid({{ $artwork->artwork->id }}, $('#bidAmount').val())">Place Bid</button>

                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    <div class="col">
                                        <form method="post" action="{{ route('cart.remove', $artwork->artwork_id) }}">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-dark">Delete</button>
                                        </form>     
                                    </div>
                                 </div>                
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <!-- Display For Sale Artworks in Cart -->
            
                <h2 style="font-family:Helvetica Neue">For Sale Items</h2>
@foreach($saleItems as $artwork)
<div class="card mb-3" data-artwork-type="for_sale">
    <div class="row g-0">
        <div class="col-md-4">
            <img src="{{ asset('storage/attachments/'.$artwork->artwork->image) }}" alt="Artwork Image"
                class="img-fluid">
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <h4 class="card-title">{{ $artwork->artwork->title }}</h5>
                <p>Dimensions: {{ $artwork->artwork->dimension }} cm</p>
                <p class="card-subtitle mb-2 text-muted">{{ $artwork->artwork->user->name }}</p>
                <p class="card-text">{{ $artwork->artwork->description }}</p>
                <p class="card-text">Price: ₱{{ number_format($artwork->artwork->price, 2) }}</p>
                <div class="row">
                    <div class="col">
                        <div class="d-inline">  
                    <button type="submit" class="btn btn-outline-dark">Buy</button>
                        </div>
                    </div>
                    <div class="col">
                <form method="post" action="{{ route('cart.remove', $artwork->artwork_id) }}">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-dark">Delete</button>
                </form>
            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endforeach

            
          <!-- Order details card on the right (30% width) -->
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mt-4 text-center">Order Details</h4>
                            <h5>For Sale</h5>
                            @foreach($saleItems as $artwork)
                                ₱{{ number_format($artwork->artwork->price, 0, '.', ',') }}<br>
                            @endforeach

                            <h5 class="mt-3">Auctioned</h5>
                            @foreach($auctionItems as $artwork)
                                @php
                                    $leadingBid = $artwork->artwork->bids->max('amount');
                                @endphp
                                ₱{{ number_format($leadingBid, 0, '.', ',') }}<br>
                            @endforeach

                            <h5 class="mt-3">Total Price</h5>
                            @if($sortType === 'for_sale')
                                ₱{{ number_format($totalForSalePrice, 0, '.', ',') }}
                            @elseif($sortType === 'auctioned')
                                ₱{{ number_format($totalAuctionedPrice, 0, '.', ',') }}
                            @else
                                ₱{{ number_format($totalPrice, 0, '.', ',') }}
                            @endif
                        </div>
                    </div>
                </div>

            
        </div>
    </div>


@endsection