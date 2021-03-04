@extends('layouts.app')

@section('content')
<main class="main-admin d-flex">

  <!-- sidebar -->
  @include('partials.sidebar')

    <!-- content here -->
  <section class="admin-content ">
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
      <h2 class="admin-title">{{ $restaurant->name }}</h2>
      <p class="address">
        <i class="fas fa-map"></i> : {{$restaurant->address}}
      </p>
      <p class="p-iva"> P.IVA : {{$restaurant->vat_num}}
      </p>
      <p class="phone">
        <i class="fas fa-phone"></i>: {{$restaurant->phone}}
      </p>

      <div class="btns d-flex">
        <a class="btn btn-brand text-center" href="{{route('admin.orders.index')}}">ORDINI
        </a>
        <a class="btn btn-brand text-center" href="{{ route('admin.dishes.index') }}">
          MENU
        </a>
        <a class="btn btn-brand text-center" href="{{ route('admin.restaurants.edit', $restaurant->id) }}">MODIFICA RISTORANTE</a>
        <!-- form cancellazione ristorante -->
        <form action="{{ route('admin.restaurants.destroy', $restaurant->id) }}" method="POST">
          @csrf
          @method('DELETE')
          <button class="btn btn-red" type="submit">Cancella Ristorante</button>
        </form>
      </div>

      @empty
      <div class="empty text-center">
        <h2>Benvenuto in Deliveboo!!!</h2>
        <p>Inizia da qui, creando il tuo ristorante dedicato alle consegne a domicilio.</p>
        <a class="btn btn-brand text-center"   href="{{route('admin.restaurants.create') }}">
          CREA RISTORNATE
        </a>
      </div>

    </div>
  </section>

    @endforelse

</main>
@endsection