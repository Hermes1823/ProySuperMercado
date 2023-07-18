<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <h1 style="text-align: center;color:red">INFORME</h1>
    <h4>Empleado: {{Auth::user()->name}}</h4>
    <h4>Cargo: {{Auth::user()->rol}}</h4>
    <h4>
        <?php
           $DateAndTime = date('d-m-Y');
            echo "Fecha: $DateAndTime";
        ?>
    </h4>
    <div>
        <script>
        date = new Date().toLocaleDateString();
        document.write(date);
        </script>
    </div>
    <table class="table" border="1" style="margin-left:auto;margin-right:auto">
        <thead>
            <tr>
                <th scope="col">Id Almacen</th>
                <th scope="col">Empleado</th>
                <th scope="col">Fecha que almaceno</th>
            </tr>
        </thead>
        <tbody>
            @if (count($almacenD)<=0)
            <tr>
                <td colspan="3"><i>:: NO HAY REGISTROS ::</i></td>
            </tr>
            @else
                @foreach ($almacenD as $itemAl)
                <tr>
                    <td>
                        @foreach ($almacenes as $itemalma)
                        @if ($itemalma->id == $itemAl->idalmacen)
                            {{ $itemalma->nombre}}
                        @break
                        @endif
                    @endforeach
                    </td>
                    <td>
                        @foreach ($personas as $itemUser)
                            @if ($itemUser->id == $almacenD->idusuario)
                                {{ $itemUser->name }}
                                @break
                            @endif
                        @endforeach
                    </td>
                    <td>
                        <p>{{ $itemAl->fecha}}</p>
                    </td>
                </tr>
                @endforeach
            @endif
        </tbody>
    </table><br>
</body>
</html>
