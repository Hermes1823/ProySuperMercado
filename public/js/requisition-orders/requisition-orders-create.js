let requisitionList=[];
let productObject={};
const bodyTableRequisitions= document.querySelector('#bodyTableRequisitions');
const footerRequisition=document.querySelector('#footerRequisition');
const btnNewOrdenRequisicion=document.querySelector('#btnNewOrdenRequisicion');
const inputSearchDetailRequisition= document.querySelector('#searchDetailRequisition');




document.addEventListener('DOMContentLoaded',()=>{
    footerRequisition.textContent="No hay ítems en la orden de requisición";
    events();
   
})



function events(){
    document.addEventListener('click',(e)=>{

        const element= e.target.classList; 
        

        if(element.contains("agregarProducto") || element.contains("quitarProducto")){
            const productRow=e.target.parentElement.parentElement.parentElement;
            const id= productRow.id;
            const nombre=productRow.children[0].textContent;
            const stock=productRow.children[1].textContent;
            const marca=productRow.children[2].textContent;
            const categoria=productRow.children[3].textContent;
            const foto=productRow.children[4].children[0].src;

            productObject= {
                id,
                nombre,
                stock,
                marca,
                categoria,
                foto,
                cantidadComprar:1
            }


            if(element.contains("agregarProducto")){
                agregarProducto(productObject);
             }else if(element.contains("quitarProducto")){
                 quitarProducto(productObject);
            }
           

            pintarListaRequisicion(requisitionList);
     
        }

    });

    btnNewOrdenRequisicion.addEventListener('click',(e)=>{
        e.preventDefault();
        registerRequisitionOrder(requisitionList);

    });
    
    inputSearchDetailRequisition.addEventListener('input',(e)=>{
        if(e.target.value.trim().length!=0){
            const search= e.target.value.toLowerCase();
            console.log(search)
            const listFilter= requisitionList.filter((p)=>{
               return p.nombre.toLowerCase().includes(search) || p.marca.toLowerCase().includes(search) || p.categoria.toLowerCase().includes(search)
              
            });


            pintarListaRequisicion(listFilter);
        }else{
            pintarListaRequisicion(requisitionList);
        }
    });

}

const quitarProducto= (productObject)=>{
    const existeProducto= requisitionList.some((p)=>{
        return p.id===productObject.id;
    })

    if(existeProducto){
        const x= requisitionList.findIndex((p)=> p.id===productObject.id );
        if(requisitionList[x].cantidadComprar>1){
            requisitionList[x].cantidadComprar--;
        }else if(requisitionList[x].cantidadComprar===1){
            requisitionList=requisitionList.filter((p)=> p.id !== productObject.id);
        }
    }else{
        pintarError('Este producto no está en la lista de requisición','center',2000)
    }



}

const pintarError=(message,position,time)=>{
    const Toast = Swal.mixin({
        toast: true,
        position: position,
        showConfirmButton: false,
        timer: time,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.addEventListener('mouseenter', Swal.stopTimer)
          toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
      })
      
      Toast.fire({
        icon: 'error',
        title: message
      })
}


const agregarProducto= (productObject)=>{
  
    //comprobando si el producto ya existe en la lista de requisicion
    const existeProducto= requisitionList.some((p)=>{
        return p.id===productObject.id;
    })
   
    if(!existeProducto){
        
        requisitionList.push(productObject);
    }else{
       const x= requisitionList.findIndex((p)=> p.id===productObject.id );
       requisitionList[x].cantidadComprar++;
    }

    

}


const pintarListaRequisicion= (list)=>{
   
    eliminarHTML();

    list.forEach((p,index)=>{
         bodyTableRequisitions.innerHTML += `
         <tr  id="${index}" class="productRow">
            <td  class="tdProduct" style="text-align: center">${p.id}</td>
            <td  class="tdProduct" style="text-align: center">${p.nombre}</td>
            <td  class="tdProduct" style="text-align: center">${p.stock}</td>
            <td  class="tdProduct" style="text-align: center">${p.marca}</td>
            <td  class="tdProduct" style="text-align: center">${p.categoria}</td>
            <td  class="tdProduct" style="text-align: center">${p.cantidadComprar}</td>
            <td  class="tdProduct" style="text-align: center">
                <img class="imgProduct" src="${p.foto}" alt="Foto del producto" class="mr-2" width="100">
            </td>
         </tr>`;
     })

     if(requisitionList.length==0){
        footerRequisition.textContent="No hay ítems en la orden de requisición";
     }else{
        footerRequisition.textContent="";
     }
}

const eliminarHTML= ()=>{
    while(bodyTableRequisitions.firstChild){
        bodyTableRequisitions.removeChild(bodyTableRequisitions.firstChild);
    }
}

const registerRequisitionOrder = (data) => {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
  
    fetch('/requisitionOrders/create', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': csrfToken
      },
      body: JSON.stringify(data)
    })
    .then(r => r.json())
    .then(respuesta =>{
         
        alertRegister();
        console.log(respuesta);
    })
}






const alertRegister= ()=>{
        Swal.fire({
  icon: 'success',
  title: 'Orden de requisición registrada',
  
   
  showDenyButton: true,
  showCancelButton: false,
  confirmButtonText: 'Continuar registrando',
  denyButtonText: `Salir`
}).then((result) => {

  /* Read more about isConfirmed, isDenied below */
  if (result.isConfirmed) {

    requisitionList.splice(0,requisitionList.length);
    pintarListaRequisicion(requisitionList);

    Swal.fire({
        position: 'center',
        icon: 'info',
        title: 'Continúe registrando órdenes',
        showConfirmButton: false,
        timer: 1500
    })


  } else if (result.isDenied) {
   
    //regresar a la pagina anterior
    window.location.href = "/requisitionOrders";

  }
})
}