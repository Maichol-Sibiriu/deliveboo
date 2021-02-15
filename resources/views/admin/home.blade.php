@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <button><a href="{{ route('admin.restaurants.create') }}">Crea Nuovo Ristorante</a></button>

                @if (session('saved'))
                    <p>E' stato creato un ristorante dal nome: {{session('saved')}}</p>  
                
                @elseif (session('updated'))
                    <p>Il ristorante: {{session('updated')}}, è stato modificato</p>  
                
                @endif
                {{-- <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div> --}}
                    
                @forelse ($user->restaurants as $restaurant)
                    <h3>{{ $restaurant->name }}</h3>
                    <button><a href="{{ route('admin.orders.index') }}">ORDINI</a></button>
                    <button><a href="{{ route('admin.dishes.index') }}">PIATTI</a></button>
                    <button><a href="{{ route('admin.restaurants.edit', $restaurant->id) }}">Modifica Ristorante</a></button>
                @empty
                    {{-- <button><a href="{{ route('admin.restaurants.edit', $restaurant->id) }}">Modifica Ristorante</a></button> --}}
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
