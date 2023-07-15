const contenidoModal= document.querySelector('#contenidoModal');



document.addEventListener('DOMContentLoaded',()=>{
  
events();

})

function events(){
    var idRow="";
    document.addEventListener('click',(e)=>{
        const idTarget= e.target.id;
        

        if(idTarget==="btnModalVer"){
            idRow=e.target.parentElement.parentElement.parentElement.id;
           
            const object={id:idRow};
            
            showRequisitionOrders(object,idRow);  
        }else if(idTarget==="iconModalVer"){
            idRow=e.target.parentElement.parentElement.parentElement.parentElement.id;
           
            const object={id:idRow};
            
            showRequisitionOrders(object,idRow);  
        }

        if(idTarget==="btnSolicitudCotizacion" || idTarget==="iconSolicitudCotizacion"){
          if(idTarget==="btnSolicitudCotizacion"){
            idRow=e.target.parentElement.parentElement.parentElement.id;
          }else if(idTarget==="iconSolicitudCotizacion"){
            idRow=e.target.parentElement.parentElement.parentElement.parentElement.id;
          }
          pintarSelectProveedores();
          openModal('Generar solicitud de cotización',idRow);
        }

        if(idTarget==="btnRegSolicitudCotizacion"){
          e.preventDefault();
          const proveedorSeleccionado= document.querySelector('#selectProveedores').value;
          if(proveedorSeleccionado!=="Seleccionar proveedor"){
            const solicitudCotizacion={
              idProveedor:proveedorSeleccionado,
              idOrdenRequisicion:idRow,
            }
            registerSolicitudCotizacion(solicitudCotizacion);
          }else{
            alerta3('error','Error','Debe seleccionar un proveedor')
          }
          
        }

    })
}

const alerta3=(tipo,titulo,descripcion)=>{
  Swal.fire({
    icon: tipo,
    title: titulo,
    text: descripcion
  })
}

const registerSolicitudCotizacion = (data) => {
  const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

  fetch('requisitionOrders/solicitudCotizacion', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': csrfToken
    },
    body: JSON.stringify(data)
  })
  .then(r => r.json())
  .then(respuesta =>{
     
     console.log(respuesta)
     alertaConfirmacion('Solicitud de cotización generada','success','¿Desea visualizar la solicitud?');
  })
}

const alertaConfirmacion=(titulo,tipo,pregunta)=>{
  Swal.fire({
    icon: tipo,
    title: titulo,
    
     
    showDenyButton: true,
    showCancelButton: false,
    confirmButtonText: pregunta,
    denyButtonText: `Salir`
  }).then((result) => {
    /* Read more about isConfirmed, isDenied below */
    if (result.isConfirmed) {
      window.location = "requisitionOrders/visualizarCotizacionPDF";
    } else if (result.isDenied) {
     
      //regresar a la pagina anterior
      
    }
  })
  
}


const showRequisitionOrders = (data,idRow) => {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
  
    fetch('requisitionOrders/show', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': csrfToken
      },
      body: JSON.stringify(data)
    })
    .then(r => r.json())
    .then(respuesta =>{
       
       //console.log(respuesta.detail);
        pintarTablaShow();
        loadTableShow(respuesta.detail);
        openModal('Detalle de la orden de requisición',idRow);
    })
}



const pintarTablaShow=()=>{
  contenidoModal.innerHTML=`
  <table class="table" id="showTable">
      <thead>
        <tr>
          
        </tr>
      </thead>
      <tbody>
      
      </tbody>
  </table>`;

  const modalFooter = document.querySelector('.modal-footer');
  modalFooter.innerHTML=` 
  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Salir</button>
  <button type="button" class="btn btn-primary">Editar</button>
  <button type="button" class="btn btn-danger">Eliminar</button>`;

}
const pintarSelectProveedores=()=>{
  
    contenidoModal.innerHTML=`
      <select class="custom-select" id="selectProveedores" size="3">
        <option selected>Seleccionar proveedor</option>
      </select>`;
    const selectProveedores= document.querySelector('#selectProveedores');
  proveedores.forEach((p)=>{
    selectProveedores.innerHTML+=`
        <option value="${p.id}">${p.nombre}</option>
    `;
  })
  const modalFooter = document.querySelector('.modal-footer');
  modalFooter.innerHTML=`
  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Salir</button>
  <button type="button" class="btn btn-primary" id="btnRegSolicitudCotizacion">Registrar</button>
  `;
}

const loadTableShow= (datos)=>{

  let showTable = document.querySelector('#showTable');
  
    var dataTable = new DataTable(showTable, {
      columns: [
        { name: 'idProducto', title: 'ID' },
        { name: 'nombre', title: 'NOMBRE' },
        { name: 'marca', title: 'MARCA' },
        { name: 'categoria', title: 'CATEGORIA' },
        { name: 'cantidad', title: 'CANTIDAD' },
        {
          name: 'photo',
          title: 'IMAGEN',
          render: function(data, type, row) {
            return '<img src="imagenes/products/' + data + '" alt="Imagen" width="50" height="50">';
          }
        }
      ],
      language: {
          paginate: {
            first: 'Primero',
            last: 'Último',
            next: 'Siguiente',
            previous: 'Anterior'
          },
          search: 'Buscar:',
          lengthMenu: 'Mostrar _MENU_ registros por página',
          info: 'Mostrando _START_ a _END_ de _TOTAL_ registros',
          infoEmpty: 'Mostrando 0 a 0 de 0 registros',
          infoFiltered: '(filtrado de _MAX_ registros en total)',
          zeroRecords: 'No se encontraron registros coincidentes'
      }
    });
  
  


     // const dataTable = new DataTable(showTable);
      dataTable.clear();

   // Iterar sobre los datos y agregar cada fila al DataTable
     datos.forEach(function(item) {
         dataTable.row.add([
           item.idProducto,
         item.nombre,
         item.marca,
         item.categoria,
         item.cantidad,
         item.photo
         ]);
        });
  
    
    // Dibujar la tabla
    dataTable.draw();
    
}

const openModal = (titulo,subtitulo)=>{
    const exampleModalLabel= document.querySelector('#exampleModalLabel');
    const subLabel= document.querySelector('#modalLabelSub');
    const myModal = new bootstrap.Modal(document.getElementById('exampleModal'), {
        keyboard: false
      })
    exampleModalLabel.textContent=titulo; 
    subLabel.textContent=`Id Requisición: ${subtitulo}`;
    
      myModal.show();
}