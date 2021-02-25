@extends('layouts.app')
@section('content')
@if (session('updated'))
<p>Il piatto {{ session('updated') }} è stato modificato</p>
@endif

<h1>{{ $dish->name }}</h1>
<h1>{{ $dish->price }}</h1>
<h1>{{ $dish->description }}</h1>
@isset($dish->image)
<img src="{{ asset('storage/' . $dish->image) }}" width="100">
<h6>Change Old Image:</h6>
@endisset

<button> <a href="{{ route('admin.dishes.edit', $dish->id) }}">Modifica piatto</a> </button>

<form action="{{ route('admin.dishes.destroy', $dish->id) }}" method="POST">
@csrf
@method('DELETE')
<input type="submit" value="Cancella piatto">
</form>
@endsection