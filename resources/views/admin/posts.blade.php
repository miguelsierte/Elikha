<?php $page = 'posts';?> @include ('inc.navadmin')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Posts</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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
                    .status-oval {
    width: auto;
    height: 30px;
    border-radius: 15px;
    display: inline-flex;
    align-items: center;
    padding: 0 10px;
}

.status-pending {
    background-color: gray;
    color: white;
}

.status-approved {
    background-color: #007BFF;
    color: white;
}
.status-sold {
    background-color: green;
    color: white;
}
.status-rejected {
    background-color: #DC3545;
    color: white;
    overflow-y: auto;
}
.price{
          color: #007bff;
        }
        .type{
          color: red;
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
                                <div class="p font-weight-bold text-gray-800">Total Pending Artworks</div>
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
                                <div class="p font-weight-bold text-gray-800">Total Approved Artworks</div>
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
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <div class="col-md-6">
                            <form method="get" action="{{ route('posts') }}" class="d-flex">
                                <select name="status_filter" id="status_filter" style="padding: 0.5em; font-size: 1em; border-radius: 0.25em; border: 1px solid #ccc;">
                                    <option value="all">All</option>
                                    <option value="Pending"{{ request('status_filter') === 'Pending' ? ' selected' : '' }}>Pending</option>
                                    <option value="Approved"{{ request('status_filter') === 'Approved' ? ' selected' : '' }}>Approved</option>
                                    <option value="Sold"{{ request('status_filter') === 'Sold' ? ' selected' : '' }}>Sold</option>
                                    <option value="Rejected"{{ request('status_filter') === 'Rejected' ? ' selected' : '' }}>Rejected</option>
                                </select>
                                <button type="submit" class="btn btn-outline-dark">Filter</button>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex justify-content-end">
                                <div class="input-group" style="max-width: 300px;">
                                    <input type="text" class="form-control" placeholder="Search artworks" id="search-input" name="search">
                                    <button class="btn btn-outline-dark" type="button" id="search-button">Search</button>
                                </div>
                            </div>
                        </div>
                            <script>
                                const searchButton = document.querySelector('#search-button');
                                const searchInput = document.querySelector('#search-input');
                                const statusFilter = document.querySelector('#status_filter');
                            
                                searchButton.addEventListener('click', function() {
                                    const searchTerm = searchInput.value;
                                    const selectedStatus = statusFilter.value;
                            
                                    const url = new URL('{{ route('posts') }}');
                                    url.searchParams.set('search', searchTerm);
                                    
                                    if (selectedStatus) {
                                        url.searchParams.set('status_filter', selectedStatus);
                                    } else {
                                        url.searchParams.delete('status_filter');
                                    }
                            
                                    window.location.href = url;
                                });
                            </script>
                        </div>
                        <div class="card-body">
                            @if(Session::has('success'))
                        <div class="alert alert-success" role="alert">
                            {{Session::get('success')}}
                        </div>
                    @endif
                    
                    @if(Session::has('reject'))
                        <div class="alert alert-danger" role="alert">
                            {{Session::get('reject')}}
                        </div>
                    @endif
                            <table>
                                <tr>
                                    <th>ID</th>
                                    <th>Artist</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th>Date Created</th>
                                    <th>Action</th>
                                  
                                </tr>
                                @foreach ($artworks as $artwork)
                                <tr>
                                    <td>{{ $artwork->id }}</td>
                                    <td>{{ $artwork->user->name }}</td>
                                    <td>{{ $artwork->title }}</td>
                                    <td>{{ \Illuminate\Support\Str::limit($artwork->description, 20) }}</td>
                                    <td>{{ $artwork->category->Category }}</td>
                                    <td>
                                        <div class="status-oval @if ($artwork->status === 'Pending') status-pending @elseif ($artwork->status === 'Approved') status-approved @elseif ($artwork->status === 'Sold') status-sold @elseif ($artwork->status === 'Rejected') status-rejected @endif">
                                            {{ $artwork->status }}
                                        </div>
                                    </td>
                                    <td>{{ $artwork->created_at->format('M d, Y') }}</td>
                                    <td>
                                        <button type="button" class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#ARTMODAL_{{ $artwork->id }}">
                                            View
                                        </button>
                                        <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#rejectModal{{ $artwork->id }}" data-artwork-id="{{ $artwork->id }}">
                                            <i class="fa fa-trash-o" aria-hidden="true"></i> Reject
                                        </button>
                                        <div class="modal fade" id="ARTMODAL_{{ $artwork->id }}" tabindex="-1" role="dialog" aria-labelledby="artmodal" aria-hidden="true">                                            
                                            <div class="modal-dialog fixed-modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <div class="image-container">
                                                                    <img src="{{ asset('storage/attachments/'.$artwork->image) }}" alt="" class="img-fluid">
                                                                    <p>Dimension: {{ $artwork->dimension }}</p>
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <H1>{{ $artwork->title }}</H1>
                                                                <h5>{{ $artwork->user->name }}</h5>
                                                                <h6 class="type">{{ $artwork->start_price ? 'For Auction' : 'For Sale' }}</h6>
                                                                <h6 class="price">₱{{ $artwork->price }}{{ $artwork->start_price }}</h6>
                                                                <br>
                                                                <p>Description:</p>
                                                                <p>{{ $artwork->description }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                                                        <form action="{{ route('approve', $artwork->id) }}" method="POST">
                                                            @csrf
                                                            <button type="submit" class="btn btn-outline-primary">Approve</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Rejection Modal -->
                                        <div class="modal fade" id="rejectModal{{ $artwork->id }}" tabindex="-1" aria-labelledby="rejectModalLabel{{ $artwork->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="rejectModalLabel{{ $artwork->id }}">Confirm Reject</h5>
                                                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure you want to reject this artwork?
                                                        <form action="{{ route('reject', $artwork->id) }}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="id" value="{{ $artwork->id }}">
                                                            <textarea name="remarks" rows="3" placeholder="Provide remarks for rejection"></textarea>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                                                                <button type="submit" class="btn btn-outline-danger">Reject</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                              </table>
                              {{ $artworks->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>