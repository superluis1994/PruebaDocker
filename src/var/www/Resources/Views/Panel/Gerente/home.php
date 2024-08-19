<link rel="stylesheet" href="<?= $utils->assets("Css/styleHome.css") ?>" />
<!-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet"> -->
<div class="container mt-2 p-4 " style="max-height: 600px; overflow-y: auto; ">
   <div class="row">
      <div class="col-6 col-md-4 col-lg-3 cursor-pointer">
         <div class="card mb-4 shadow-sm card-menu card-styled" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            <div class="card-header bg-primary text-white">
               <div class="icon-wrapper">
                  <i class="fa-solid fa-credit-card fa-lg"></i>
               </div>
            </div>
            <div class="card-body">
               <h5 class="card-title text-center">Generar Factura</h5>
               <p class="card-text">Generar factura del cliente</p>
            </div>
         </div>
      </div>
      <div class="col-6 col-md-4 col-lg-3 cursor-pointer">
         <div class="card mb-4 shadow-sm card-menu card-styled" data-bs-toggle="modal" data-bs-target="#ModSalidas">
            <div class="card-header bg-primary text-white">
               <div class="icon-wrapper">
                  <i class="fa-solid fa-credit-card fa-lg"></i>
               </div>
            </div>
            <div class="card-body">
               <h5 class="card-title text-center">Agregar Cliente</h5>
               <p class="card-text ">Registrar al cliente con su vehículo</p>
            </div>
         </div>
      </div>
      <div class="col-6 col-md-4 col-lg-3">
         <a href="<?= $utils->url('/panel/factura/historial'); ?>" class="text-decoration-none text-reset">
            <div class="card mb-4 shadow-sm card-menu card-styled">
               <div class="card-header bg-primary text-white">
                  <div class="icon-wrapper">
                     <i class="fa-solid fa-credit-card fa-lg"></i>
                  </div>
               </div>
               <div class="card-body">
                  <h5 class="card-title text-center">Historial de factura</h5>
                  <p class="card-text">Facturas emitidas</p>
               </div>
            </div>
         </a>
      </div>
      <div class="col-6 col-md-4 col-lg-3">
         <a href="<?= $utils->url('/panel/Administracion/servicios'); ?>" class="text-decoration-none text-reset">
            <div class="card mb-4 shadow-sm card-menu card-styled">
               <div class="card-header bg-primary text-white">
                  <div class="icon-wrapper">
                     <i class="fa-solid fa-credit-card fa-lg"></i>
                  </div>
               </div>
               <div class="card-body">
                  <h5 class="card-title text-center">Servicios</h5>
                  <p class="card-text text-justify">Agregar, actualizar servicios</p>
               </div>
            </div>
         </a>
      </div>
      <div class="col-6 col-md-4 col-lg-3">
         <a href="<?= $utils->url('/panel/reporte'); ?>" class="text-decoration-none text-reset">
            <div class="card mb-4 shadow-sm card-menu card-styled">
               <div class="card-header bg-primary text-white">
                  <div class="icon-wrapper">
                     <i class="fa-solid fa-credit-card fa-lg"></i>
                  </div>
               </div>
               <div class="card-body">
                  <h5 class="card-title text-center">Reporte</h5>
                  <p class="card-text">Reporte de ingresos por reparaciones</p>
               </div>
            </div>
         </a>
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
   <div class="modal-dialog modal-dialog-centered  modal-xl">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">GENERAR FACTURA</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <form method="POST" id="formFactura" data-fetch-url="<?= $data["url"]["GenerarFactura"] ?>">

            <div class="modal-body">
               <div class="row">
                  <div class="col-sm-12 col-md-6">
                     <div class="form-group" id="clienteSelec" data-select="<?= $data["url"]["selectCliente"] ?>">
                        <label class="form-label">CLIENTE</label>
                        <select id="clienteSelect" name="cliente" style="width: 100%;" data-vehiculo="<?= $data["url"]["selectVehiculo"] ?>"></select>
                     </div>
                  </div>
                  <div class="col-sm-12 col-md-6">
                     <div class="form-group">
                        <label class="form-label">VEHICULO</label>
                        <select class="form-select mb-3 shadow-none" id="vehiculoInpu" name="vehiculo">
                        </select>
                     </div>
                  </div>
                  <div class="col-sm-12 col-md-12">
                     <div class="form-group">
                        <label class="form-label">SERVICIOS</label>
                        <div class="bd-example" bis_skin_checked="1">
                           <div class="container">
                              <div class="row" style="height: 200px;">
                                 <div class="col-md-6">
                                    <div class="list-group" bis_skin_checked="1">
                                       <?php
                                       $totalServicios = count($data["Servicios"]);
                                       $half = ceil($totalServicios / 2);
                                       $counter = 0;

                                       foreach ($data["Servicios"] as $servicio) {
                                          if ($counter == $half) {
                                             echo '</div></div><div class="col-md-6"><div class="list-group" bis_skin_checked="1">';
                                          }
                                          echo sprintf(
                                             '<label class="list-group-item">
                                                <input class="form-check-input me-1" name="servicios[]" type="checkbox" value="%s">
                                                %s
                                                <span class="badge bg-primary rounded-pill precio-servicio" data-precio="%s">$%s</span>
                                                </label>
                                                ',
                                             $servicio['id'],
                                             $servicio['nombre'],
                                             $servicio['precio'],
                                             $servicio['precio']
                                          );
                                          $counter++;
                                       }
                                       ?>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!-- <textarea class="form-control" id="exampleFormControlTextarea1" name="comentario" rows="5"></textarea> -->
                     </div>
                  </div>
               </div>
            </div>
            <div class="modal-footer d-flex justify-content-between">
               <!-- <label class="form-label mb-0" id="totalPrecio">TOTAL: </label> -->
               <div class="mt-3">
                  <label class="form-label mb-0">TOTAL: </label>
                  <span id="totalPrecio">$0</span>
               </div>
               <div>
                  <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal" id="cerrarbtn">CANCELAR</button>
                  <button type="submit" class="btn btn-primary">REGISTRAR</button>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>


