<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <input type="hidden" value="@php echo($id) @endphp" id="restaurant_id">
    <div style="display: flex">
        <div style="position: relative; height:400px; width:400px">
    
            {{-- creazione grafico --}}
            <canvas id="mediaAnno" width="400" height="400"></canvas>
    
        </div>
    
        <div style="position: relative; height:400px; width:400px">
    
            {{-- creazione grafico --}}
            <canvas id="mediaMese" width="400" height="400"></canvas>
    
        </div>

        <div style="position: relative; height:400px; width:400px">
    
            {{-- creazione grafico --}}
            <canvas id="ordiniMensili" width="400" height="400"></canvas>
    
        </div>

        <div style="position: relative; height:400px; width:400px">
    
            {{-- creazione grafico --}}
            <canvas id="ordiniAnnuali" width="400" height="400"></canvas>
    
        </div>
    </div>

    <script src="{{ asset('js/stats.js') }}"></script>
</body>
</html>