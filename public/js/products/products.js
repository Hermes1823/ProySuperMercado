


const formNewProduct =  document.querySelector('#miForm');
const tableProducts = document.querySelector('#productTable');
const myModal= document.querySelector('#exampleModal');
const btnNewProduct= document.querySelector('#btnNewProduct');

const _nombre= document.querySelector('#nombre');
const _stock=document.querySelector('#stock');
const _marca = document.querySelector('#marcaSelect');
const _categoria = document.querySelector('#categoriaSelect');
const _img = document.querySelector('#image-input');
const previewImg= document.querySelector('#preview-image');

const categoriaSelect= document.querySelector('#categoriaSelect');
const marcaSelect=document.querySelector('#marcaSelect');

const lblImage= document.querySelector('#lblImage');
let mode;
let idProducto;

btnNewProduct.addEventListener('click', (e)=>{
    customizeModal('Nuevo Producto');
    mode="create";
})

formNewProduct.addEventListener('submit', (e) => {
    e.preventDefault();
    
    const nombre = _nombre.value;
    const stock = _stock.value;
    const marca = _marca.value;
    const categoria = _categoria.value;
    const img = _img.files[0];
    const labelImg= lblImage.textContent;

  
    var formData = new FormData();
    formData.append("nombre", nombre);
    formData.append("stock", stock);
    formData.append("marca", marca);
    formData.append("categoria", categoria);
    formData.append("img", img);
    formData.append("lblImg",labelImg);
    


     formNewProduct.reset();
     const btnCerrarModal = document.querySelector('#closeModal');
     btnCerrarModal.click();

    if(mode=="create"){
      fetchNewProduct(formData);
    }
    if(mode=="update"){
      formData.append("idProducto",idProducto);
      fetchUpdateProduct(formData);
    }
    
      
  });

  function fetchUpdateProduct(data){
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
  
    fetch('productos/update', {
      method: 'POST',
      headers: {
        // 'Content-Type': 'application/json',
        'X-CSRF-TOKEN': csrfToken
      },
      body: data
    })
    .then(r => r.json())
    .then(respuesta =>{
        console.log(respuesta);
        Swal.fire(
          'Producto Actualizado',
          'Click para aceptar',
          'success'
         )
         // Renderiza el componente de Livewire
         window.livewire.emit('render');

    })
}



function fetchNewProduct(data){
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
  
    fetch('productos', {
      method: 'POST',
      headers: {
        // 'Content-Type': 'application/json',
        'X-CSRF-TOKEN': csrfToken
      },
      body: data
    })
    .then(r => r.json())
    .then(respuesta =>{
         Swal.fire(
             'Producto Registrado',
             'Click para aceptar',
             'success'
         )
        //console.log(respuesta);
        window.livewire.emit('actualizarTabla');
    })
}

tableProducts.addEventListener('click',async (e)=>{
   
   
    if(e.target.classList.contains("tdProduct")){
        idProducto=e.target.parentElement.id;
    }else if(e.target.classList.contains("imgProduct")){
        idProducto=e.target.parentElement.parentElement.id;
    }
    

    if(e.target.classList.contains("tdProduct") || e.target.classList.contains("imgProduct")){
       
        const object= {
            idProducto,
        }
        
      const productoEdit= await fetchEditProduct(object);

      _nombre.value= productoEdit.mensaje.nombre;
      _stock.value=productoEdit.mensaje.stock;
      marcaSelect.value=productoEdit.mensaje.idMarca;
      categoriaSelect.value=productoEdit.mensaje.idCategoria;
     
      previewImg.src=`imagenes/products/${productoEdit.mensaje.photo}`;
      
      if(productoEdit.mensaje.photo==="producto_default.png"){
        lblImage.textContent="Seleccione una imagen";
      }else{
        lblImage.textContent=productoEdit.mensaje.photo;
      }
       
      // Abrir el modal
      openModal();
      //btnNewProduct.click();

      //editando modal
      customizeModal('Actualizar Producto');
      mode="update";
    }
})



async function fetchEditProduct(data) {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
  
    const response = await fetch('productos/edit', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': csrfToken
      },
      body: JSON.stringify(data)
    });
  
    const respuesta = await response.json();
    
    return respuesta;
}

const openModal= ()=>{
    const modal = new bootstrap.Modal(myModal);
    modal.show();
}

const customizeModal= (title)=>{
   const titleModal= document.querySelector('#exampleModalLabel');
    titleModal.textContent=title;
}




document.getElementById('image-input').addEventListener('change', function(e) {
    var reader = new FileReader();
    reader.onload = function() {
        var previewImage = document.getElementById('preview-image');
        previewImage.src = reader.result;
    };
    reader.readAsDataURL(e.target.files[0]);
});

document.getElementById('remove-image-btn').addEventListener('click', function() {
var imageInput = document.getElementById('image-input');
var imagePreview = document.getElementById('preview-image');

// Limpiar la imagen de vista previa
imagePreview.src = '/imagenes/products/producto_default.png';

// Restablecer el valor del input de tipo file
imageInput.value = '';
lblImage.textContent="Seleccione una imagen";

});







