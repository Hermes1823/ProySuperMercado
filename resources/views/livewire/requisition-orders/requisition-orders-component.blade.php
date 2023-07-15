<div>

    
    <div class="col-lg-12 mb-lg-0 mb-4">

          

        <div class="card z-index- h-100">
            <div class="card-header pb-0 pt-3 bg-transparent">
                    <h4 class="">Lista de órdenes de requisición</h4>
            
                    {{-- <p class="text-sm mb-0">
                    <i class="fa fa-arrow-up text-success"></i>
                    <span class="font-weight-bold">4% more</span> in 2021
                    </p> --}}
            </div>
         
            <div class="card-body p-3">
                {{-- tabla requisiciones --}}
                <div class="card-header d-flex align-items-center">
                    <input wire:model="search" style="height: 40px"  class="form-control" placeholder="Ingrese el id,colaborador,estado o fecha para buscar">
                    
                    <a href="{{route('requisitionOrders.create')}}" class="btn btn-success ml-4 mb-0">
                        <i class="fas fa-file-alt"></i> Nueva orden de requisición
                    </a>
                </div>
                @if ($requisitionOrders->count())  
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Colaborador</th>
                            <th>Estado</th>
                            <th>Fecha</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($requisitionOrders as $requisitionOrder)
                            <tr id={{$requisitionOrder->id}}>
                                <td>{{$requisitionOrder->id}}</td> </td>
                                <td>{{$requisitionOrder->nombreCompleto}}</td>
                                <td>{{$requisitionOrder->estado}}</td>
                                <td>{{$requisitionOrder->created_at}}</td>
                                <td>
                                    <div class="d-flex" >
                                        <button type="button" id="btnModalVer" class="btn btn-primary" >
                                            <i class="far fa-eye" id="iconModalVer"></i>  Ver
                                        </button>
                                        <button type="button" id="btnSolicitudCotizacion" class="btn btn-dark ml-4">
                                            <i class="fas fa-file-alt"></i> Generar solicitud de cotización
                                        </button>

                                    </div>
                                    
                                </td>
                        
                            </tr>
                        @endforeach
                       
                    </tbody>
                   
                </table>
                <div class="card-footer">
                    {{ $requisitionOrders->links() }}
                </div>
                @else
                    <div class="card-body">
                        <strong>No se encontraron usuarios</strong>
                    </div> 
                @endif

            </div>
        </div>
    </div>



    <!-- Modal -->
<div wire:ignore class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Detalle de la requisición</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          
            <div class="container-fluid">
                <div class="row">
                    <div class="col" id="contenidoModal">

                        

                    </div>
                </div>


            </div>




        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Salir</button>
          <button type="button" class="btn btn-primary">Editar</button>
          <button type="button" class="btn btn-danger">Eliminar</button>
        </div>
      </div>
    </div>
  </div>
  {{-- fin modal --}}


  <script>
    var proveedores = @json($proveedores);
  </script>

</div>
