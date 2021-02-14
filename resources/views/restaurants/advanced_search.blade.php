<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>io sono tutti i ristoranti</h1>

    <div>
        <ul>
            @foreach ($restaurants as $restaurant)
               
                <li><a href="{{ route('restaurants.show', $restaurant->slug) }}">{{ $restaurant->name }}</a></li>
                
            @endforeach
        </ul>
    </div>
</body>
</html>