<!-- Modal salidas-->
<div class="modal fade" id="ModSalidas" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered modal-xl">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">AGREGAR CLIENTE</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>


         <form method="POST" id="formCliente" data-fetch-url="<?= $data["url"]["regitroCliente"] ?>">

            <div class="modal-body">
               <div class="row">
                  <div class="col-sm-12 col-md-6">
                     <div class="form-group">
                        <label class="form-label">NOMBRE CLIENTE</label>
                        <!-- <input type="number" class="form-control" name="cantida" required oninvalid="this.setCustomValidity('Por favor, ingresa una cantidad.')" oninput="this.setCustomValidity('')" title="Por favor, ingresa una cantidad."> -->
                        <input type="text" class="form-control" name="nombre" required>
                     </div>
                  </div>
                  <div class="col-sm-12 col-md-6">
                     <div class="form-group">
                        <label class="form-label">APELLIDO CLIENTE</label>
                        <!-- <input type="number" class="form-control" name="cantida" required oninvalid="this.setCustomValidity('Por favor, ingresa una cantidad.')" oninput="this.setCustomValidity('')" title="Por favor, ingresa una cantidad."> -->
                        <input type="text" class="form-control" name="apellido" required>
                     </div>
                  </div>
                  <div class="col-sm-12 col-md-6">
                     <div class="form-group">
                        <label class="form-label">TELEFONO</label>
                        <!-- <input type="number" class="form-control" name="cantida" required oninvalid="this.setCustomValidity('Por favor, ingresa una cantidad.')" oninput="this.setCustomValidity('')" title="Por favor, ingresa una cantidad."> -->
                        <input type="text" class="form-control" name="telefono" required>
                     </div>
                  </div>
                  <div class="col-sm-12 col-md-6">
                     <div class="form-group">
                        <label class="form-label">CORREO</label>
                        <!-- <input type="number" class="form-control" name="cantida" required oninvalid="this.setCustomValidity('Por favor, ingresa una cantidad.')" oninput="this.setCustomValidity('')" title="Por favor, ingresa una cantidad."> -->
                        <input type="text" class="form-control" name="correo" required>
                     </div>
                  </div>
                  <div class="col-sm-12 col-md-6">
                     <div class="form-group">
                        <label class="form-label">DIRECCION</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" name="direccion" rows="2"></textarea>
                     </div>
                  </div>
                  <div class="col-sm-12 col-md-6">
                     <div class="form-group" id="marcasSelect" data-select="<?= $data["url"]["select"] ?>">
                        <label class="form-label">MARCA DEL VEHICULO</label>
                        <select id="miSelect" name="marca" style="width: 100%;"></select>
                     </div>
                  </div>

                  <div class="col-sm-12 col-md-6">
                     <div class="form-group">
                        <label class="form-label">MODELO DEL VEHICULO</label>
                        <!-- <input type="number" class="form-control" name="cantida" required oninvalid="this.setCustomValidity('Por favor, ingresa una cantidad.')" oninput="this.setCustomValidity('')" title="Por favor, ingresa una cantidad."> -->
                        <input type="text" class="form-control" name="modelo" required>
                     </div>
                  </div>
                  <div class="col-sm-12 col-md-6">
                     <div class="form-group">
                        <label class="form-label">AÑO DE VEHICULO</label>
                        <!-- <input type="number" class="form-control" name="cantida" required oninvalid="this.setCustomValidity('Por favor, ingresa una cantidad.')" oninput="this.setCustomValidity('')" title="Por favor, ingresa una cantidad."> -->
                        <input type="text" class="form-control" name="year" required>
                     </div>
                  </div>
                  <div class="col-sm-12 col-md-6">
                     <div class="form-group">
                        <label class="form-label">NUMERO DE PLACA</label>
                        <!-- <input type="number" class="form-control" name="cantida" required oninvalid="this.setCustomValidity('Por favor, ingresa una cantidad.')" oninput="this.setCustomValidity('')" title="Por favor, ingresa una cantidad."> -->
                        <input type="text" class="form-control" name="placa" required>
                     </div>
                  </div>
                  <div class="col-sm-12 col-md-6">
                     <div class="form-group">
                        <label class="form-label">SERIE DE MOTOR</label>
                        <!-- <input type="number" class="form-control" name="cantida" required oninvalid="this.setCustomValidity('Por favor, ingresa una cantidad.')" oninput="this.setCustomValidity('')" title="Por favor, ingresa una cantidad."> -->
                        <input type="text" class="form-control" name="SerieMotor" required>
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
<!-- <select id="miSelect" style="width: 200px;"></select> -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="<?= $utils->assets("Js/Fetch/Select2Modal.js"); ?>"></script>
<script src="<?= $utils->assets("Js/gerente/home.js"); ?>"></script>
