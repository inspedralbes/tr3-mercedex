<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mercedes Shop</title>
</head>

<body style="margin: 0; padding-bottom: 200px; font-family: Arial, sans-serif; background-color:black;">

    <div style="text-align: center;">
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/90/Mercedes-Logo.svg/2048px-Mercedes-Logo.svg.png" style="width: 80px; height: 80px; margin: 0 auto; margin-top:15px;" alt="">
        <hr style="background-color:white; height:5px; width:100vw;margin-top:10px;">
    </div>

    <h2 style="color: white; text-align: center;font-weight:bold;font-size:16px;margin-top:50px;">Gracias por tu compra!</h2>
    <div style="background-color: white; padding: 10px; border-radius: 5px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); margin: 0 auto 20px; max-width: 400px;">
        <h2 style="color: #333; text-align: center;font-size:27px;font-weight:bolder;">Información del Pedido</h2>
        <p style="color: #333; text-align: center;font-weight:bold;">Numero de pedido: {{ $ticket->id }}</p>
        <p style="color: #333; text-align: center;font-weight:bold;">Número de teléfono: {{ $ticket->phone }}</p>
        <p style="color: #333; text-align: center;font-weight:bold;">Dirección de envío: {{ $ticket->address }}</p>
        <p style="color: #333; text-align: center;font-weight:bold;">Total: {{ $ticket->total }}€</p>
    </div>

    <h2 style="color: white; text-align: center;font-weight:bold;font-size:16px;">Productos comprados:</h2>
    @foreach ($productos as $producto)
    <div style="background-color: white; padding: 10px; border-radius: 5px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); margin: 0 auto 20px; max-width: 600px; display: flex; align-items: center; border-bottom:7px solid white;">
        <img src="{{ $producto->image }}" alt="{{ $producto->name }}" style="width: 150px; height: 150px; margin-right: 10px;margin-left:40px;">
        <div>
            <h3 style="color: black; margin: 0; margin-bottom: 5px;margin-left:30px;margin-top:20px; font-weight: bold; font-size:24px;">{{ $producto->name }}</h3>
            <p style="color: black; margin: 0;margin-left:30px;margin-top:20px;">Cantidad: {{ $producto->quantity }}</p>
            <p style="color: black; margin: 0;margin-left:30px;margin-top:20px;font-weight:bold;">Precio: {{ $producto->price }}€</p>
        </div>
    </div>
    @endforeach
</body>

</html>