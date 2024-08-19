
<!-- <div class="conatiner-fluid content-inner  mt-n5 py-0 ">
   <div class="row mt-lg-3">
      <div class="col-md-12 col-lg-12 mt-lg-5">
         <div class="row row-cols-1">
            <div class="overflow-hidden d-slider1 ">
               <ul class="p-0 m-0 mb-2 swiper-wrapper list-inline"> -->
                  <?php
                //   foreach ($data["data"] as $indice => $transaccion) {
                //      $delay = 700 + ($indice + 1) * 100; // Incrementamos el delay para la animación
                //      $titulo = $transaccion["titulo"];
                //      $balance = $transaccion["balance_neto"] === "Sin dinero" ? $transaccion["balance_neto"] : "$" . $transaccion["balance_neto"];
                //      $colorClase = $transaccion["balance_neto"] === "Sin dinero" ? "circle-progress-danger" : "circle-progress-info"; // Cambiar clase de color según condición

                //      echo <<<HTML
                //      <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="$delay">
                //         <div class="card-body">
                //            <div class="progress-widget">
                //                  <div id="circle-progress-$indice" class="text-center circle-progress-01 circle-progress $colorClase" data-min-value="0" data-max-value="100" data-value="80" data-type="percent">
                //                     <svg class="card-slie-arrow icon-24" width="24" viewBox="0 0 24 24">
                //                        <path fill="currentColor" d="M19,6.41L17.59,5L7,15.59V9H5V19H15V17H8.41L19,6.41Z" />
                //                     </svg>
                //                  </div>
                //                  <div class="progress-detail">
                //                     <p class="mb-2">$titulo</p>
                //                     <h5 class="counter text-muted">$balance</h5>
                //                  </div>
                //            </div>
                //         </div>
                //      </li>
                //   HTML;
                //   }

                  ?>

               <!-- </ul>
               <div class="swiper-button swiper-button-next"></div>
               <div class="swiper-button swiper-button-prev"></div>
            </div>
         </div>
      </div> -->
      <style>
         /* Estilos generales de la tarjeta */
         .card {
            position: relative;
            /* Tus otros estilos de .card van aquí */
         }

         /* Estilos para el ícono en la cabecera de la tarjeta */
         .card-header .icon-wrapper {
            position: absolute;
            top: -1rem;
            /* Ajusta esta medida para que el círculo sobresalga adecuadamente */
            left: 50%;
            transform: translateX(-50%);
            width: 3rem;
            /* Tamaño del círculo */
            height: 3rem;
            /* Tamaño del círculo */
            background-color: #fff;
            /* Color de fondo del círculo */
            border: 3px solid #ddd;
            /* Grosor y color del borde del círculo */
            border-radius: 50%;
            /* Redondea el borde para formar un círculo */
            display: flex;
            align-items: center;
            justify-content: center;
         }

         /* Estilos para el ícono dentro del círculo */
         .icon-wrapper i {
            color: #666;
            /* Color del ícono */
            /* Ajusta el tamaño del ícono si es necesario */
         }

         /* Ajustes adicionales para la cabecera de la tarjeta para hacer espacio para el ícono */
         .card-header {
            padding-top: 2rem;
            /* Asegúrate de que haya suficiente espacio para el círculo en la parte superior */
            /* Tus otros estilos de .card-header van aquí */
         }

         /* Estilos opcionales para añadir una sombra al círculo del ícono */
         .icon-wrapper {
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
         }

         .card-menu {
            min-height: 170px;
            /* Ajusta este valor al que prefieras */
            /* Mantén las demás propiedades existentes */
         }


         .card-container {
            display: flex;
            flex-wrap: nowrap;
            overflow-x: auto;
            gap: 15px;
            /* Espacio entre las tarjetas, ajusta según tu diseño */
         }

         .card-container .card {
            flex: 0 0 auto;
            /* Evita que las tarjetas se estiren */
         }
      </style>


      <div class="container mt-2 p-4 " style="max-height: 600px; overflow-y: auto; ">
         <div class="row">
            <!-- Card 1 -->
            <div class="col-6 col-md-4 col-lg-3">
               <div class="card mb-4 shadow-sm card-menu " data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                  <div class="card-header bg-primary text-white">
                     <div class="icon-wrapper">
                        <i class="fa-solid fa-credit-card fa-lg"></i>
                     </div>
                  </div>
                  <div class="card-body">
                     <h5 class="card-title text-center">Generar Factura</h5>
                     <p class="card-text ">Generar factura por los servicios realizados al vehiculo</p>
                  </div>
               </div>
            </div>
            <!-- ...other cards... -->
            <div class="col-6 col-md-4 col-lg-3">
               <div class="card mb-4 shadow-sm card-menu" data-bs-toggle="modal" data-bs-target="#ModSalidas">
                  <div class="card-header bg-primary text-white">
                     <div class="icon-wrapper">
                        <i class="fa-solid fa-credit-card fa-lg"></i>
                     </div>
                  </div>
                  <div class="card-body">
                     <h5 class="card-title text-center">Agregar Cliente</h5>
                     <p class="card-text text-center">Regitrar al cliente con su vehiculo</p>
                  </div>
               </div>
            </div>
            <div class="col-6 col-md-4 col-lg-3">
               <div class="card mb-4 shadow-sm card-menu">
                  <div class="card-header bg-primary text-white">
                     <div class="icon-wrapper">
                        <i class="fa-solid fa-credit-card fa-lg"></i>
                     </div>
                  </div>
                  <div class="card-body">
                     <h5 class="card-title text-center">Asistencia</h5>
                     <p class="card-text ">Lista de jovenes </p>
                  </div>
               </div>
            </div>
            <div class="col-6 col-md-4 col-lg-3">
               <div class="card mb-4 shadow-sm card-menu">
                  <div class="card-header bg-primary text-white">
                     <div class="icon-wrapper">
                        <i class="fa-solid fa-credit-card fa-lg"></i>
                     </div>
                  </div>
                  <div class="card-body">
                     <h5 class="card-title text-center">Ahorro </h5>
                     <p class="card-text text-justify ">Ahorros de los jovenes </p>
                  </div>
               </div>
            </div>
            <div class="col-6 col-md-4 col-lg-3">
               <div class="card mb-4 shadow-sm card-menu">
                  <div class="card-header bg-primary text-white">
                     <div class="icon-wrapper">
                        <i class="fa-solid fa-credit-card fa-lg"></i>
                     </div>
                  </div>
                  <div class="card-body">
                     <h5 class="card-title text-center">Reporte Financiero</h5>
                     <p class="card-text ">Reporte de ventas, talento, ofrenda </p>
                  </div>
               </div>
            </div>
            <div class="col-6 col-md-4 col-lg-3">
               <div class="card mb-4 shadow-sm card-menu">
                  <div class="card-header bg-primary text-white">
                     <div class="icon-wrapper">
                        <i class="fa-solid fa-credit-card fa-lg"></i>
                     </div>
                  </div>
                  <div class="card-body">
                     <h5 class="card-title text-center">Reporte Asistencia</h5>
                     <p class="card-text ">Reporte de asistencia </p>
                  </div>
               </div>
            </div>
         </div>
      </div>
      



   </div>
