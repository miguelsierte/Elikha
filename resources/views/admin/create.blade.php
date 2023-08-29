<?php $page = 'usermanagement';?> @include ('inc.navadmin')
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
                <h1 class="mb-0" style="font-family:Helvetica Neue">User Management</h1>
                <a class="dropdown d-none d-sm-inline-block">
                <a href="#" class="d-flex align-items-center text-black text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                  <img src="prof.png" alt="" width="32" height="32" class="rounded-circle me-2">
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
                        <h2 class="mb-1" style="color: #535353; font-family:Helvetica Neue">Add New User</h2>
                        <div class="card-body">
                            
                            <form action="{{ route('create') }}" method="POST">
                                @csrf
                                <div class="forms">
                                <div class="col-md-5">
                                    <label>Name</label></br>
                                    <input type="text" name="name" id="name" class="form-control" required></br>
                                </div>

                                <div class="col-md-5">
                                    <label>Email</label></br>
                                    <input type="email" name="email" id="email" class="form-control" required></br>
                                </div>

                                <div class="col-md-5">
                                    <label>Password</label></br>
                                    <input type="password" name="password" id="password" class="form-control" required></br>                  
                                </div>

                                <div class="col-md-5">
                                    <label>Mobile</label></br>
                                    <input type="text" name="mobile" id="mobile" class="form-control" required></br>
                                </div>

                                <div class="col-md-5">
                                    <label>Role</label></br>
                                    <select type="type" name="role" id="role" class="form-control" required>
                                        <option value="0">Admin</option>
                                        <option value="1">Assistant Admin</option>
                                    </select></br>
                                </div>
                                <div class="hstack gap-3">
                                    <a href="{{ url()->previous() }}" type="button" class="btn btn-outline-secondary">Cancel</a>
                                    <input type="submit" value="Save" class="btn btn-outline-primary"></br>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  
</body>
</html>