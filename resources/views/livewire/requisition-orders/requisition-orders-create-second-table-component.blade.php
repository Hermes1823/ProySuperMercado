<div>
    <div  class="col-lg-12 mb-lg-0 mb-4 mt-5" id="divListaRequisicion" >
         
        <div class="card z-index- h-100" >
            <div class="card-header pb-0 pt-3 bg-transparent" >
                    <h4 class="">Contenido de la orden de requisicón</h4>
            
                    {{-- <p class="text-sm mb-0">
                    <i class="fa fa-arrow-up text-success"></i>
                    <span class="font-weight-bold">4% more</span> in 2021
                    </p> --}}
            </div>
         
            <div class="card-body p-3" >


            {{-- inicio tabla requisicion --}}
            <div class="card-header d-flex justify-content-center align-items-center" style="box-sizing:inherit">
                <input id="searchDetailRequisition"  class="form-control" style="padding:2px 2px 2px 5px; height:40px;" placeholder="Buscar por categoría,marca o nombre">
                <!-- Botón para abrir la ventana modal -->
                <!-- Button trigger modal -->
                <button type="submit" class="btn btn-primary ms-4" style="margin-bottom: 0" id="btnNewOrdenRequisicion">
                    Registrar Orden de Requisición
                </button> 
            </div>
            
            <table class="table table-hover" id="productTable" >
                <thead>
                    <tr>
                        <th style="text-align: center">Código</th>
                        <th style="text-align: center">Nombre</th>
                       
                        <th style="text-align: center">Stock</th>
                       
                        <th style="text-align: center">Marca</th>
                        <th style="text-align: center">Categoría</th>
                        <th style="text-align: center">Cantidad requerida</th>
                        <th style="text-align: center">Imagen</th>
                        
                    </tr>
                </thead>
                <tbody  id="bodyTableRequisitions"  >
                    
                    
                    
                </tbody>
            </table>
            <div class="card-footer" id="footerRequisition" >
                
            </div>
            
            
        {{-- fin tabla requisicio --}}






            </div>
        </div>




        
    </div>
</div>
