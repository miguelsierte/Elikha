<?php $page = 'usermanagement';?> @include ('inc.navadmin')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    
    <link href="{{asset ('style.css')}}" rel="stylesheet">
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
                <h1 class="mb-0" style="font-family:Helvetica Neue">User Management</h1>
                <a class="dropdown d-none d-sm-inline-block">
                <a href="#" class="d-flex align-items-center text-black text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                  <img src="{{asset('prof.png')}}" alt="" width="32" height="32" class="rounded-circle me-2">
                  <strong style="color:#535353">{{ Auth::user()->name }}</strong>
                </a>
                <ul class="dropdown-menu dropdown-menu text-small shadow">
                  <li><a class="dropdown-item" href="#">Sign out</a></li>
                </ul>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-mb-8">
                <div class="card shadow mb-8 h-100 p-3 w-100">
                    <div class="row no-gutters align-items-center">
                        <h2 class="mb-1" style="color: #535353; font-family:Helvetica Neue">User Details</h2>
                        <div class="card-body">
                          <h5 class="card-title" style="font-family:Helvetica Neue; color: #535353;">Name : {{ $user->name }}</h5><br>
                          <h5 class="card-text" style="font-family:Helvetica Neue; color: #535353;">Email : {{ $user->email }}</h5><br>
                          <h5 class="card-text" style="font-family:Helvetica Neue; color: #535353;">Mobile : {{ $user->mobile }}</h5><br>
                          <h5 class="card-text" style="font-family:Helvetica Neue; color: #535353;">Role : {{ $user->role }}</h5><br>
                          <a href="{{url('usermanagement')}}" type="button" class="btn btn-outline-secondary">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  
</body>
</html>