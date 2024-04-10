<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank you for subscribing!</title>
</head>
<body>
    <h1>Thank you for subscribing to our newsletter!</h1>

    <h2>Ticket Details:</h2>
    <p>Ticket ID: {{ $ticket->id }}</p>
    <!-- Aquí puedes mostrar más detalles del ticket si lo deseas -->

    <h2>Products:</h2>
    @foreach ($productos as $producto)
        <div>
            <h3>{{ $producto->name }}</h3>
            <img src="{{ $producto->image }}" alt="{{ $producto->name }}">
        </div>
    @endforeach
</body>
</html>
