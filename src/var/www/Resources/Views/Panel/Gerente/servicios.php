<!-- 
<style>
    @media (max-width: 768px) {
    /* Estilos específicos para tabletas y móviles */
    .search-input {
        display: none; /* Ocultar el div cuando sea tableta o móvil */
    }
}
</style> -->

<div class="conatiner-fluid content-inner mt-n5 py-0 ">
        <!-- <div  class="col-10" style="background-color: gree;"></div> -->
        <div class="col-md-12 col-lg-12 mt-lg-5 d-block d-lg-none mt-5">
            <div class="row row-cols-1 mt-3">
                <div class="overflow-hidden d-slider1">
                    <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="700">
                       
                    </li>
                </div>
            </div>
        </div>
        <div class="row mt-lg-3">
        <!-- <div class="col-sm-12 mt-lg-5">
            </div> -->
            <div class="col-sm-12 mt-lg-5">
                <button type="button" class="btn btn-primary mb-2   btn-responsive" data-bs-toggle="modal" data-bs-target="#addServicio">
                    Agregar Servicio
                </button>
                <div class="overflow-hidden card" data-aos="fade-up" data-aos-delay="600">
                    <div class="card-body p-0 position-relative">
                        <div class="table-responsive">
                            <table id="basic-table" class="table table-striped mb-0 table-fixed" role="grid">
                                <thead>
                                    <tr>
                                        <th class="text-th">SERVICIO</th>
                                        <th>PRECIO</th>
                                        <th>ESTATUS</th>
                                        <th class="col-4" id="original-parent">
                                            <div class="input-group search-input" id="div-to-move">
                                                <input type="text" class="form-control" id="inputBuscar" data-url="<?= $data["url"]["busqueda"] ?>" data-codicion="<?= $data["url"]["paginacion"] ?>" placeholder="Buscar...">
                                                <button class="btn btn-outline-primary btn-accion" type="button" id="btn_search">Buscar</button>
                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="contendioTb" data-Url="<?= $data["url"]["data_id"] ?>">
                                    <?php
                                    foreach ($data["data"] as $key => $value) {
                                        echo sprintf(
                                            '<tr>
                                            <td class="text-bold-500">
                                                <div class="d-flex align-items-center">
                                                    <h6 class="py-1 text-mobile-white">%s</h6>
                                                </div>
                                            </td>
                                            <td class="text-bold-500">
                                                <div class="d-flex align-items-center">
                                                    <h6>%s</h6>
                                                </div>
                                            </td>
                                            <td class="text-bold-500">
                                                <div class="d-flex align-items-center">
                                                  <p class="h4">
                                                     <span class="badge rounded-pill %s">%s</span>
                                                     </p>
                                                </div>
                                            </td>
                                            <td class="text-bold-500 col-4">
                                                <div class="d-flex justify-content-center align-items-center">
                                                    <button type="button" class="btn btn-primary" onclick="modal(%s)" data-id="%s">
                                                        Modificar
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>',
                                            $value["nombre"],
                                            $value["precio"],
                                            $estado=$value["titulo"] == "ACTIVO" ? "bg-success": "bg-danger",
                                            $value["titulo"],
                                            $value["id"],
                                            $value["id"]
                                        );
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="bd-example mt-2 pagination justify-content-center align-items-center">
                    <nav aria-label="Standard pagination example" id="paginacion">
                        <?= $data["paginacion"]; ?>
                    </nav>
                </div>
            </div>
        </div>
    </div>


<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title scheduler-border" id="staticBackdropLabel">DATOS DEL SERVICIO</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">   
                <form method="POST" action="" id="formUpdateServicio" data-update="<?= $data["url"]["update"] ?>">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label fw-bold">Servicio</label>
                                <input type="text" class="form-control" name="servicio">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                    <label class="form-label fw-bold">Precio</label>
                                    <input type="text" class="form-control" name="precio">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label fw-bold" for="exampleFormControlTextarea1">Descripcion</label>
                                <textarea class="form-control" name="descripcion" id="exampleFormControlTextarea1" rows="5" style="height: 70px;"></textarea>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label fw-bold fw-bold">Estado</label>
                                    <select class="form-select form-select-sm" name="estado" aria-label=".form-select-sm example">
                                            <option value="1">ACTIVO</option>
                                            <option value="2">DESACTIVO</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="modal-footer">
                            <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal" id="cerrarbtn">CANCELAR</button>
                            <button type="submit" class="btn btn-primary">ACTUALIZAR</button>
                        </div>
                    </form>                

        </div>
    </div>
</div>

<div class="modal fade" id="addServicio" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title scheduler-border" id="staticBackdropLabel">DATOS DEL SERVICIO</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">   
                <form method="POST" action="" id="formAddServicio" data-update="<?= $data["url"]["add"] ?>">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label fw-bold">Servicio</label>
                                <input type="text" class="form-control" name="servicio">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                    <label class="form-label fw-bold">Precio</label>
                                    <input type="text" class="form-control" name="precio">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label fw-bold" for="exampleFormControlTextarea1">Descripcion</label>
                                <textarea class="form-control" name="descripcion" id="exampleFormControlTextarea1" rows="5" style="height: 70px;"></textarea>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label fw-bold fw-bold">Estado</label>
                                    <select class="form-select form-select-sm" name="estado" aria-label=".form-select-sm example">
                                            <option value="1">ACTIVO</option>
                                            <option value="2">DESACTIVO</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="modal-footer">
                            <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal" id="cerrarbtn">CANCELAR</button>
                            <button type="submit" class="btn btn-primary">ACTUALIZAR</button>
                        </div>
                    </form>                

        </div>
    </div>
</div>
<script src="<?= $utils->assets("Js/servicios/index.js"); ?>"></script>