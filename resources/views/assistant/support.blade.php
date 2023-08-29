<?php $page = 'support';?> @include ('inc.navassistant')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Support</title>
    <link href="style.css" rel="stylesheet">
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
                <h1 class="mb-0" style="font-family:Helvetica Neue">Support</h1>
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
                    @method('POST')
                </form>
                </a>
            </div>
        </div>
        <div class="row ">
            <div class="col-sm-6 mb-3 mb-sm-0">
                <div class="card text-left shadow h-100 py-2 w-100">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">

                                </div>
                                <div class="p font-weight-bold text-gray-800">Total Support Tickets</div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 mb-3 mb-sm-0">
                <div class="card text-left shadow h-100 py-2 w-100">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">

                                </div>
                                <div class="p font-weight-bold text-gray-800">Open Tickets</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
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
                        <h2 class="mb-1" style="color: #535353; font-family:Helvetica Neue">Support Tickets</h2>
                        <div class="card-body">
                            <table>
                                <tr>
                                  <th>Rank</th>
                                  <th>Category</th>
                                  <th>Status</th>
                                  <th>Date Created</th>
                                </tr>
                                <tr>
                                  <td>1</td>
                                  <td>Maria Anders</td>
                                  <td>Open</td>
                                  <th>Total Art Piece</th>
                                </tr>
                                <tr>
                                  <td>2</td>
                                  <td>Francisco Chang</td>
                                   <td>Open</td>
                                   <th>Total Art Piece</th>
                                </tr>
                                <tr>
                                  <td>3</td>
                                  <td>Roland Mendel</td>
                                  <td>Open</td>
                                  <th>Total Art Piece</th>
                                </tr>
                                <tr>
                                  <td>4</td>
                                  <td>Helen Bennett</td>
                                  <td>Open</td>
                                  <th>Total Art Piece</th>
                                </tr>
                                <tr>
                                  <td>5</td>
                                  <td>Yoshi Tannamuri</td>
                                  <td>Open</td>
                                  <th>Total Art Piece</th>
                                </tr>
                                <tr>
                                  <td>6</td>
                                  <td>Giovanni Rovelli</td>
                                  <td>Open</td>
                                  <th>Total Art Piece</th>
                                </tr>
                                <tr>
                                    <td>7</td>
                                    <td>Giovanni Rovelli</td>
                                    <td>Open</td>
                                    <th>Total Art Piece</th>
                                  </tr>
                              </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>