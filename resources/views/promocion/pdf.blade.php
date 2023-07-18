<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Promociones</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        
        h1 {
            color: blue;
        }
        
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .table thead th {
            background-color: green;
            color: white;
            text-align: left;
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        
        .table tbody td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        
        .empty-row td {
            text-align: center;
            font-weight: bold;
        }
        
        .highlight {
            background-color: yellow;
        }
    </style>
</head>
<body>
    <h1>Listado de Promociones</h1>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Descripción</th>
                <th scope="col">Fecha de Inicio</th>
                <th scope="col">Fecha de Fin</th>
                <th scope="col">Precio Promocional</th>
                <th scope="col">Producto</th>
            </tr>
        </thead>
        <tbody>
            @if ($promociones->isEmpty())
                <tr class="empty-row">
                    <td colspan="6">No hay registros</td>
                </tr>
            @else
                @foreach ($promociones as $promocion)
                    <tr class="highlight">
                        <td>{{ $promocion->id_promocion }}</td>
                        <td>{{ $promocion->descripcion }}</td>
                        <td>{{ $promocion->fecha_inicio }}</td>
                        <td>{{ $promocion->fecha_fin }}</td>
                        <td>{{ $promocion->precio_promocional }}</td>
                        <td>{{ $promocion->producto->nombre }}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</body>
</html>