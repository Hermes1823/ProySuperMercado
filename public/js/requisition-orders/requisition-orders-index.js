let showTable = document.querySelector('#showTable');
const dataTable = new DataTable(showTable, {
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
          return '<img src="images/' + data + '" alt="Imagen" width="50" height="50">';
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


document.addEventListener('DOMContentLoaded',()=>{
   
events();

})

function events(){

    document.addEventListener('click',(e)=>{
        const idTarget= e.target.id;
       

        if(idTarget==="btnModalVer"){
            const row=e.target.parentElement.parentElement.parentElement;
            const object={id:row.id};
            showRequisitionOrders(object);
            
        }
    })
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
       
       console.log(respuesta.detail);
       loadTableShow(respuesta.detail);
       openModal();
    })
}

const loadTableShow= (datos)=>{

    
    
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

const openModal = ()=>{
    const myModal = new bootstrap.Modal(document.getElementById('exampleModal'), {
        keyboard: false
      })
    
      myModal.show();
}