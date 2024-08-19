 // Obtener el valor del atributo data-select
 const marcasSelect = document.getElementById('marcasSelect').dataset.select;
 const clienteSelect = document.getElementById('clienteSelec').dataset.select;

          
const modalSelect2Instance = new Select2Modal('#ModSalidas', '#miSelect',marcasSelect );
const modalSelect2Instance2 = new Select2Modal('#staticBackdrop', '#clienteSelect', clienteSelect);


// $(document).ready(function() {
//   // Vacía el campo de entrada del vehículo cuando se cierra el modal
//   $('#staticBackdrop').on('hidden.bs.modal', function () {
//       $('#vehiculoInpu').empty().append('');
//   });

//   // Maneja la selección y deselección de los servicios, así como la actualización del precio total
//   $('.form-check-input').change(function() {
//       var precio = $(this).siblings('.precio-servicio').data('precio');
//       if (this.checked) {
//           $(this).parent().after(`
//               <div class="d-flex mt-2">
//                   <input type="text" class="form-control me-2 precio-input" name="precios[]" placeholder="Ingrese el precio" value="${precio}" />
//                   <input type="number" class="form-control cantidad-input" name="cantidades[]" placeholder="Ingrese la cantidad" value="1" min="1" />
//               </div>
//           `);
//       } else {
//           $(this).parent().next('div.d-flex').remove();
//       }
//       actualizarTotal();
//   });

//   // Verifica si el campo de precio está vacío cuando pierde el foco
//   $(document).on('blur', '.precio-input', function() {
//       if ($(this).val() === "") {
//           $(this).closest('div.d-flex').prev().find('.form-check-input').prop('checked', false).trigger('change');
//       } else {
//           actualizarTotal();
//       }
//   });

//   // Actualiza el total cuando cambia el valor del precio, solo si no está vacío
//   $(document).on('input', '.precio-input', function() {
//       if ($(this).val() !== "") {
//           actualizarTotal();
//       }
//   });

//   // Actualiza el total cuando cambia la cantidad
//   $(document).on('input', '.cantidad-input', function() {
//       actualizarTotal();
//   });

//   // Función para actualizar el precio total
//   function actualizarTotal() {
//       var total = 0;
//       $('.form-check-input:checked').each(function() {
//           var precio = parseFloat($(this).parent().next('div.d-flex').find('.precio-input').val());
//           var cantidad = parseInt($(this).parent().next('div.d-flex').find('.cantidad-input').val());
//           total += precio * cantidad;
//       });
//       $('#totalPrecio').text('$' + total.toFixed(2));
//   }

//   // Restaura el estado inicial cuando se cierra el modal
//   $('#staticBackdrop').on('hidden.bs.modal', function () {
//       $('.form-check-input').prop('checked', false).trigger('change');
//       $('#totalPrecio').text('$0');
//   });
// });


$(document).ready(function() {
  // Tarea: Implementar lógica para manejo de precios, cantidades y observaciones de servicios seleccionados

  // Vacía el campo de entrada del vehículo cuando se cierra el modal
  $('#staticBackdrop').on('hidden.bs.modal', function () {
      $('#vehiculoInpu').empty().append('');
  });

  // Maneja la selección y deselección de los servicios, así como la actualización del precio total
  $('.form-check-input').change(function() {
      var precio = $(this).siblings('.precio-servicio').data('precio');
      if (this.checked) {
          $(this).parent().after(`
              <div class="d-flex flex-column mt-2">
                  <div class="d-flex">
                      <input type="text" class="form-control me-2 precio-input" name="precios[]" placeholder="Ingrese el precio" value="${precio}" />
                      <input type="number" class="form-control cantidad-input" name="cantidades[]" placeholder="Ingrese la cantidad" value="1" min="1" />
                  </div>
                  <textarea class="form-control mt-2 observaciones-input" name="observaciones[]" placeholder="Ingrese observaciones"></textarea>
              </div>
          `);
      } else {
          $(this).parent().next('div.d-flex.flex-column').remove();
      }
      actualizarTotal();
  });

  // Verifica si el campo de precio está vacío cuando pierde el foco
  $(document).on('blur', '.precio-input', function() {
      if ($(this).val() === "") {
          $(this).closest('div.d-flex.flex-column').prev().find('.form-check-input').prop('checked', false).trigger('change');
      } else {
          actualizarTotal();
      }
  });

  // Actualiza el total cuando cambia el valor del precio, solo si no está vacío
  $(document).on('input', '.precio-input', function() {
      if ($(this).val() !== "") {
          actualizarTotal();
      }
  });

  // Actualiza el total cuando cambia la cantidad
  $(document).on('input', '.cantidad-input', function() {
      actualizarTotal();
  });

  // Función para actualizar el precio total
  function actualizarTotal() {
      var total = 0;
      $('.form-check-input:checked').each(function() {
          var precio = parseFloat($(this).parent().next('div.d-flex.flex-column').find('.precio-input').val());
          var cantidad = parseInt($(this).parent().next('div.d-flex.flex-column').find('.cantidad-input').val());
          total += precio * cantidad;
      });
      $('#totalPrecio').text('$' + total.toFixed(2));
  }

  // Restaura el estado inicial cuando se cierra el modal
  $('#staticBackdrop').on('hidden.bs.modal', function () {
      $('.form-check-input').prop('checked', false).trigger('change');
      $('#totalPrecio').text('$0');
  });
});



  // ESTE CODIGO SIRVE PARA TOMAR EL VALOR DEL SELEC DE CLIENTES Y ASI REALIZAR LA PETICION FECT
  // DE LOS VEHICULOS QUE TIENE EL CLIENTES
  $(document).ready(function() {

    $('#clienteSelect').on('change', async function() {
      var Cliente = $(this).val();
      var Url = $(this).data('vehiculo');
  
      if ($('#staticBackdrop').is(':visible')) {
        const slectVehiculos = new FetchAPI(Url);
        const formData = new FormData();
        formData.append("cliente", Cliente);
  
        try {
          const data = await slectVehiculos.sendForm(formData);
  
          // Llenar el select con los datos recibidos
          const select = $('#vehiculoInpu');
          select.empty(); // Vaciar el select antes de llenarlo
  
          data.items.forEach(item => {
            const option = $('<option></option>')
              .val(item.id)
              .text(`${item.marca} ${item.modelo} ${item.año}`);
            select.append(option);
          });
        } catch (error) {
          console.error("Error al enviar el formulario:", error);
        }
      }
    });
  });
  // FINAL DE ESTA SECCION
  
