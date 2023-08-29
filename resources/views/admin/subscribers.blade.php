<?php $page = 'subscribers';?> @include ('inc.navadmin')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Subscribers</title>
    <link href="style.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.0/chart.min.js"></script>
    <style>
    body 
    {
        background-color: #EEEEEE;
        color: #535353;
    }
    </style>

</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="mb-0" style="font-family:Helvetica Neue">Subscribers</h1>
                <a class="dropdown d-none d-sm-inline-block">
                <a href="#" class="d-flex align-items-center text-black text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                  <img src="prof.png" alt="" width="32" height="32" class="rounded-circle me-2">
                  <strong style="color:#535353">{{ Auth::user()->name }}</strong>
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="{{ route('assistLogout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('assistLogout') }}" method="POST" class="d-none">
                    @csrf
                    @method('delete')
                </form>
                </a>
            </div>
        </div>
        <div class="row ">
            <div class="col-sm-6 mb-3 mb-sm-0">
                <div class="card text-left shadow h-100 py-2 w-100">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs text-primary text-uppercase mb-2" style="font-size:40px; font-weight: bold;">
                                    {{$artist}}
                                </div>
                                <div class="p font-weight-bold text-gray-800">Total Artist</div>
                            </div>
                            <div class="col order-last">
                                <div class="h1 font-weight-bold text-primary" style="font-size:40px; font-weight: bold;">
                                    {{ $artistPercentage }}%
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 mb-3 mb-sm-0">
                <div class="card text-left shadow h-100 py-2 w-100">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs text-uppercase mb-2" style="font-size:40px; font-weight: bold; color:#F0D12E;">
                                    {{$buyer}}
                                </div>
                                <div class="p font-weight-bold text-gray-800">Total Buyers</div>
                            </div>
                            <div class="col order-last">
                                <div class="h1 font-weight-bold text-gray-800" style="font-size:40px; font-weight: bold; color:#F0D12E;">
                                    {{ $buyerPercentage }}%
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-mb-8">
                <div class="card shadow mb-8 h-100 p-3 w-100">
                    <div class="row no-gutters align-items-center">
                        <h2 class="mb-1" style="color: #535353; font-family:Helvetica Neue">User Report</h2>
                        <div class="card-body">
                            <div style="width: 1100px; height: 400px;">
                                <canvas id="myChart"></canvas>
                            </div>
                            
                            <script>
                                var ctx = document.getElementById('myChart').getContext('2d');
                                
                                var data = {
                                    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                                    datasets: 
                                    [
                                        {
                                        label: 'Artist',
                                        data: {!! json_encode($artistData) !!},
                                        backgroundColor: '#2680EB',                
                                        borderRadius: Number.MAX_VALUE,
                                        bordertopSkipped: false,
                                        hoverBorderWidth: 3,
                                        hoverBorderColor:'#333333'
                                        },
                                        {
                                        label: 'Buyers',
                                        data: {!! json_encode($buyerData) !!},
                                        backgroundColor: '#F0D12E',
                                        borderRadius: Number.MAX_VALUE,
                                        bordertopSkipped: false,
                                        hoverBorderWidth: 3,
                                        hoverBorderColor:'#333333'
                                        }
                                        
                                    ]
                                };
                                
                                var options = {
                                    barPercentage:.5,
                                    responsive: true,
                                    maintainAspectRatio: false,
                                    scales: {
                                        yAxes: [{
                                            ticks: {
                                                beginAtZero: true
                                            }
                                        }]
                                    }
                                };
                                
                                var myChart = new Chart(ctx, {
                                    type: 'bar',
                                    data: data,
                                    options: options
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>