<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href={{asset('artistcss/navbar.css')}}>
</head>
<body>
    <nav class="navbar sticky-top bg-white navbar navbar-expand-sm py-0" data-bs-theme="light">
        <div class="container-fluid">
            
            <a class="navbar-brand"><img class="logo" src="artistimg/image 3.png" alt="..." height="81" width="81"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="mx-auto" style="width: 250px;">
                
              </div>
              
              <div class="mx-auto text-center" style="width: 300px;">
                <h2>ARTIST CENTRE<h2>
              </div>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{route('artistHome')}}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{route('chatify')}}">Messages</a>
                    </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle active" role="button" data-bs-toggle="dropdown">Profile</a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="{{url('editprofile')}}">Edit Profile</a></li>
                  <a class="dropdown-item" href="{{ route('artistLogout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('artistLogout') }}" method="POST" class="d-none">
                    @csrf
                    @method('delete')
                </form>
                
                
                </ul>
              </li>
            </ul>
            
          </div>
        </div>
      </nav>
</body>
</html>



  
    