redirectUrl=""
// Cuando tu formulario se envíe, crea un objeto FormData y usa sendForm para enviarlo
document.getElementById("formFactura").addEventListener("submit", async (event) => {
    event.preventDefault(); // Previene el envío estándar del formulario

    const Url = event.target.getAttribute("data-fetch-url");

    document.getElementById('loadingScreen').style.display = 'flex';
    // // Cambiar el estado del botón a "Cargando..."

    // Instancia de la clase con la URL base de tu API
    const api = new FetchAPI(Url);
    const formData = new FormData(event.target);
    try {
      const data = await api.sendForm(formData);
      console.log(data);
      // if (data.status == "success") {
      //   setTimeout(function () {
      //       document.getElementById('loadingScreen').style.display = 'none';
      //       event.target.reset();
      //       document.getElementById('cerrarbtn').click();
      //       Toast.fire({
      //         icon: data.status,
      //         title: data.msg
      //       });
      //   }, 2000);
      //   console.log("Respuesta del servidor:", data);
      // } else {
      //   setTimeout(function () {
      //       document.getElementById('loadingScreen').style.display = 'none';
      //     Toast.fire({
      //       icon: data.status,
      //       title: data.msg
      //     });
          
      //   //   redirectUrl=data.url
      //   }, 2000);
      // }

      // Restablecer el botón a su estado original después de recibir la respuesta
    } catch (error) {
      console.error("Error al enviar el formulario:", error);
      // Maneja el error aquí
      // Asegurarse de que el botón se restablezca incluso si hay un error
      btnEnvio.textContent = "Acceder";
      btnEnvio.disabled = false;
    }
  });
// Cuando tu formulario se envíe, crea un objeto FormData y usa sendForm para enviarlo
document.getElementById("formCliente").addEventListener("submit", async (event) => {
    event.preventDefault(); // Previene el envío estándar del formulario

    const Url = event.target.getAttribute("data-fetch-url");

    document.getElementById('loadingScreen').style.display = 'flex';
    // // Cambiar el estado del botón a "Cargando..."

    // Instancia de la clase con la URL base de tu API
    const api = new FetchAPI(Url);
    const formData = new FormData(event.target);
    try {
      const data = await api.sendForm(formData);
      if (data.status == "success") {
        setTimeout(function () {
            document.getElementById('loadingScreen').style.display = 'none';
            event.target.reset();
            document.getElementById('btnSalidaCerra').click();
            Toast.fire({
              icon: data.status,
              title: data.msg
            });
        }, 2000);
        console.log("Respuesta del servidor:", data);
      } else {
        setTimeout(function () {
            document.getElementById('loadingScreen').style.display = 'none';
          Toast.fire({
            icon: data.status,
            title: data.msg
          });
          
        //   redirectUrl=data.url
        }, 2000);
      }

      // Restablecer el botón a su estado original después de recibir la respuesta
    } catch (error) {
      console.error("Error al enviar el formulario:", error);
      // Maneja el error aquí
      // Asegurarse de que el botón se restablezca incluso si hay un error
      btnEnvio.textContent = "Acceder";
      btnEnvio.disabled = false;
    }
  });