</div>

<div id="loadingScreen" class="loading-screen" style="display: none;">
  <div class="loading-text">Procesando registro...</div>
  <div class="dots">
    <div class="dot"></div>
    <div class="dot"></div>
    <div class="dot"></div>
  </div>
</div>

<!-- Modal entradas-->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered  modal-md">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">AGREGAR ENTRADA</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <form method="POST" id="formEntrada" data-fetch-url="<?=$data["url"]["regitroEntrada"]?>">

            <div class="modal-body">
               <div class="row">
                  <div class="col-sm-12 col-md-12">
                     <div class="form-group">
                        <label class="form-label">TIPO DE ENTRAD2</label>
                     <select class="form-select mb-3 shadow-none" name="tipoEntrada" required oninvalid="this.setCustomValidity('Por favor, selecionar una entrada.')" onchange="this.setCustomValidity('')" title="Por favor, selecionar una entrada">
                        <option value="" selected>...</option>
                              <?php 
                                  foreach ($data["select"] as $key => $value){       
                                     echo sprintf('<option value="%s">%s</option>',
                                     $value["id"],
                                     $value["entrada"]
                                    );
                                 }
                                 ?>
                     </select>
                  </div>
               </div>
               <div class="col-sm-12 col-md-12">
                  <div class="form-group">
                     <label class="form-label">CANTIDAD</label>
                     <!-- <input type="number" class="form-control" name="cantida" required oninvalid="this.setCustomValidity('Por favor, ingresa una cantidad.')" oninput="this.setCustomValidity('')" title="Por favor, ingresa una cantidad."> -->
                     <input type="text" class="form-control" name="cantidad" required 
                        pattern="^\d+(\.\d+)?|\d+(,\d+)?$" 
                        oninvalid="this.setCustomValidity('Por favor, ingresa una cantidad.')" 
                        oninput="this.setCustomValidity('')" 
                        title="Por favor, ingresa una cantidad.">

                  </div>
               </div>
               <div class="col-sm-12 col-md-12">
                  <div class="form-group">
                     <label class="form-label">COMENTARIO</label>
                     <textarea class="form-control" id="exampleFormControlTextarea1" name="comentario" rows="5"></textarea>
                  </div>
               </div>
            </div>
         </div>
         <div class="modal-footer">
            <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal" id="cerrarbtn">CANCELAR</button>
            <button type="submit" class="btn btn-primary">REGISTRAR</button>
         </div>
      </form>
      </div>
   </div>
