@extends('layouts.app')

@section('content')
<main class="main-admin-home d-flex">

  <div class="sidebar ">
    <h6 class="text-center">CREA / MODIFICA RISTORANTE</h6>

    <div class="side-menu">
      <div class="btn-group">
        <button type="button" class="btn btn-menu dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          MENU
        </button>
        <div class="dropdown-menu box-menu">
          <a class="dropdown-item" href="#">Visualizza Menu</a>
          <a class="dropdown-item" href="#">Aggiungi nuovo piatto</a>
        </div>
      </div>
    </div>

    <div class="side-ordini">

    </div>
  </div>

  <div class="content ">
    @if (session('saved'))
    <div class="alert alert-success">
      <p>E' stato creato un ristorante dal nome: {{session('saved')}}</p>
    </div>
    @elseif (session('updated'))
    <div class="alert ">
      <p>Il ristorante: {{session('updated')}}, è stato modificato</p>
    </div>
    @elseif (session('deleted'))
    <div class="alert alert-danger">
      <p>Il ristorante - {{session('deleted')}} - è stato cancellato!</p>
    </div>
    @endif

    @forelse ($user->restaurants as $restaurant)

    <!-- logo here -->
    <div class="logo mb-4">
      <img src="{{ asset('storage/' . $restaurant->image_logo)}}" alt="">
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
      <div class="empty">
        <a class="btn create text-center"   href="{{route('admin.restaurants.create') }}">
          CREA IL TUO RISTORNATE
        </a>
      </div>

    </div>

  </div>



    @endforelse

</main>
@endsection
