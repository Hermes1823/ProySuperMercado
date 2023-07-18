<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Informe de Almacén</title>
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
    <div>
        <p>
            Características:
            El presente informe tiene como objetivo proporcionar una visión
            general del estado actual del almacén y los productos almacenados.
            A continuación, se detallan los aspectos relevantes:
        </p>
        <br>
    </div>
    <table class="table" border="1" style="margin-left:auto;margin-right:auto">
        <thead>
            <tr>
                <th style="margin: 10px" scope="col">Almacén</th>
                <th style="margin: 10px" scope="col">Usuario</th>
                <th style="margin: 10px"  scope="col">Fecha de Almacenado</th>
            </tr>
        </thead>
        <tbody>
            @if (count($almacenD) <= 0)
            <tr>
                <td colspan="3"><i>:: NO HAY REGISTROS ::</i></td>
            </tr>
            @else
                @foreach ($almacenD as $itemAl)
                <tr>
                    <td>
                        <p style="margin: 10px">
                        @foreach ($almacenes as $itemalma)
                            @if ($itemalma->id == $itemAl->idalmacen)
                                {{ $itemalma->nombre}}
                            @break
                            @endif
                        @endforeach
                        </p>
                    </td>
                    <td>
                        <p style="margin: 10px">
                            @foreach ($perso as $itrem)
                            {{ $itrem->name}}
                            @break
                            @endforeach
                        </p>
                    </td>
                    <td>
                        <p style="margin: 10px">
                            {{ $itemAl->fecha}}
                        </p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p style="margin: 10px">Ubicacion:
                            @foreach ($almacenes as $itemalma)
                                @if ($itemalma->id == $itemAl->idalmacen)
                                    {{ $itemalma->ubicacion}}
                                @break
                                @endif
                            @endforeach
                            </p>
                    </td>
                    <td>
                        <p style="margin: 10px">
                            @foreach ($perso as $itrem)
                            {{ $itrem->email}}
                            @break
                            @endforeach
                        </p>
                    </td>
                    <td>
                        <p style="margin: 10px">
                            {{ $itemAl->fecha}}
                        </p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p style="margin: 10px">Capacidad:
                            @foreach ($almacenes as $itemalma)
                                @if ($itemalma->id == $itemAl->idalmacen)
                                    {{ $itemalma->capacidad}}
                                @break
                                @endif
                            @endforeach
                            </p>
                    </td>
                    <td>
                        <p style="margin: 10px">
                            @foreach ($perso as $itrem)
                            {{ $itrem->idrol}}
                            @break
                            @endforeach
                        </p>
                    </td>
                    <td>
                        <p style="margin: 10px">
                            {{ $itemAl->detalle}}
                        </p>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" style="text-align: center">
                      <b>ID Producto:</b>  <p>  {{ $itemAl->idproducto}}</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>
                            @foreach ($productos as $itemproduc)
                            @if ($itemproduc->id == $itemAl->idproducto)
                                {{ $itemproduc->nombre}}
                            @break
                            @endif
                            @endforeach
                        </p>
                    </td>
                    <td>
                        <p>
                            @foreach ($productos as $itemproduc)
                            @if ($itemproduc->id == $itemAl->idproducto)
                            Stock:  {{ $itemproduc->stock}}
                            @break
                            @endif
                            @endforeach
                        </p>
                    </td>
                    <td>
                        <p>
                            @foreach ($productos as $itemproduc)
                            @if ($itemproduc->id == $itemAl->idproducto)
                            Descripcion:  {{ $itemproduc->descripcion}}
                            @break
                            @endif
                            @endforeach
                        </p>
                    </td>
                </tr>
                @endforeach
            @endif
        </tbody>
    </table><br>
</body>
</html>
