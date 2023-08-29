<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/sidebars/">
    


    <!-- Favicons -->
<link rel="apple-touch-icon" href="/docs/5.2/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
<link rel="icon" href="/docs/5.2/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
<link rel="icon" href="/docs/5.2/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
<link rel="manifest" href="/docs/5.2/assets/img/favicons/manifest.json">
<link rel="mask-icon" href="/docs/5.2/assets/img/favicons/safari-pinned-tab.svg" color="#712cf9">
<link rel="icon" href="/docs/5.2/assets/img/favicons/favicon.ico">
<meta name="theme-color" content="#712cf9">
<link rel="stylesheet" href={{asset('artistcss/sidebars.css')}}>
</head>
<body>
    <div class="sidebar position-sticky">
    <div class="flex-shrink-0 p-4 bg-white rounded" style="width: 280px;">
        <a href="/" class="d-flex align-items-center pb-3 mb-3 link-dark text-decoration-none">
          
        </a>
        <ul class="list-unstyled ps-2">
            <li class="mb-1">
                <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#posts-collapse" aria-expanded="true">
                  Posts
                </button>
                <div class="collapse show" id="posts-collapse">
                  <ul class="btn-toggle-nav list-unstyled fw-normal pb-2 small">
                    <li><a href="{{url('/profile')}}" class="link-dark d-inline-flex text-decoration-none rounded">My Posts</a></li>
                <li><a href="{{route('artistAuction')}}" class="link-dark d-inline-flex text-decoration-none rounded">My Auctions</a></li>
                {{-- <li><a href="" class="link-dark d-inline-flex text-decoration-none rounded">Add New Posts</a></li> --}}
                  </ul>
                </div>
              </li>
              <li class="mb-1">
                <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#settings-collapse" aria-expanded="true">
                  Settings
                </button>
                <div class="collapse show" id="settings-collapse">
                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                        <li><a href="{{route('artistSettings')}}" class="link-dark d-inline-flex text-decoration-none rounded">Account Settings</a></li>
                      </ul>
                  
                </div>
              </li>
        </ul>
      </div>
    </div>
</body>
</html>