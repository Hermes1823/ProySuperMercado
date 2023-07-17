<div>
    <div class="col-lg-12 mb-lg-0 mb-4">

        

        <div class="card z-index- h-100">
          <div class="card-header pb-0 pt-3 bg-transparent">
            <h4 class="">Lista de solicitudes de cotización</h4>
            
            {{-- <p class="text-sm mb-0">
              <i class="fa fa-arrow-up text-success"></i>
              <span class="font-weight-bold">4% more</span> in 2021
            </p> --}}
          </div>
         
          <div class="card-body p-3">

            {{-- contenido --}}
            <div class="card-header d-flex justify-content-center align-items-center" style="box-sizing:inherit">
                <input wire:model="search" class="form-control" style="padding:3px; height:40px;" placeholder="Filtrar por orden de requisición o proveedor">
                <!-- Botón para abrir la ventana modal -->
                <!-- Button trigger modal -->
               
            </div>
            @if ($solicitudesCotizacion->count())  
            <table class="table table-hover" id="productTable">
                <thead>
                    <tr>
                        <th style="text-align: center">Nº </th>
                       
                        <th style="text-align: center">Nº Orden de Requisición</th>
                        <th style="text-align: center">Fecha de la solicitud</th>
                        
                        <th style="text-align: center">Proveedor</th>
                        <th style="text-align: center">Acciones</th>
                       
                    </tr>
                </thead>
                <tbody>
                    @foreach ($solicitudesCotizacion as $solicitudCotizacion)
                        <tr id="{{ $solicitudCotizacion->id }}" class="productRow">
                            
                                
                                <td class="tdProduct" style="text-align: center">{{ $solicitudCotizacion->id }}</td>
                            
                                <td class="tdProduct" style="text-align: center">{{ $solicitudCotizacion->requisicion }}</td>
                                <td class="tdProduct" style="text-align: center">{{ $solicitudCotizacion->fechaSolicitud }}</td>

                                <td class="tdProduct" style="text-align: center">{{ $solicitudCotizacion->proveedor }}</td>
                                <td class="tdProduct d-flex justify-content-between align-items-center">
                                    <button wire:click="verSolicitud({{ $solicitudCotizacion->id }})" class="btn btn-dark">
                                        <i class="fas fa-file-alt" id="iconSolicitudCotizacion"></i> Ver
                                    </button>    

                                    <select class="custom-select ml-3" wire:change="actualizarEstado($event.target.value, {{ $solicitudCotizacion->id }})">
                                        <option value="Pendiente"{{ $solicitudCotizacion->estado == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                                        <option value="Aprobado" {{ $solicitudCotizacion->estado == 'Aprobado' ? 'selected' : '' }}>Aprobado</option>
                                        <option value="Rechazado" {{ $solicitudCotizacion->estado == 'Rechazado' ? 'selected' : '' }}>Rechazado</option>
                                        <!-- Agrega más opciones según sea necesario -->
                                    </select>
                                    
                                         
                                </td>
                                
                            
                           
                           
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="card-footer">
                {{ $solicitudesCotizacion->links() }}
            </div>
            @else
                <div class="card-body">
                    <strong>No se encontraron productos</strong>
                </div> 
            @endif
        {{-- fin contenido --}}
        
        <!-- Modal -->
      
        {{-- fin modal --}}

          </div>
        </div>
    </div>


</div>
