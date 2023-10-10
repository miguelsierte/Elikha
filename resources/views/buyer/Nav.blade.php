<nav class="navbar navbar-expand-lg fixed-top" style="background-color: #ffffff" class="shadow-sm p-3 mb-5 bg-white rounded">
    <div class="container-fluid">
        <a class="navbar-brand">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" width="50" height="15" class="d-inline-block align-text-top"> 
        </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link {{ Request::is('buyerhome') ? 'active' : '' }}" href="/buyerhome">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::is('about') ? 'active' : '' }}" href="#about-section">About</a>
          </li>
          <li class="nav-item"> 
            <a class="nav-link {{ Request::routeIs('chatify') ? 'active' : '' }}" href="{{ route('chatify') }}">Messages</a>
        </li>  
          <li class="nav-item">
            <a class="nav-link {{ Request::is('shopbuyer', 'popart', 'realism', 'abstract', 'expressionism', 'impressionism', 'photorealism', 'portrait') ? 'active' : '' }}" href="/shopbuyer">Shop</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::is('cart') ? 'active' : '' }}" href="/cart">Cart</a>
          </li>
        </ul>
        
        <li class="nav-item">
          <button class="btn profile-image-button" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
            <br>
              <div class="profile-image-button">
                  @if($user->image)
                      <img src="{{ asset('images/'.$user->image) }}" class="profile-image-buyers">
                  @else
                      <div class="text-center">{{ $user->name[0] }}</div>
                  @endif
              </div>
          </button>
      </li>
      </div>
    </div>
</nav>
<style>
  
  .default-profile-image {
  display: flex;
  justify-content: center;
  align-items: center;
  background-color: #3a3a3a;
  color: #ffffff;
  font-size: 100px;
  font-weight: bold;
  border-radius: 50%;
  width: 152px;
  height: 152px;
  border-radius: 55%;
  }
  .profile-image-button {
    width: 39px; /* Maintain the fixed width */
    height: 39px; /* Maintain the fixed height */
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: #3a3a3a;
    text-align: center; /* Center text horizontally */
    color: #ffffff;
    font-weight: bold;
    font-size: 20px;
}


  .profile-image-buyers {
      max-width: 400%;
      max-height: 400%;
      object-fit: cover;
      border-radius: 50%;
  }

li::marker {
  color: rgb(255, 255, 255);

}

  

</style>

<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasRightLabel">Profile</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body text-center">
    <div>
      <div class="profile-image">
        @if($user->image)
            <img src="{{ asset('images/'.$user->image) }}" class="profile-image-buyer">
        @else
            <div class="profile-image-buyer rounded-circle">
                <div class="text-center">{{ $user->name[0] }}</div>
            </div>
        @endif
    </div>
      <h3 class="m-b-0">{{ Auth::user()->name }}</h3>
  </div>
  <style>
      .profile-image {
          width: 80px;
          height: 80px;
          border-radius: 50%;
          background-color: #3a3a3a;
          display: flex;
          justify-content: center;
          align-items: center;
          text-align: center; /* Center text horizontally */
          color: #ffffff;
          font-weight: bold;
          font-size: 50px;

      }
  
      .profile-image-buyer {
          max-width: 100%;
          max-height: 100%;
          object-fit: cover;
          border-radius: 50%;
      }
      .profile-image img {
    border-radius: 50%;
    max-width: 150px;
    max-height: 150px;
    margin: 50px;
    
  }
  

  </style>
  
    <div class="row">
      <div class="d-grid gap-2 col-6 mx-auto">
        <a href="{{ route('buyer.setting') }}" class="btn btn-hover" role="button">Settings</a>
        <a href="{{ route('cart.show') }}" class="btn btn-hover" role="button">My Cart</a>
        <a class="dropdown-item" href="{{ route('buyerLogout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('buyerLogout') }}" method="POST" class="d-none">
                    @csrf
                    @method('delete')
                </form>
      </div>
      
      
    </div>
  </div>
</div>
