@extends('layouts.app')
@section('content')
<h1>Modifica piatto</h1>

  @if ($errors->any())
    <ul>
      @foreach ($errors->all() as $error)
        <li>
          {{ $error }}
        </li>
      @endforeach
    </ul>
  @endif

  <form action="{{ route('admin.dishes.update', $dish->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PATCH')

    <div>
      <label for="name">Nome</label>
      <input type="text" id="name" name="name" value="{{ old('name', $dish->name) }}">
    </div>
    <div>
      <label for="price">Prezzo</label>
      <input type="number" min="0" max="999" id="price" name="price" value="{{ old('price', $dish->price) }}">
    </div>
    <div>
      <label for="image">Immagine</label>

      @isset($dish->image)
        <img src="{{ asset('storage/' . $dish->image) }}" width="100">
        <h6>Change Old Image:</h6>
      @endisset

      <input type="file" id="image" name="image" accept="image/*">
    </div>
    <div>
      <label for="description">Descrizione</label>
      <textarea id="description" name="description">{{ old('description', $dish->description) }}</textarea>
    </div>
    <div>
      <label for="typology">Tipologia</label>
      <input type="text" id="typology" name="typology" value="{{ old('typology', $dish->typology) }}">
    </div>
    <div>
      <label for="vegan">Vegano</label>
      <input type="checkbox" id="vegan" name="vegan" @if($dish->vegan) checked @endif>
    </div>
    <div>
      <label for="available">Disponibilità</label>
      <input type="checkbox" id="available" name="available" @if($dish->available) checked @endif>
    </div>

    <input type="hidden" name="restaurant_id" value="{{ $dish->restaurant_id }}">

    <input type="submit" value="Modifica piatto">
  </form>
@endsection