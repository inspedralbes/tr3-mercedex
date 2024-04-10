<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mercedes Shop</title>
</head>
<body>
    <h1>Mercedes Benz</h1>

    <h2>Detalles del Pedido:</h2>
    <p>Ticket ID: {{ $ticket->id }}</p>

    <h2>Productos:</h2>
    @foreach ($productos as $producto)
    <div style="background-color: #fff; padding: 10px; border-radius: 5px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);">
    <p>{{$producto->quantity}}</p>
    <h3 style="color: #333; margin-top: 0;">{{ $producto->name }}</h3>
        <img src="{{ $producto->image }}" alt="{{ $producto->name }}" style="width: 150px; height: 150px; margin-top: 10px;">
    </div>
    @endforeach
</body>
</html>