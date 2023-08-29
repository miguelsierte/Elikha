<?php $page = 'posts';?> @include ('inc.navadmin')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Posts</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <link href="style.css" rel="stylesheet">
    <style>
    body 
    {
        background-color: #EEEEEE;
        color: #535353;
    }
    .fixed-modal-dialog {
					max-width: 900px; /* Adjust the desired maximum width */
					width: 100%;
					margin: auto;
					}

					.image-container {
					text-align: center;
					}

					.image-container img {
					max-width: 400px;
					height: 400px;
					}

					.image-description {
					margin-top: 10px; /* Adjust the spacing between the image and description */
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
                    <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
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
                        <a href="posts" type="button" class="btn btn-primary" style="margin-right: 20px">Pending</a>
                        <a href="approvePosts" type="button" class="btn btn-light">Approved</a>
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
                                  <button type="button" class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#ARTMODAL_{{ $artwork->id }}">
                                    View
                                    </button>
                                  <div class="modal fade" id="ARTMODAL_{{ $artwork->id }}" tabindex="-1" role="dialog" aria-labelledby="artmodal" aria-hidden="true">
                                    <div class="modal-dialog fixed-modal-dialog" role="document">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        <div class="modal-body">
                                          <div class="row">
                                            <div class="col-6">
                                              <div class="image-container">
                                                <img src="{{ asset('artworks/'.$artwork->image) }}" alt="" class="img-fluid">
                                              </div>
                                            </div>
                                            <div class="col-6">
                                              <H1>{{ $artwork->title }}</H1>
                                              <h5>{{ $artwork->user->name }}</h5>
                                              <br>
                                              <p>Description:</p>
                                              <p>{{ $artwork->description }}</p>
                                            </div>
                                          </div>
                                          <p style="color: rgba(142, 146, 149, 0.491)">{{ $artwork->dimension }}</p>
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                      </div>
                                    </div>
                                </div>
                                  <form action="{{ route('approve', $artwork->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-primary btn-sm">Approve</button>
                                    </form>
                                    <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $artwork->id }}">
                                        <i class="fa fa-trash-o" aria-hidden="true"></i> Reject
                                    </button>
                                    <div class="modal fade" id="deleteModal{{ $artwork->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $artwork->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel{{ $artwork->id }}">Confirm Delete</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to reject this artwork?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <form action="{{ route('reject') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $artwork->id }}">
                                        <button type="submit" class="btn btn-outline-danger">Reject</button>
                                    </form>
                                </div>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>