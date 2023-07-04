<div>
   
    <div class="col-lg-12 mb-lg-0 mb-4">

          

        <div class="card z-index- h-100">
            <div class="card-header pb-0 pt-3 bg-transparent">
                    <h4 class="">Seleccionar productos</h4>
            
                    {{-- <p class="text-sm mb-0">
                    <i class="fa fa-arrow-up text-success"></i>
                    <span class="font-weight-bold">4% more</span> in 2021
                    </p> --}}
            </div>
         
            <div class="card-body p-3">


            {{-- inicio tabla productos --}}
            <div class="card-header d-flex justify-content-center align-items-center" style="box-sizing:inherit">
                <input wire:model="search" class="form-control" style="padding: 2px 2px 2px 5px; height: 40px;" placeholder="Buscar por categoría, marca o nombre">
            </div>
            @if ($products->count())  
            <table class="table table-hover" id="productTable">
                <thead>
                    <tr>
                        <th style="text-align: center">Nombre</th>
                       
                        <th style="text-align: center">Stock</th>
                       
                        <th style="text-align: center">Marca</th>
                        <th style="text-align: center">Categoría</th>
                        <th style="text-align: center">Foto</th>
                        <th style="text-align: center"> </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr id="{{ $product->id }}" class="productRow">
                            <td class="tdProduct" style="text-align: center">{{ $product->nombre }}</td>
                           
                            <td class="tdProduct" style="text-align: center">{{ $product->stock }}</td>
                            
                            <td class="tdProduct" style="text-align: center">{{ $product->marca }}</td>
                            <td class="tdProduct" style="text-align: center">{{ $product->categoria }}</td>
                            <td class="tdProduct" style="text-align: center">
                                <img class="imgProduct" src="{{asset('imagenes/products/'.$product->photo)}}" alt="Foto del producto" class="mr-2" width="100">
                            </td>
                            <td class="tdProduct"  style="text-align: center; position:relative">
                                <div class="d-flex flex-column justify-content-center" style="position:absolute; top:0; right:0; left:0; bottom:0">
                                    <i class="fas fa-plus-circle agregarProducto"  style="color: #fff70f;margin-bottom: 4px;"></i>
                                    <i class="fas fa-minus-circle quitarProducto"  style="color: #ff8080;margin-top:4px;"></i>
                                </div>                     
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="card-footer">
                {{ $products->links() }}
            </div>
            @else
                <div class="card-body">
                    <strong>No se encontraron productos</strong>
                </div> 
            @endif
        {{-- fin tabla productos --}}






            </div>
         </div>
    </div>


    
</div>
