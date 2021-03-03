@extends('layouts.app')
@section('content')
<div class="container">
    <section class="menu">
        @if (session('created'))
            <div class="alert alert-success">
                Il piatto - {{ session('created') }} - è stato correttamente creato!
            </div>
        @elseif(session('deleted'))
            <div class="alert alert-danger">
                Il piatto - {{ session('deleted') }} - è stato correttamente cancellato!
            </div>
        @endif
    
        {{-- Menu Ristorante - Tabella --}}
        <h1 class="admin-title text-center">Menu Ristorante</h1>
        @if(empty($dishes))
            <p class="intro-menu">
                In questa sezione ti è possibile visualizzare tutti i piatti presenti nel tuo menu online, modificarli, cancellarli o aggiungerne di nuovi.
                <strong>ATTENZIONE! Al momento, non sono presenti piatti nel tuo menu, comincia a <a href="{{ route('admin.dishes.create') }}">creare il primo piatto</a>!</strong> 
            </p>
        @else
            <p class="intro-menu">
                In questa sezione ti è possibile visualizzare tutti i piatti presenti nel tuo menu online, modificarli, cancellarli o <a href="{{ route('admin.dishes.create') }}">aggiungerne</a> di nuovi. 
            </p>
            
            <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nome Piatto</th>
                    <th scope="col">Descrizione</th>
                    <th scope="col">Immagine</th>
                    <th scope="col">Tipologia</th>
                    <th scope="col">Vegan</th>
                    <th scope="col">Disponibilità</th>
                    <th scope="col">Prezzo</th>
                    <th scope="col">Utilities</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($dishes as $dish)
                    <tr>
                        <th>{{ $dish->id }}</th>
                        <td>{{ $dish->name }}</td>
                        <td>
                            @if ( $dish->description )
                                <i class="fas fa-check-circle green-icon"></i>
                            @else
                                <i class="fas fa-times-circle red-icon"></i>
                            @endif
                        </td>
                        <td>
                            @if ($dish->image)
                                <i class="fas fa-check-circle green-icon"></i>
                            @else
                                <i class="fas fa-times-circle red-icon"></i>
                            @endif
                        </td>
                        <td>{{ $dish->typology }}</td>
                        <td>
                            @if ( $dish->vegan )
                                <i class="fas fa-check-circle green-icon"></i>
                            @else
                                <i class="fas fa-times-circle red-icon"></i>
                            @endif
                        </td>
                        <td>
                            @if ( $dish->available )
                                <i class="fas fa-check-circle green-icon"></i>
                            @else
                                <i class="fas fa-times-circle red-icon"></i>
                            @endif
                        </td>
                        <td>{{ $dish->price }} €</td>
                        <td colspan="2" class="d-flex">
                            <a href="{{ route('admin.dishes.show', $dish->id) }}" class="btn btn-brand"> Esplora </a>
                            <a href="{{ route('admin.dishes.edit', $dish->id) }}" class="btn btn-grey"> <i class="fas fa-edit"></i> </a>
                            <form action="{{ route('admin.dishes.destroy', $dish->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-red"><i class="fas fa-trash-alt"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
        @endif
    </section>
</div>
@endsection