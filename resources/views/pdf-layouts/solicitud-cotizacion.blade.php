<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <style>
        /* Agrega estilos CSS para la tabla */
        body {
            margin: 0;
            padding: 0;
        }
        .header {
            background-color: #f2f2f2;
            padding: 10px;
        }
        .header__texto {
            float: left;
           
        }
        .header__img img {
            max-width: 100%;
            width: 150px;
            float: right;
        }
        /* Limpiar flotantes para evitar colapsos de contenedor */
        .clearfix::after {
            content: "";
            display: table;
            clear: both;
        }

        .texto1{
            line-height: .1;
        }
        .texto-central p span{
            font-weight: 500;
        }
        .texto-central{
            max-width: 580px;
            
            padding-top:30px;
        }
    </style>

    <header class="header clearfix">
        <div class="header__texto">
            <div class="texto1">
                <h4>RUC: 1475566984</h4>
                <h4>Supermercado Estrella</h4>
                <h5>Trujillo - La Libertad - Perú</h5>
                <h5>{{$fechaSolicitud}}</h5>
            </div>
        </div>
        <div class="header__img">
            <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('/imagenes/logo2.png'))) }}" alt="">
        </div>
    </header>
    <div class="texto-central">
        <p>Estimado proveedor <span>{{$header[0]->nombreProveedor}}</span> 
            con ruc <span>{{$header[0]->rucProveedor}}</span>:</p>
        <p>Le brindamos nuestros saludos coordiales,hemos observado con agrado sus catálogos,por lo cual
            solicitamos la cotización de los siguientes productos: </p>
    </div>
    <table>
        <thead>
            <tr>
                <th>Nombre del Producto</th>
                <th>Cantidad</th>
            </tr>
        </thead>
        <tbody>
            @foreach($productos as $producto)
            <tr>
                <td>{{ $producto->nombreProducto }}</td>
                <td>{{ $producto->cantidad }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
