<nav class="navbar navbar-expand-lg">
    <a class="navbar-brand" href="{{ route('welcome') }}">
      <img src="{{ asset('img/logo.png') }}" alt="Deliveboo">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <ul class="navbar-nav mx-auto navbar-center">
      <li class="nav-item">
        <a class="nav-link" href="#">HOME</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">RICERCA AVANZATA</a>
      </li>
    </ul>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto">
        @if (Route::has('login'))
                @auth
                <li>
                    <a class="nav-link" href="{{ route('admin.home') }}">Area riservata</a>
                </li>
                @else
                <li class="mr-3">
                    <a class="nav-link" href="{{ route('login') }}">LOGIN</a>
                </li>

                @if (Route::has('register'))
                    <li>
                        <a class="nav-link" href="{{ route('register') }}">REGISTER</a>
                    </li>
                @endif
                @endauth
        @endif
      </ul>
    </div>
</nav>    
        