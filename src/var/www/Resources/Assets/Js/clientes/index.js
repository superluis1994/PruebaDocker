 // _ESTE CODIGO SE ENCARGA DE MOVER EL DIV DE BUSCADOR PARA AFUERA DE LA TABLA EN VERSIONES MOBILES
 document.addEventListener("DOMContentLoaded", function () {
  const searchInputDiv = document.getElementById('div-to-move');
  const targetDiv = document.querySelector('.d-slider1 li');
  const originalParent = document.getElementById('original-parent');

  function handleResize() {
      if (window.innerWidth <= 992) { // Para tableta y móvil
          if (searchInputDiv && targetDiv && searchInputDiv.parentNode !== targetDiv) {
              searchInputDiv.classList.remove('search-input'); // Eliminar clase
              targetDiv.appendChild(searchInputDiv); // Mover el div
          }
      } else {
          // Revertir los cambios cuando la pantalla sea mayor a 992px
          if (originalParent && searchInputDiv && searchInputDiv.parentNode !== originalParent) {
              searchInputDiv.classList.add('search-input'); // Añadir clase de nuevo
              originalParent.appendChild(searchInputDiv); // Mover el div de regreso
          }
      }
  }

  // Ejecutar la función en el evento de cambio de tamaño de la ventana
  window.addEventListener('resize', handleResize);
  // Ejecutar la función una vez cuando la página se carga
  handleResize();
});

// _FINAL DE CODIGO SE ENCARGA DE MOVER EL DIV DE BUSCADOR PARA AFUERA DE LA TABLA EN VERSIONES MOBILES


/** _ACCEDIENTO AL BTN BUSCAR */
// btn = document.getElementById("btn_search");
btn = document.querySelector("#btn_search");;
inptSearch = document.querySelector("#inputBuscar");
/** _TBODY DE LA TABLA EN LA CUAL SE VAN A CARGAR LA FILAS */
const tbody=document.querySelector("#contendioTb");
/** PAGINACION DE LA PAGINA */
const pagination = document.getElementById("paginacion");
/** CUANDO EL INPUT QUEDA VACIO CARGA LOS DATOS NUEVAMENTE */
inptSearch.addEventListener("keyup", (e) => {
  btn.id = "btn_search";
  
  if(e.target.value.length === 0 && btn.textContent ==="Cancelar"){
    btn.textContent = "Buscar";
    getSolicitud();
    // alert("Cancelar");
  }
});
/** VALIDA SI EL BTN ESTA BUSCANDO O NO ASI CARGA LOS DATOS */
document.getElementById("btn_search").addEventListener("click", (e) => {
  if (e.target.textContent === "Buscar" && inptSearch.value.length > 0) {
    e.target.textContent = "Cancelar";
    btn.id = "btn_cancelar";
  getSolicitud()
  
} else {
  inptSearch.value = "";
  e.target.textContent = "Buscar";
  e.target.id = "btn_search";
  getSolicitud()
  }
});

