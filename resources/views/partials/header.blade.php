<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
    <a class="navbar-brand" href="{{ route('welcome') }}">DELIVEBOO</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mx-auto">
        <li class="nav-item">
          <a class="nav-link" href="#">HOME</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">RICERCA AVANZATA</a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        @if (Route::has('login'))
                @auth
                <li>
                    <a href="{{ route('admin.home') }}">Area riservata</a>
                </li>
                @else
                <li>
                    <a href="{{ route('login') }}">Login</a>
                </li>

                    @if (Route::has('register'))
                        <li>
                            <a href="{{ route('register') }}">Register</a>
                        </li>
                    @endif
                @endauth
        @endif
      </ul>
    </div>
  </div>
</nav>    
        