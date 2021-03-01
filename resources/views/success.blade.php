@extends('layouts.main')
@section('content')

<main class="create-restaurant">

    <div class="container d-flex">
 
        <p class="text-center p-success">Il tuo ordine è andato a buon fine</p>
        <a class="btn btn-success" href="{{ route('welcome') }}">Torna alla homepage</a>
        
        <img class="img-success" src="{{ asset('img/rider.png') }}" alt="">
    
    </div>

</main>
@endsection