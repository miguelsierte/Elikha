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
                  <strong style="color:#535353">Admin</strong>
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
                            <form action="{{ route('/usermanagement', $user->id) }}" method="post">
                                @csrf
                                @method("PUT")
                                <input type="hidden" name="id" id="id" value="{{$user->id}}" id="id" />
                                <label>Name</label></br>
                                <input type="text" name="name" id="name" value="{{$user->name}}" class="form-control"></br>
                                
                                <label>Email</label></br>
                                <input type="text" name="email" id="email" value="{{$user->email}}" class="form-control"></br>
                        
                                <label>Mobile</label></br>
                                <input type="text" name="mobile" id="mobile" value="{{$user->mobile}}" class="form-control"></br>
                        
                                <label>Role</label></br>
                                <select type="type" name="role" id="role" value="{{$user->role}}" class="form-control">
                                  <option value="0">Admin</option>
                                  <option value="1">Assistant Admin</option>
                                </select></br>
                        
                                <input type="submit" value="Update" class="btn btn-success"></br>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  
</body>
</html>