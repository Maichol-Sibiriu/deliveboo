@extends('layouts.app')

@section('content')
<main class="main-admin-home d-flex">

  <!-- sidebar -->
  <div class="sidebar ">
    <h6 class="text-center mb-5">CREA / MODIFICA RISTORANTE</h6>
     <!-- menu -->
    <div class="side-menu mb-5">
      <h6>MENU</h6>
      <div class="cont-menu">
        <ul>
          <li>
            <a href="{{ route('admin.dishes.index') }}">Visualizza Menu</a>
          </li>
          <li>
            <a href="{{ route('admin.dishes.create') }}">Aggiungi Nuovo Piatto</a>
          </li>
        </ul>
      </div>
    </div>

    <!-- ordini -->
    <div class="side-menu">
      <h6>ORDINI</h6>
      <div class="cont-menu">
        <ul>
          <li>
            <a href="{{ route('admin.orders.index') }}">Visualizza Ordini</a>
          </li>
          <li>
            <a href="#">Statistiche Ordini</a>
          </li>
        </ul>
      </div>
    </div>

  </div>

    <!-- content here -->
  <div class="content ">
    @if (session('saved'))
    <div class="alert alert-success text-center">
      <p>Il tuo ristorante {{session('saved')}} è stato creato!</p>
    </div>
    @elseif (session('updated'))
    <div class="alert alert-warning text-center">
      <p>Il tuo ristorante {{session('updated')}} è stato modificato.</p>
    </div>
    @elseif (session('deleted'))
    <div class="alert alert-danger text-center">
      <p>Il ristorante {{session('deleted')}} è stato cancellato!</p>
    </div>
    @endif

    @forelse ($user->restaurants as $restaurant)

    <!-- logo here -->
    <div class="logo mb-4">
      @if(!empty($restaurant->image_logo))
      <img src="{{ asset('storage/' . $restaurant->image_logo)}}" alt="">
      @else
      <img src="https://lh3.googleusercontent.com/proxy/aU3eznafn9kTe0YVQvWmD_B7zXugOCXhDXBTY8jDIaHS4bt4FkNTeoSMDsSw1y26qZo_T1AxP15BtBfQrZwr-kr7gWBjNsc3vyHmA30tJM1AqgcEFlNuDdLlt2j1VDE4kAExZsXEFp8J7yu5MSZU5w" alt="">
      @endif
    </div>

    <!-- content titolo + info ristorante -->
    <div class="info-risto">
      <h2>{{ $restaurant->name }}</h2>
      <p class="address">
        <i class="fas fa-map"></i> : {{$restaurant->address}}
      </p>
      <p class="p-iva"> P.IVA : {{$restaurant->vat_num}}
      </p>
      <p class="phone">
        <i class="fas fa-phone"></i>: {{$restaurant->phone}}
      </p>

      <div class="btns d-flex mt-5 mb-4">
        <a class="btn ordini text-center" href="{{route('admin.orders.index')}}">ORDINI
        </a>
        <a class="btn menu text-center" href="{{ route('admin.dishes.index') }}">
          MENU
        </a>
        <a class="btn edit text-center" href="{{ route('admin.restaurants.edit', $restaurant->id) }}">MODIFICA RISTORANTE</a>
      </div>

      <!-- form cancellazione ristorante -->
      <form action="{{ route('admin.restaurants.destroy', $restaurant->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <input class="btn delete" type="submit" value="Cancella Ristorante">
      </form>
      @empty
      <div class="empty text-center">
        <h2>Benvenuto in Deliveboo!!!</h2>
        <p>Inizia da qui, creando il tuo ristorante dedicato alle consegne a domicilio.</p>
        <a class="btn create text-center"   href="{{route('admin.restaurants.create') }}">
          CREA RISTORNATE
        </a>
      </div>

    </div>
  </div>

    @endforelse

</main>
@endsection