</div>


<!-- Modal salidas-->
<div class="modal fade" id="ModSalidas" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered modal-md">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">AGREGAR SALIDA</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>


          <form method="POST" id="formSalidad" data-fetch-url="<?=$data["url"]["regitroSalida"]?>">

            <div class="modal-body">
               <div class="row">
                  <div class="col-sm-12 col-md-12">
                     <div class="form-group">
                        <label class="form-label">TIPO DE ENTRAD2</label>
                     <select class="form-select mb-3 shadow-none" name="tipoSalida" required oninvalid="this.setCustomValidity('Por favor, selecionar una entrada.')" onchange="this.setCustomValidity('')" title="Por favor, selecionar una entrada">
                        <option value="" selected>...</option>
                              <?php 
                                  foreach ($data["select"] as $key => $value){       
                                     echo sprintf('<option value="%s">%s</option>',
                                     $value["id"],
                                     $value["entrada"]
                                    );
                                 }
                                 ?>
                     </select>
                  </div>
               </div>
               <div class="col-sm-12 col-md-12">
                  <div class="form-group">
                     <label class="form-label">CANTIDAD</label>
                     <!-- <input type="number" class="form-control" name="cantida" required oninvalid="this.setCustomValidity('Por favor, ingresa una cantidad.')" oninput="this.setCustomValidity('')" title="Por favor, ingresa una cantidad."> -->
                     <input type="text" class="form-control" name="cantidad" required 
                        pattern="^\d+(\.\d+)?|\d+(,\d+)?$" 
                        oninvalid="this.setCustomValidity('Por favor, ingresa una cantidad.')" 
                        oninput="this.setCustomValidity('')" 
                        title="Por favor, ingresa una cantidad.">

                  </div>
               </div>
               <div class="col-sm-12 col-md-12">
                  <div class="form-group">
                     <label class="form-label">COMENTARIO</label>
                     <textarea class="form-control" id="exampleFormControlTextarea1" name="comentario" rows="5"></textarea>
                  </div>
               </div>
            </div>
         </div>
         <div class="modal-footer">
            <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal" id="btnSalidaCerra">CANCELAR</button>
            <button type="submit" class="btn btn-primary" id="BtnEnvio">REGISTRAR</button>
         </div>
      </form>
      </div>
   </div>
</div>



<!-- Resto de tu HTML aquí -->
<style>
.loading-screen {
   z-index: 99999;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.5); /* Semi-transparent black */
  z-index: 1000; /* High z-index to cover everything */
  display: flex;
  justify-content: center;
  align-items: center;
  text-align: center;
  flex-direction: column;
}

.loading-text {
  color: #fff;
  font-size: 20px;
  margin-bottom: 20px;
}

.dots {
  display: flex;
  align-items: center;
}

.dot {
  background-color: #f0f0f0;
  border-radius: 50%;
  width: 20px;
  height: 20px;
  margin: 0 5px;
  /* Animation */
  animation: bounce 0.6s infinite alternate;
}

.dot:nth-child(1) {
  animation-delay: 0.1s;
}

.dot:nth-child(2) {
  animation-delay: 0.2s;
}

.dot:nth-child(3) {
  animation-delay: 0.3s;
}

@keyframes bounce {
  0% { transform: translateY(0); }
  100% { transform: translateY(-20px); }
}

/* Estilos existentes para la pantalla de carga */
.loading-screen {
  /* ... */
  z-index: 1500; /* Este valor debería ser mayor que el z-index del modal y su backdrop */
  display: flex; /* Se muestra como flex para centrar el contenido */
  justify-content: center;
  align-items: center;
}

/* Estilos adicionales para asegurar visibilidad */
body, html {
  overflow: visible; /* Asegúrate de que no haya overflow hidden en el cuerpo o html */
}

/* Asegúrate de que no haya otros elementos con un z-index mayor interrumpiendo */
.any-other-overlay {
  z-index: 1400; /* Menor que el loader */
}




</style>

<script src="<?= $utils->assets("Js/agregar/trasacciones.js"); ?>"></script>