/** FUNCION QUE SE ENCARGA DE LAS PETICIONES CON EL BACKEND */
function getSolicitud(params=1, params2=0) {
  const Url = inptSearch.dataset.url
    const value = inptSearch.value
    const paginacion = params
    const grupPaginacion = params2

    const formData = new FormData();
          formData.append("busqueda","")
    if( btn.textContent == "Cancelar"){
     
        formData.append("busqueda",value)
    }
    formData.append("paginacion",paginacion)
    formData.append("grupPaginacion",grupPaginacion)

// MENSAJE DE CARGANDO LOS DATOS
    tbody.innerHTML = `<tr>
        <td colspan="4" class="text-center">
            <div class="spinner-border text-secondary" role="status">
                <span class="visually-hidden">Cargando...</span>
            </div>
            <p>Cargando...</p> <!-- Texto debajo del spinner -->
        </td>
    </tr>`;
    pagination.innerHTML="";
    fetch(Url, {
            method: "POST",
            body: formData,
        })
        .then((response) => response.json())
        .then((data) => {
            console.log(data);
             tbody.innerHTML = "";
             pagination.innerHTML = "";
           // Itera sobre cada objeto en tu array de datos
           data.clientes.forEach(fila => {
             // Crea una nueva fila y celdas para los datos
             let tr = document.createElement('tr');
             tr.innerHTML = `<td class="text-bold-500">
                 <div class="d-flex align-items-center">
                   <h6 class="py-1 text-mobile-white">${fila.nombre} ${fila.apellidos}</h6>
                 </div>
               </td>
               <td class="text-bold-500">
                 <div class="d-flex align-items-center">
                   <h6>${fila.telefono}</h6>
                 </div>
               </td>
               <td class="text-bold-500">
                 <div class="d-flex align-items-center">
                   <h6 class="text-info">${fila.fecha_registro}</h6>
                 </div>
               </td>
               <td class="text-bold-500 col-4">
                 <div class="d-flex justify-content-center align-items-center">
                   <button type="button" class="btn btn-primary" onclick="modal(${fila.id})" >
                     Modificar
                   </button>
                 </div>
               </td>`;
             // Añade la fila al cuerpo de la tabla
             tbody.appendChild(tr);
           });
           pagination.innerHTML = data.paginacion;
          //  paginacion.appendChild(data.paginacion);

        })
        .catch((error) => {
            console.error(error);
        });

  }
  function modal(id) {
    const url = document.getElementById('contendioTb').getAttribute('data-Url');
    const modalElement = document.getElementById('staticBackdrop');
    const form =document.getElementById('updateEstadoSoli')
    // form.setAttribute('data-id', id);
    const myModal = new bootstrap.Modal(modalElement, {
      backdrop: 'static',
      keyboard: false
    });
    // const formData = new FormData();
    // formData.append("id", id);
    myModal.show();
  
    // const formElements = modalElement.querySelectorAll('.form-control');
    // const labelElements = modalElement.querySelectorAll('.form-label');
    // const buttonElement = modalElement.querySelector('.btn-primary');
    // const imageElement = modalElement.querySelector('.card img');
  
    // // Aplicar efecto esqueleto y deshabilitar formulario, labels y botón
    // formElements.forEach(element => {
    //   element.classList.add('skeleton');
    //   element.disabled = true;
    // });
  
    // labelElements.forEach(label => {
    //   label.classList.add('skeleton');
    //   label.classList.add('label-loading');
    // });
  
    // buttonElement.classList.add('skeleton-btn');
    // buttonElement.disabled = true;
  
    // imageElement.classList.add('skeleton', 'skeleton-img');
    // imageElement.src = '';
  
    // myModal.show();
    
    // fetch(url, {
    //   method: "POST",
    //   body: formData,
    // })
    // .then(response => response.json())
    // .then(data => {
      // const fetchedData = data.data;
      // form.setAttribute('data-id-solicitud', data.data.id_solicitud);
      // imageElement.src = imageElement.getAttribute('data-img_temp')
      // fullImg=document.getElementById("fullImg")
      // fullImg.src = imageElement.getAttribute('data-img_temp')
      // if(fetchedData.imagen !== null){
      //   fullImg.src = fetchedData.imagen;
      // }
      // console.log(data.data);
  
      // // Aquí rellenas los campos del formulario con los datos
      // formElements.forEach(element => {
      //   const fieldName = element.name;
      //   if (fetchedData && fetchedData.hasOwnProperty(fieldName)) {
      //     element.value = fetchedData[fieldName];
      //   }
      //   element.classList.remove('skeleton');
      //   element.disabled = true;
      //   if(element.name === "comentario" || element.name === "status"){
      //     element.disabled = false;
  
      //   }
      // });
      // // Al comienzo de la función modal
  
      // buttonElement.classList.remove('skeleton-btn');
      // buttonElement.disabled = false;
  
      // document.getElementById("fecha_envio").innerHTML =`<span class='fw-bold'>ASIGNADA: </span>`+ data.data.fecha_envio
  
      // if (fetchedData && fetchedData.imagen) {
      //   imageElement.src = fetchedData.imagen;
      // }
      // imageElement.classList.remove('skeleton', 'skeleton-img');
  //   })
  //   .catch(error => {
  //     console.error(error);
  //     // En caso de error, también se debe habilitar el botón y quitar el efecto esqueleto
  //     buttonElement.classList.remove('skeleton-btn');
  //     buttonElement.disabled = false;
  //   })
  //   .finally(() => {
  //     // Quitar efecto esqueleto de todos los elementos
  //     const allSkeletonElements = modalElement.querySelectorAll('.skeleton');
  //     allSkeletonElements.forEach(element => {
  //       element.classList.remove('skeleton');
  //       element.disabled = false;
  //     });
  //     // Dentro del .then después de que los datos se hayan cargado y procesado
  // labelElements.forEach(label => {
  //   label.classList.remove('label-loading');
  // });
  
  //   });
  }
//   document.getElementById("cerrarModal").addEventListener("click", function () {
//     const modalElement = document.getElementById('staticBackdrop');
//     const formElements = modalElement.querySelectorAll('.form-control');

//     formElements.forEach(element => {
//         if(element.type == 'checkbox' || element.type == 'radio') {
//             element.checked = false; // Desmarca checkboxes y radios
//         } else {
//             element.value = ''; // Limpia campos de texto, textarea, etc.
//         }
//     });

//     // También limpia la imagen si hay una
//     const imageElement = modalElement.querySelector('.card img');
//     if (imageElement) {
//         imageElement.src = ''; // Quita la imagen actual
//     }
// });