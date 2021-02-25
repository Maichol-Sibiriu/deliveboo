@extends('layouts.app')
@section('content')
<h1>Il mio Menu </h1>
    @if (session('created'))
        <h3>Il piatto - {{ session('created') }} - è stato creato!</h3>
    @elseif(session('deleted'))
    <h3>Il piatto - {{ session('deleted') }} - è stato cancellato!</h3>
    @endif
    <ul>
        @foreach ($dishes as $dish)
           <li><a href="{{ route('admin.dishes.show', $dish->id) }}">{{ $dish->name }} {{ $dish->price }}</a></li>
        @endforeach

        <button><a href="{{ route('admin.dishes.create') }}">Aggiungi un piatto al menù</a></button>
    </ul>
@endsection