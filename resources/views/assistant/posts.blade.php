<?php $page = 'posts';?> @include ('inc.navassistant')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Posts</title>
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
                <h1 class="mb-0" style="font-family:Helvetica Neue">Artworks</h1>
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
                                    {{$pendingPost}}
                                </div>
                                <div class="p font-weight-bold text-gray-800">Total Pending Arwtorks</div>
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
                                <div class="text-xs text-primary text-uppercase mb-2" style="font-size:40px; font-weight: bold;">
                                    {{$approvedPost}}
                                </div>
                                <div class="p font-weight-bold text-gray-800">Total Approved Arwtorks</div>
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
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h2 class="mb-1" style="color: #535353; font-family:Helvetica Neue">Pending Artworks</h2>
                        <div class="d-flex justify-content-end">
                        <a href="assistposts" type="button" class="btn btn-primary" style="margin-right: 20px">Pending</a>
                        <a href="assistapprovePosts" type="button" class="btn btn-light">Approved</a>
                        </div>
                        </div>
                        <div class="card-body">
                            @if(Session::has('success'))
                        <div class="alert alert-success" role="alert">
                            {{Session::get('success')}}
                        </div>
                    @endif
                    
                    @if(Session::has('delete'))
                        <div class="alert alert-danger" role="alert">
                            {{Session::get('delete')}}
                        </div>
                    @endif
                            <table>
                                <tr>
                                    <th>ID</th>
                                    <th>Artist</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Category</th>
                                  <th>Date Created</th>
                                  <th>Action</th>
                                  
                                </tr>
                                @foreach ($pendingArtworks as $artwork)
                                <tr>
                                    <td>{{ $artwork->id }}</td>
                                    <td>{{ $artwork->user->name }}</td>
                                    <td>{{ $artwork->title }}</td>
                                    <td>{{ $artwork->description }}</td>
                                    <td>{{ $artwork->category->category }}</td>
                                  <td>{{ $artwork->created_at->format('M d, Y') }}</td>
                                  <td>
                                  <a href="#" title="View"><button class="btn btn-outline-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                  <form action="{{ route('assistapprove', $artwork->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-primary btn-sm">Approve</button>
                                    </form>
                                    <form action="{{ route('assistreject') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $artwork->id }}">
                                        <button type="submit" class="btn btn-outline-danger btn-sm">Reject</button>
                                    </form>
                                    </form>
                                    </td>
                                </tr>
                                @endforeach
                              </table>
                              {{ $pendingArtworks->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>