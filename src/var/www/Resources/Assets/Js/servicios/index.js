// _ESTE CODIGO SE ENCARGA DE MOVER EL DIV DE BUSCADOR PARA AFUERA DE LA TABLA EN VERSIONES MOBILES
let dataServicio = null;
redirectUrl=""
document.addEventListener("DOMContentLoaded", function () {
  const searchInputDiv = document.getElementById("div-to-move");
  const targetDiv = document.querySelector(".d-slider1 li");
  const originalParent = document.getElementById("original-parent");

  function handleResize() {
    if (window.innerWidth <= 992) {
      // Para tableta y móvil
      if (
        searchInputDiv &&
        targetDiv &&
        searchInputDiv.parentNode !== targetDiv
      ) {
        searchInputDiv.classList.remove("search-input"); // Eliminar clase
        targetDiv.appendChild(searchInputDiv); // Mover el div
      }
    } else {
      // Revertir los cambios cuando la pantalla sea mayor a 992px
      if (
        originalParent &&
        searchInputDiv &&
        searchInputDiv.parentNode !== originalParent
      ) {
        searchInputDiv.classList.add("search-input"); // Añadir clase de nuevo
        originalParent.appendChild(searchInputDiv); // Mover el div de regreso
      }
    }
  }

  // Ejecutar la función en el evento de cambio de tamaño de la ventana
  window.addEventListener("resize", handleResize);
  // Ejecutar la función una vez cuando la página se carga
  handleResize();
});

// _FINAL DE CODIGO SE ENCARGA DE MOVER EL DIV DE BUSCADOR PARA AFUERA DE LA TABLA EN VERSIONES MOBILES

/** _ACCEDIENTO AL BTN BUSCAR */
// btn = document.getElementById("btn_search");
btn = document.querySelector("#btn_search");
inptSearch = document.querySelector("#inputBuscar");
/** _TBODY DE LA TABLA EN LA CUAL SE VAN A CARGAR LA FILAS */
const tbody = document.querySelector("#contendioTb");
/** PAGINACION DE LA PAGINA */
const pagination = document.getElementById("paginacion");
/** CUANDO EL INPUT QUEDA VACIO CARGA LOS DATOS NUEVAMENTE */
inptSearch.addEventListener("keyup", (e) => {
  btn.id = "btn_search";

  if (e.target.value.length === 0 && btn.textContent === "Cancelar") {
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
    getSolicitud();
  } else {
    inptSearch.value = "";
    e.target.textContent = "Buscar";
    e.target.id = "btn_search";
    getSolicitud();
  }
});

