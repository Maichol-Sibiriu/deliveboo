<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
  <h1>Crea un nuovo piatto</h1>

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

    <div>
      <label for="name">Nome</label>
      <input type="text" id="name" name="name" value="{{ old('name') }}">
    </div>
    <div>
      <label for="price">Prezzo</label>
      <input type="number" min="0" max="999" id="price" name="price" value="{{ old('price') }}">
    </div>
    <div>
      <label for="image">Immagine</label>
      <input type="file" id="image" name="image" accept="image/*">
    </div>
    <div>
      <label for="description">Descrizione</label>
      <textarea id="description" name="description">{{ old('description') }}</textarea>
    </div>
    <div>
      <label for="typology">Tipologia</label>
      <input type="text" id="typology" name="typology" value="{{ old('typology') }}">
    </div>
    <div>
      <label for="vegan">Vegano</label>
      <input type="checkbox" id="vegan" name="vegan">
    </div>
    <div>
      <label for="available">Disponibilità</label>
      <input type="checkbox" id="available" name="available">
    </div>

    <input type="submit" value="Crea piatto">
  </form>
</body>
</html>