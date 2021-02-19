<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
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
</body>
</html>
