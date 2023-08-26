@extends ('artistlayouts.master')
@section('header')

@include('artistinc.navbar')
@include('artistinc.popup')
        <title>Home - @yield('title')</title>
@endsection

        {{-- THIS IS MY CHANGES - RAVEN --}}

        @section('body')

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
                            <h2>---</h2>
                            <p>Active Auctions</p>

                        </div>
                        <div class="col-sm-4 p-2 text-align: center">
                            <h2>---</h2>
                            <p>Pending Payments</p>
                        </div>
                        <div class="col-sm-4 p-2 text-align: center">
                            <h2>---</h2>
                            <p>Important Messages</p>
                        </div>

                      </div>
                </div>

            </span>

                    <br>
                    <div class="row grid text-center">
                        <div class="col-sm-4 p-2"><h4>Engagements</h4>
                        <img class="engage" src="artistimg/icon metro-chart-line.png" alt="..." height="105" width="105">
                        <div class="m-1">
                        <h3>---</h3>
                        <p>have seen your posts</p>
                        </div>
                    </div>
                        <div class="col-sm-4 p-2"><h4>Profile Views</h4> <br>
                            <img class="view" src="artistimg/icon metro-eye.png" alt="..." height="80" width="120">
                            <div class="m-1">
                            <h3>---</h3>
                            <p>have viewed your profile</p>
                        </div>
                        </div>

                        <div class="col-sm-4 p-2"><h4>Sold</h4>
                            <img class="sold" src="artistimg/icon metro-money.png" alt="..." height="100" width="70">
                            <div class="m-1">
                            <h3>---</h3>
                            <p>sold artworks</p>
                        </div>
                        </div>
                      </div>
            </div>
        </span>
        </div>
        </div>
        </div>

        @endsection