/** FUNCION QUE SE ENCARGA DE LAS PETICIONES CON EL BACKEND */
function getSolicitud(params = 1, params2 = 0) {
  const Url = inptSearch.dataset.url;
  const value = inptSearch.value;
  const paginacion = params;
  const grupPaginacion = params2;

  const formData = new FormData();
  formData.append("busqueda", "");
  if (btn.textContent == "Cancelar") {
    formData.append("busqueda", value);
  }
  formData.append("paginacion", paginacion);
  formData.append("grupPaginacion", grupPaginacion);

  // MENSAJE DE CARGANDO LOS DATOS
  tbody.innerHTML = `<tr>
        <td colspan="4" class="text-center">
            <div class="spinner-border text-secondary" role="status">
                <span class="visually-hidden">Cargando...</span>
            </div>
            <p>Cargando...</p> <!-- Texto debajo del spinner -->
        </td>
    </tr>`;
  pagination.innerHTML = "";
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
      //  data.servicios.forEach(fila => {
      //    // Crea una nueva fila y celdas para los datos
      //    let tr = document.createElement('tr');
      //    tr.innerHTML = `<td class="text-bold-500">
      //        <div class="d-flex align-items-center">
      //          <h6 class="py-1 text-mobile-white">${fila.nombre}</h6>
      //        </div>
      //      </td>
      //      <td class="text-bold-500">
      //        <div class="d-flex align-items-center">
      //          <h6>${fila.precio}</h6>
      //        </div>
      //      </td>
      //      <td class="text-bold-500">
      //        <div class="d-flex align-items-center">
      //          <h6 class="text-info">${fila.titulo}</h6>
      //        </div>
      //      </td>
      //      <td class="text-bold-500 col-4">
      //        <div class="d-flex justify-content-center align-items-center">
      //          <button type="button" class="btn btn-primary" onclick="modal(${fila.id})" >
      //            Modificar
      //          </button>
      //        </div>
      //      </td>`;
      //    // Añade la fila al cuerpo de la tabla
      //    tbody.appendChild(tr);
      //  });

      data.servicios.forEach((fila) => {
        // Define el estado basado en el título
        let estado = fila.titulo === "ACTIVO" ? "bg-success" : "bg-danger";
        let badgeHtml = `<span class="badge rounded-pill ${estado}">${fila.titulo}</span>`;

        // Crea una nueva fila y celdas para los datos
        let tr = document.createElement("tr");
        tr.innerHTML = `
                <td class="text-bold-500">
                    <div class="d-flex align-items-center">
                        <h6 class="py-1 text-mobile-white">${fila.nombre}</h6>
                    </div>
                </td>
                <td class="text-bold-500">
                    <div class="d-flex align-items-center">
                        <h6>${fila.precio}</h6>
                    </div>
                </td>
                <td class="text-bold-500">
                    <div class="d-flex align-items-center">
                    <p class="h4">
                    ${badgeHtml}  
                    </p>
                    </div>
                </td>
                <td class="text-bold-500 col-4">
                    <div class="d-flex justify-content-center align-items-center">
                        <button type="button" class="btn btn-primary" onclick="modal(${fila.id})">
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
  const url = document.getElementById("contendioTb").getAttribute("data-Url");
  const modalElement = document.getElementById("staticBackdrop");
  const form = document.getElementById("updateEstadoSoli");
  // form.setAttribute('data-id', id);
  const myModal = new bootstrap.Modal(modalElement, {
    backdrop: "static",
    keyboard: false,
  });
  const formData = new FormData();
  formData.append("id", id);

  const formElements = modalElement.querySelectorAll(".form-control");
  const formSelect = modalElement.querySelectorAll(".form-select");
  const labelElements = modalElement.querySelectorAll(".form-label");
  const buttonElement = modalElement.querySelector(".btn-primary");

  // Aplicar efecto esqueleto y deshabilitar formulario, labels y botón
  formElements.forEach((element) => {
    element.classList.add("skeleton");
    element.disabled = true;
  });
  formSelect.forEach((element) => {
    element.classList.add("skeleton");
    element.disabled = true;
  });

  labelElements.forEach((label) => {
    label.classList.add("skeleton");
    label.classList.add("label-loading");
  });

  buttonElement.classList.add("skeleton-btn");
  buttonElement.disabled = true;
  myModal.show();
  fetch(url, {
    method: "POST",
    body: formData,
  })
    .then((response) => response.json())
    .then((data) => {
      const fetchedData = data.servicio;
      dataServicio = fetchedData
      // console.log(data.servicio);
      // Aquí rellenas los campos del formulario con los datos
      formElements.forEach((element) => {
        const fieldName = element.name;
        if (fetchedData && fetchedData.hasOwnProperty(fieldName)) {
          element.value = fetchedData[fieldName];
        }
        element.classList.remove("skeleton");
        element.disabled = false;
      });
      formSelect.forEach((element) => {
        if (element.name === 'estado') {
          // Asumiendo que 'fetchedData.estado' es el estado directo de la DB como "ACTIVO" o "DESACTIVO"
          const estadoDB = fetchedData.estado; // Obtiene el estado directamente desde los datos obtenidos
          // Selecciona el valor basado en el estado de la base de datos
          element.value = estadoDB === 'ACTIVO' ? '1' : '2';
          // Cambia el color de la opción seleccionada
          if (element.value === '1') {
            element.options[element.selectedIndex].style.background = "green"; // Opción para ACTIVO
            element.options[element.selectedIndex].style.color = "white";
          } else if (element.value === '2') {
            element.options[element.selectedIndex].style.background = "red"; // Opción para DESACTIVO
            element.options[element.selectedIndex].style.color = "white";
          }
        }
        
      });
      buttonElement.classList.remove("skeleton-btn");
      buttonElement.setAttribute('data-id', fetchedData.id);
      buttonElement.disabled = false;
    })
    .catch((error) => {
      console.error(error);
      // En caso de error, también se debe habilitar el botón y quitar el efecto esqueleto
      buttonElement.classList.remove("skeleton-btn");
      buttonElement.disabled = false;
    })
    .finally(() => {
      // Quitar efecto esqueleto de todos los elementos
      const allSkeletonElements = modalElement.querySelectorAll(".skeleton");
      allSkeletonElements.forEach((element) => {
        element.classList.remove("skeleton");
        element.disabled = false;
      });
      // Dentro del .then después de que los datos se hayan cargado y procesado
      labelElements.forEach((label) => {
        label.classList.remove("label-loading");
      });
    });
}


document.getElementById('formUpdateServicio').addEventListener('submit', async function(event) {
  event.preventDefault(); // Evita el envío del formulario por defecto
  const form = event.target;
  const url = form.getAttribute('data-update');
  const IdServicio = event.submitter.getAttribute('data-id');
  const formData = new FormData(form);
        formData.append("id", IdServicio)
  const api = new FetchAPI(url)
  // Convert formData to an object for comparison
  const formObject = {};
  formData.forEach((value, key) => {
    formObject[key] = value.trim(); // Normalize form values
  });
  // Ensure the ID is included in formObject
  formObject['id'] = String(IdServicio).trim();
  // Map estado values to the expected strings
  if (formObject.hasOwnProperty('estado')) {
    formObject['estado'] = formObject['estado'] === '1' ? 'ACTIVO' : 'DESACTIVO';
  }
  // Log dataServicio and formObject
  console.log("copia:", JSON.stringify(dataServicio, null, 2)); // Pretty print dataServicio
  console.log("formulario:", JSON.stringify(formObject, null, 2)); // Pretty print formObject

  // Compare formObject with dataServicio
  let hasChanges = false;
  for (const key in dataServicio) {
    if (dataServicio.hasOwnProperty(key)) {
      const originalValue = String(dataServicio[key]).trim();
      const newValue = String(formObject[key] !== undefined ? formObject[key] : '').trim();
      if (originalValue !== newValue) {
        console.log(`Change detected in ${key}: ${originalValue} !== ${newValue}`);
        hasChanges = true;
        break;
      }
    }
  }

    console.log("Changes detected:", hasChanges);
    
  try {
    if (hasChanges) {
    const data = await api.sendForm(formData);
    // console.log(data);
    if (data.status == "success") {
      Toast.fire({
        icon: data.status,
        title: data.msg
      }); 
      getSolicitud();
      setTimeout(() => {
        document.getElementById('cerrarbtn').click();
      }, 1000);
    } else {
        Toast.fire({
          icon: data.status,
          title: data.msg
        });
    }
    }else{
      Toast.fire({
        icon: "error",
        title: "No hay modifcaciones en los campos"
      });
    }
    // Restablecer el botón a su estado original después de recibir la respuesta
  } catch (error) {
    console.error("Error al enviar el formulario:", error);
  }





});

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
