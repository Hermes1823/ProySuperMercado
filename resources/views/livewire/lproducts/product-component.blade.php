<div>

    <div class="col-lg-12 mb-lg-0 mb-4">

          

        <div class="card z-index- h-100">
          <div class="card-header pb-0 pt-3 bg-transparent">
            <h4 class="">Lista de productos</h4>
            
            {{-- <p class="text-sm mb-0">
              <i class="fa fa-arrow-up text-success"></i>
              <span class="font-weight-bold">4% more</span> in 2021
            </p> --}}
          </div>
         
          <div class="card-body p-3">

            {{-- contenido --}}
            <div class="card-header d-flex justify-content-center align-items-center" style="box-sizing:inherit">
                <input wire:model="search" class="form-control" style="padding:3px; height:40px;" placeholder="Buscar por categoría,marca o nombre">
                <!-- Botón para abrir la ventana modal -->
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary ml-4" style="margin-bottom: 0" id="btnNewProduct" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Registrar Producto
                </button>
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
                                <img class="imgProduct" src="{{ asset('imagenes/products/' . $product->photo) }}"
                                alt="Foto del producto" class="mr-2" width="100">
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
        {{-- fin contenido --}}
        
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
              <div class="modal-content">
                
                <form id="miForm" action="#" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nuevo Producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col">
                                    <input type="text" placeholder="Nombre del producto" class="form-control" id="nombre" aria-describedby="nombreHelp">
                                </div>
                                <div class="col">
                                    <input type="number" placeholder="Stock" class="form-control" id="stock" aria-describedby="stockHelp">
                                </div>
                            </div>
                            <div class="row mt-4" >
                                <div class="col">
                                    <select class="custom-select" id="marcaSelect" aria-label="Default select example">
                                        <option selected value="0">Selecciona una marca</option>
                                        @foreach ($marcas as $marca)
                                            <option  value="{{ $marca->id }}">
                                                {{ $marca->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
        
                                <div class="col">
                                    <select class="custom-select" id="categoriaSelect" aria-label="Default select example">
                                        <option selected value="0">Selecciona una categoría</option>
                                        @foreach ($categorias as $categoria)
                                            <option  value="{{ $categoria->id }}">
                                                {{ $categoria->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
        
                            <div class="row mt-4">
                                <div class="col">
                                    <div class="image-preview">
                                        <img class="img-fluid" id="preview-image" src="/imagenes/products/producto_default.png" style="height:300px; object-fit: cover;" alt="Vista previa de la imagen">
                                    </div>
        
                                    <div class="row d-flex">
                                        <div class="col d-flex flex-column justify-content-center">
                                            <label for="formFile" id="lblImage" class="form-label">Seleccione una imagen</label>
                                            <input class="form-control" type="file" id="image-input" accept="image/*">
                                        </div>
                                        <div class="col d-flex align-items-end" >
                                            <button style="margin-bottom: 0" id="remove-image-btn" type="button" class="btn btn-danger">Quitar imagen</button>
                                        </div>    
                                    </div>
                                </div>
                            </div>
                        </div>
        
        
                    </div>
                    <div class="modal-footer">
                    <button type="button" id="closeModal" class="btn btn-secondary" data-bs-dismiss="modal">Salir</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
        
              </div>
            </div>
        </div>
        {{-- fin modal --}}

          </div>
        </div>
    </div>






   


</div>

