<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>io sono tutti i piatti</h1>

    <ul>
        @foreach ($dishes as $dish)

           <li><a href="{{ route('dishes.show', $dish->id) }}">{{ $dish->name }} {{ $dish->price }}</a></li>
            
        @endforeach
    </ul>
</body>
</html>