@extends('layouts.app')

@section('content')
<main class="main-admin-home">

  <!-- <div class="sidebar">
    content sidebar
  </div> -->

  <div class="container">


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
    <div class="cont-home">
      <h2>{{ $restaurant->name }}</h2>

      <div class="info-rest">
        <p class="address">
          <i class="fas fa-map"></i>
          : {{$restaurant->address}}</p>
          <p class="p-iva"> P.IVA : {{$restaurant->vat_num}} </p>
          <p class="phone"> <i class="fas fa-phone"></i>: {{$restaurant->phone}} </p>
        </div>
    </div>

    <div class="btns d-flex mt-5 mb-4">
      <a class="btn ordini text-center" href="{{route('admin.orders.index')}}">ORDINI
      </a>
      <a class="btn menu text-center" href="{{ route('admin.dishes.index') }}">
        MENU
      </a>
      <a class="btn edit text-center" href="{{ route('admin.restaurants.edit', $restaurant->id) }}">MODIFICA RISTORANTE</a>
    </div>


    <form action="{{ route('admin.restaurants.destroy', $restaurant->id) }}" method="POST">
      @csrf
      @method('DELETE')
      <input class="btn delete" type="submit" value="Cancella Ristorante">
    </form>
    @empty
    <div class="empty">
      <a class="btn create text-center" href="{{route('admin.restaurants.create') }}">
      CREA IL TUO RISTORNATE
    </a>
  </div>

    @endforelse







<!--
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card"> -->
          <!-- <div class="card-header">{{ __('Dashboard') }}</div>
          {{-- <button><a href="{{ route('admin.restaurants.create') }}">Crea Nuovo Ristorante</a></button> --}} -->


          <!-- {{-- <div class="card-body">
            @if (session('status'))
            <div class="alert alert-success" role="alert">
              {{ session('status') }}
            </div>
            @endif
            {{ __('You are logged in!') }}
          </div> --}} -->

          <!-- @forelse ($user->restaurants as $restaurant)
          <h3>{{ $restaurant->name }}</h3>
          <button><a href="{{ route('admin.orders.index') }}">ORDINI</a></button>
          <button><a href="{{ route('admin.dishes.index') }}">PIATTI</a></button>
          <button><a href="{{ route('admin.restaurants.edit', $restaurant->id) }}">Modifica Ristorante</a></button>
          <form action="{{ route('admin.restaurants.destroy', $restaurant->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <input type="submit" value="Cancella Ristorante">
          </form>
          @empty
          <button><a href="{{ route('admin.restaurants.create') }}">Crea Nuovo Ristorante</a></button>
          @endforelse -->
        </div>
      </div>
    </div>



  </div>
</main>
@endsection
