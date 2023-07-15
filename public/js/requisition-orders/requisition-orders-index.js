const contenidoModal= document.querySelector('#contenidoModal');



document.addEventListener('DOMContentLoaded',()=>{
  
events();

})

function events(){

    document.addEventListener('click',(e)=>{
        const idTarget= e.target.id;
       

        if(idTarget==="btnModalVer" || idTarget==="iconModalVer"){
            const row=e.target.parentElement.parentElement.parentElement;
            const object={id:row.id};
            
            showRequisitionOrders(object);
            
        }

        if(idTarget==="btnSolicitudCotizacion"){
          pintarSelectProveedores();
          openModal('Generar solicitud de cotización');
        }

    })
}

const getProveedores = () =>{
  
}

const showRequisitionOrders = (data) => {
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
        openModal('Detalle de la orden de requisición');
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
}
const pintarSelectProveedores=()=>{
  contenidoModal.innerHTML=`
  <select class="custom-select" size="3">
  <option selected>Seleccione un proveedor</option>
  <option value="1">One</option>
  <option value="2">Two</option>
  <option value="3">Three</option>
</select>
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

const openModal = (titulo)=>{
    const exampleModalLabel= document.querySelector('#exampleModalLabel');
    const myModal = new bootstrap.Modal(document.getElementById('exampleModal'), {
        keyboard: false
      })
    exampleModalLabel.textContent=titulo; 
    
      myModal.show();
}