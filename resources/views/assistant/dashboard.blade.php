<?php $page = 'dashboard';?> @include ('inc.navassistant')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    <link href="style.css" rel="stylesheet">
    <style>
    body 
    {
        background-color: #EEEEEE;
        color: #535353;
    }
    
    </style>
</head>
</div>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="mb-0" style="font-family:Helvetica Neue">Dashboard</h1>
                <a class="dropdown d-none d-sm-inline-block" style="position: relative; left: 1050px;">
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
                <form id="logout-form" action="{{ route('assistLogout') }}" method="post" class="d-none">
                    @csrf
                    @method('delete')
                </form>
                </a>
                </div>
            </div>
        </div>
        <div class="row ">
            <div class="col-sm-6 mb-3 mb-sm-0">
                <div class="card text-left shadow h-100 py-2 w-100">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs text-primary text-uppercase mb-2" style="font-size:40px; font-weight: bold;">
                                    
                                </div>
                                <div class="p font-weight-bold text-gray-800">Total Art Sold</div>
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
                                <div class="text-xs text-primary text-uppercase mb-1" style="font-size:40px; font-weight: bold;">
                                    {{$users}}
                                </div>
                                <div class="p font-weight-bold text-gray-800">Total Users</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-mb-8">
                <div class="card shadow mb-8 h-100 p-3 w-100">
                    <div class="row align-items-center">
                        <h2 class="mb-1" style="color: #535353; font-family:Helvetica Neue">Art Categories Report</h2>
                        <div class="card-body">
                            <table>
                                <thead>
                                    <tr>
                                  <th>Rank</th>
                                  <th>Category</th>
                                  <th>Total Art Piece</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php($rank = 1)
                                    @foreach ($categories as $category)
                                    <tr>
                                        <td>{{ $rank++ }}</td>
                                        <td>{{ $category->category }}</td>
                                        <td>{{ $category->artworks_count }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-mb-8">
                <div class="card shadow mb-8 h-100 p-3 w-100">
                    <div class="row no-gutters align-items-center">
                        <h2 class="mb-1" style="color: #535353; font-family:Helvetica Neue">Featured</h2>
                        <div class="card-body">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
