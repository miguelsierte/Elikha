<?php $page = 'usermanagement';?>@include('inc.navadmin')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    
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
    <div class="row">
        <div class="col-mb-8">
            <div class="card shadow mb-8 h-100 p-3 w-100">
                <div class="row no-gutters align-items-center">
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
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <a href="{{ url('create') }}" class="btn btn-dark" title="Add New Student">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add User
                        </a>
                        <form method="get" action="{{ route('usermanagement') }}">
                            <select name="role_filter" style="padding: 0.5em; font-size: 1em; border-radius: 0.25em; border: 1px solid #ccc;">
                                <option value="-1">All Roles</option>
                                <option value="0">Admin</option>
                                <option value="1">Assistant Admin</option>
                                <option value="2">Artist</option>
                                <option value="3">Buyer</option>
                              </select>
                              <button type="submit" style="background-color: #000000; color: #fff; border: none; padding: 0.5em 1em; border-radius: 0.25em; font-size: 1em; cursor: pointer;">
                                Filter
                              </button>
                        </form>
                        <div class="input-group" style="max-width: 300px;">
                            <input type="text" class="form-control" placeholder="Search users" id="search-input">
                            <button class="btn btn-outline-dark" type="button" id="search-button">Search</button>
                        </div>
                    </div>
                    <script>
                        const searchButton = document.querySelector('#search-button');
                        const searchInput = document.querySelector('#search-input');
                    
                        searchButton.addEventListener('click', function() {
                            const searchTerm = searchInput.value;
                            window.location.href = '/usermanagement/search?search=' + searchTerm;
                        });
                    </script>
                    <br/>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                    <th>User ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->role }}</td>

                                    <td>
                                        <button type="button" class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#USERMODAL_{{ $user->id }}">
                                            View
                                        </button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="USERMODAL_{{ $user->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">User ID: {{ $user->id }}</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Name: {{ $user->name }}</p>
                                                        <p>Email: {{ $user->email }}</p>
                                                        <p>Mobile: {{ $user->mobile }}</p>
                                                        <p>Role: {{ $user->role }}</p>
                                                        <!-- Add other user details here if needed -->
                                                    </div>
                                                    <div class="modal-footer">
                                                        <!-- Add any buttons or actions you want in the footer here -->
                                                        <button type="button" class="btn btn-outline-secondary btn-sm" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $user->id }}">
                                            <i class="fa fa-trash-o" aria-hidden="true"></i> Delete
                                        </button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="deleteModal{{ $user->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $user->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel{{ $user->id }}">Confirm Delete</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure you want to delete this user?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                                                        <form method="POST" action="{{ url('/usermanagement' . '/' . $user->id) }}" accept-charset="UTF-8">
                                                            {{ method_field('DELETE') }}
                                                            {{ csrf_field() }}
                                                            <button type="submit" class="btn btn-outline-danger">Delete</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $users->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
