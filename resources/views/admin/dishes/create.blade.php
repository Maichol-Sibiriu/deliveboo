@extends('layouts.app')
@section('content')
<h1 class="text-center">Crea un nuovo piatto</h1>

  @if ($errors->any())
    <ul>
      @foreach ($errors->all() as $error)
        <li>
          {{ $error }}
        </li>
      @endforeach
    </ul>
  @endif

  <form action="{{ route('admin.dishes.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('POST')

    <div class="form-group">
      <label for="name" class="name">Nome</label>
      <input type="text" class="form-control create" id="name" name="name" value="{{ old('name') }}">
    </div>
    <div class="form-group">
      <label for="price" class="price">Prezzo</label>
      <input type="number" class="form-control create" min="0" max="999" id="price" name="price" value="{{ old('price') }}">
    </div>
    <div>
      <label for="image" class="img">Immagine</label>
      <input type="file" class="form-control create" id="image" name="image" accept="image/*">
    </div>
    <div class="form-group">
      <label for="description" class="description1">Descrizione</label>
      <textarea id="description" class="form-control create mb-2" name="description">{{ old('description') }}</textarea>
    </div>
    <div>
      <label for="typology" class="typology">Tipologia</label>
      <select name="typology" class="form-control create" id="typology">
        @foreach($typologies as $typology)
          <option value="{{ $typology }}">{{ $typology }}</option>
        @endforeach
      </select>
      {{-- <input type="text" id="typology" name="typology" value="{{ old('typology') }}"> --}}
    </div>
    <div>
      <label for="vegan" class="vegan1">Vegano</label>
      <input type="checkbox" id="vegan" name="vegan">
    </div>
    <div>
      <label for="available" class="available1">Disponibilità</label>
      <input type="checkbox" id="available" name="available">
    </div>

    <input type="submit1" class="btn btn-primary submit1 form-control create" value="Crea piatto">
  </form>
@endsection