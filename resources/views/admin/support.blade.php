<?php $page = 'support';?> @include ('inc.navadmin')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Support</title>
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
        <div class="col-sm-6 mb-3 mb-sm-0">
            <div class="card text-left shadow h-100 py-2 w-100">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs text-primary text-uppercase mb-2" style="font-size:40px; font-weight: bold;">
                                {{$pendingTicket}}
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
                                <div class="text-xs text-primary text-uppercase mb-2" style="font-size:40px; font-weight: bold;">
                                    {{$closedTicket}}
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
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h2 class="mb-1" style="color: #535353; font-family:Helvetica Neue">Support Tickets</h2>
                        <div class="d-flex justify-content-end">
                        <a href="support" type="button" class="btn btn-primary" style="margin-right: 20px">Open</a>
                        <a href="supportClosed" type="button" class="btn btn-light">Closed</a>
                        </div>
                        </div>
                        <div class="card-body">
                            @if(Session::has('success'))
                        <div class="alert alert-success" role="alert">
                            {{Session::get('success')}}
                        </div>
                    @endif
                            <table>
                                <tr>
                                  <th>ID</th>
                                  <th>Name</th>
                                  <th>Title</th>
                                  <th>Description</th>
                                  <th>Date Created</th>
                                  <th>Action</th>
                                </tr>
                                @foreach($pendingTickets as $ticket)
                                <tr>
                                    <td>{{ $ticket->id }}</td>
                                    <td>{{ $ticket->name }}</td>
                                    <td>{{ $ticket->title }}</td>
                                    <td>{{ $ticket->description }}</td>
                                    <td>{{ $ticket->created_at->format('M d, Y') }}</td>
                                  <td>
                                    <button type="button" class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#TICKETMODAL_{{ $ticket->id }}">
                                        View
                                        </button>
                                        <div class="modal fade" id="TICKETMODAL_{{ $ticket->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog fixed-modal-dialog mx-auto my-5" role="document">
                                                <div class="modal-content text-center">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body text-center">
                                                                <h1>{{ $ticket->title }}</h1>
                                                                <h5>{{ $ticket->name }}</h5>
                                                                <br>
                                                                <p>Description:</p>
                                                                <p>{{ $ticket->description }}</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>                                                                   
                                    <form action="{{ route('close', $ticket->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-danger btn-sm">Close</button>
                                    </form>
                                    </td>
                                </tr>
                                @endforeach
                              </table>
                              {{ $pendingTickets->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>