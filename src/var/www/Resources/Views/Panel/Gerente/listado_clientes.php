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
            <div class="col-sm-12 mt-lg-5">
                <div class="overflow-hidden card" data-aos="fade-up" data-aos-delay="600">
                    <div class="card-body p-0 position-relative">
                        <div class="table-responsive">
                            <table id="basic-table" class="table table-striped mb-0 table-fixed" role="grid">
                                <thead>
                                    <tr>
                                        <th class="text-th">NOMBRE</th>
                                        <th>TELEFONO</th>
                                        <th>FECHA REGISTRO</th>
                                        <th class="col-4" id="original-parent">
                                            <div class="input-group search-input" id="div-to-move">
                                                <input type="text" class="form-control" id="inputBuscar" data-url="<?= $data["url"]["busqueda"] ?>" data-codicion="<?= $data["url"]["paginacion"] ?>" placeholder="Buscar...">
                                                <button class="btn btn-outline-primary btn-accion" type="button" id="btn_search">Buscar</button>
                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="contendioTb" data-Url="">
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
                                                    <h6>%s</h6>
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
                                            $value["nombre"] . " " . $value["apellidos"],
                                            $value["telefono"],
                                            $value["fecha_registro"],
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
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title scheduler-border" id="staticBackdropLabel">DATOS DEL CLIENTE</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">


                    <div class="col-7">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label fw-bold">Nombre del Cliente</label>
                                    <input type="text" class="form-control" name="nombre" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label fw-bold">Apellido del Cliente</label>
                                    <input type="text" class="form-control" name="apellido" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label fw-bold fw-bold">Telefono</label>
                                    <input type="text" class="form-control" name="descripcion_tipo_solicitud">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label fw-bold">Correo</label>
                                    <input type="text" class="form-control" name="fecha">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label fw-bold" for="exampleFormControlTextarea1">Direccion</label>
                                <textarea class="form-control" name="direccion" id="exampleFormControlTextarea1" rows="5" style="height: 70px;"></textarea>
                            </div>
                            <div class="col-md-12 text-center">
                                <button class="btn btn-primary rounded-pill mt-2">
                                    <span class="btn-inner">
                                        <svg class="icon-32" width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path opacity="0.4" d="M18.8088 9.021C18.3573 9.021 17.7592 9.011 17.0146 9.011C15.1987 9.011 13.7055 7.508 13.7055 5.675V2.459C13.7055 2.206 13.5026 2 13.253 2H7.96363C5.49517 2 3.5 4.026 3.5 6.509V17.284C3.5 19.889 5.59022 22 8.16958 22H16.0453C18.5058 22 20.5 19.987 20.5 17.502V9.471C20.5 9.217 20.298 9.012 20.0465 9.013C19.6247 9.016 19.1168 9.021 18.8088 9.021Z" fill="currentColor"></path>
                                            <path opacity="0.4" d="M16.0842 2.56737C15.7852 2.25637 15.2632 2.47037 15.2632 2.90137V5.53837C15.2632 6.64437 16.1742 7.55437 17.2792 7.55437C17.9772 7.56237 18.9452 7.56437 19.7672 7.56237C20.1882 7.56137 20.4022 7.05837 20.1102 6.75437C19.0552 5.65737 17.1662 3.69137 16.0842 2.56737Z" fill="currentColor"></path>
                                            <path d="M14.3672 12.2364H12.6392V10.5094C12.6392 10.0984 12.3062 9.7644 11.8952 9.7644C11.4842 9.7644 11.1502 10.0984 11.1502 10.5094V12.2364H9.4232C9.0122 12.2364 8.6792 12.5704 8.6792 12.9814C8.6792 13.3924 9.0122 13.7264 9.4232 13.7264H11.1502V15.4524C11.1502 15.8634 11.4842 16.1974 11.8952 16.1974C12.3062 16.1974 12.6392 15.8634 12.6392 15.4524V13.7264H14.3672C14.7782 13.7264 15.1122 13.3924 15.1122 12.9814C15.1122 12.5704 14.7782 12.2364 14.3672 12.2364Z" fill="currentColor"></path>
                                        </svg>
                                    </span>


                                    Actualizar
                                </button>
                            </div>


                        </div>
                    </div>
                    <div class="col-3 m-2">
                        <div class="card">
                            <!-- <img src="" class="img-fluid rounded-start" alt="...">
                            <button class="btn-ver-completa" style="display: none;">Completa</button> -->
                            <!-- <div class="image-container">
                                <img src="" alt="Descripción de la imagen" class="image img-fluid rounded-start"  style="cursor:pointer">
                                <div class="overlay" id="clikImagen" data-toggle="modal" data-target="#miImageModal">
                                    <span href=""  class="view-btn">
                                    <svg class="icon-32" width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                <path opacity="0.4" fill-rule="evenodd" clip-rule="evenodd" d="M17.7366 6.04606C19.4439 7.36388 20.8976 9.29455 21.9415 11.7091C22.0195 11.8924 22.0195 12.1067 21.9415 12.2812C19.8537 17.1103 16.1366 20 12 20H11.9902C7.86341 20 4.14634 17.1103 2.05854 12.2812C1.98049 12.1067 1.98049 11.8924 2.05854 11.7091C4.14634 6.87903 7.86341 4 11.9902 4H12C14.0683 4 16.0293 4.71758 17.7366 6.04606ZM8.09756 12C8.09756 14.1333 9.8439 15.8691 12 15.8691C14.1463 15.8691 15.8927 14.1333 15.8927 12C15.8927 9.85697 14.1463 8.12121 12 8.12121C9.8439 8.12121 8.09756 9.85697 8.09756 12Z" fill="currentColor"></path>                                <path d="M14.4308 11.997C14.4308 13.3255 13.3381 14.4115 12.0015 14.4115C10.6552 14.4115 9.5625 13.3255 9.5625 11.997C9.5625 11.8321 9.58201 11.678 9.61128 11.5228H9.66006C10.743 11.5228 11.621 10.6695 11.6601 9.60184C11.7674 9.58342 11.8845 9.57275 12.0015 9.57275C13.3381 9.57275 14.4308 10.6588 14.4308 11.997Z" fill="currentColor"></path>                                </svg>                            
                                    FULL
                                </span>
                                </div>
                            </div> -->

                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer justify-content-between">
                <div class="form-group mb-0"> <!-- mb-0 asegura que no haya un margen en la parte inferior -->
                    <label class="form-label" id="fecha_envio">Fecha de registro</label>
                </div>
            </div>

        </div>
    </div>
</div>







<!-- La imagen que al hacer clic abrirá el modal -->
<!-- <div class="image-container">
    <img src="ruta_a_tu_imagen_pequeña.jpg" alt="Descripción de la imagen" class="img-thumbnail" style="cursor:pointer" data-toggle="modal" data-target="#imagenModal">
  </div> -->

<!-- Imagen que al hacer clic abrirá el modal -->

<!-- Modal para mostrar la imagen -->
<div class="modal fade" id="miImageModal" tabindex="-1" aria-labelledby="miImageModalLabel" aria-hidden="true">
    <div class="modal-dialog mi-modal-dialog modal-xl" role="document">
        <div class="modal-content mi-modal-content">
            <div class="modal-body mi-modal-body">
                <!-- Botón para cerrar el modal -->
                <button type="button" class="close mi-close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <!-- Imagen en pantalla completa -->
                <img src="" class="img-fluid mi-modal-img" id="fullImg" alt="Imagen descriptiva">
            </div>
        </div>
    </div>
</div>


<script>
   
</script>
<script src="<?= $utils->assets("Js/clientes/index.js"); ?>"></script>