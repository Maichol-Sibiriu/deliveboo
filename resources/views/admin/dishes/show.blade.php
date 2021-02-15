<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

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
</body>
</html>