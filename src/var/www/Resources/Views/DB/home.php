<!doctype html>
<html lang="es" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= $data["titulo"] ?></title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="<?= $data["icono"] ?>" type="image/x-icon">
    <!-- Library / Plugin Css Build -->
    <link rel="stylesheet" href="<?= $utils->assets('Css/libs.min.css'); ?>" />
    <!-- Hope Ui Design System Css -->
    <link rel="stylesheet" href="<?= $utils->assets('Css/hope-ui.min.css'); ?>" />
    <!-- Custom Css -->
    <link rel="stylesheet" href="<?= $utils->assets('Css/custom.min.css'); ?>" />
    <!-- Dark Css -->
    <link rel="stylesheet" href="<?= $utils->assets('Css/dark.min.css'); ?>" />
    <!-- Customizer Css -->
    <link rel="stylesheet" href="<?= $utils->assets('Css/customizer.min.css'); ?>" />
    <!-- RTL Css -->
    <link rel="stylesheet" href="<?= $utils->assets('Css/rtl.min.css'); ?>" />
</head>

<body class=" " data-bs -spy="scroll" data-bs-target="#elements-section" data-bs-offset="0" tabindex="0">
    <!-- loader Start -->
    <div id="loading">
        <div class="loader simple-loader">
            <div class="loader-body"></div>
        </div>
    </div>
    <!-- loader END -->
    <div class="wrapper">
        <section class="login-content">
            <div class="row m-0 align-items-center bg-white vh-100">
                <div class="col-md-6">
                    <div class="row justify-content-center">
                        <div class="col-md-10">
                            <div class="card card-transparent shadow-none d-flex justify-content-center mb-0 auth-card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-center mb-3">
                                        <a href="#" class="navbar-brand d-flex align-items-center mb-3">
                                            <!--Logo start-->
                                            <div class="logo-main">
                                                <div class="logo-normal">
                                                    <img src="<?= $utils->assets('Img/auth/Logo_IEPP.webp'); ?>" class="text-primary" width="150" alt="Your Logo Description">
                                                </div>
                                            </div>
                                            <!--logo End-->
                                        </a>
                                    </div>
                                    <h2 class="mb-2 text-center">Iniciar Sesión</h2>
                                    <p class="text-center">Bienvenido al inicio de sesion de la <?= $_ENV["TITULO_APP"] ?>.</p>
                                    <form method="POST" id="formAccerder" autocomplete="off" data-fetch-url="<?php echo htmlspecialchars($data["url"]["form"]) ?>">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="Dui" class="form-label">DUI</label>
                                                    <input type="text" class="form-control" name="dui" id="dui" aria-describedby="Dui" placeholder="000000000" oninvalid="this.setCustomValidity('Por favor, ingresa un DUI de 9 dígitos sin guion')" oninput="this.setCustomValidity('')" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="password" class="form-label">Contraseña</label>
                                                    <input type="password" class="form-control" name="password" id="password" aria-describedby="password" placeholder="*********" oninvalid="this.setCustomValidity('Por favor, ingresa tu contraseña')" oninput="this.setCustomValidity('')" required>
                                                    <div class="input-group-append">
                                                        <a class="btn" type="button" id="togglePassword">
                                                            <svg class="icon-24" width="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path opacity="0.4" fill-rule="evenodd" clip-rule="evenodd" d="M11.9902 3.88184H12C13.3951 3.88184 14.7512 4.21657 16 4.84567L12.7415 8.13491C12.5073 8.09553 12.2537 8.066 12 8.066C9.8439 8.066 8.09756 9.82827 8.09756 12.004C8.09756 12.26 8.12683 12.516 8.16585 12.7523L4.5561 16.3949C3.58049 15.2529 2.73171 13.8736 2.05854 12.2895C1.98049 12.1123 1.98049 11.8957 2.05854 11.7087C4.14634 6.80583 7.86341 3.88184 11.9902 3.88184ZM18.4293 6.54985C19.8439 7.8494 21.0439 9.60183 21.9415 11.7087C22.0195 11.8957 22.0195 12.1123 21.9415 12.2895C19.8537 17.1924 16.1366 20.1262 12 20.1262H11.9902C10.1073 20.1262 8.30244 19.506 6.71219 18.3738L9.80488 15.2529C10.4293 15.6753 11.1902 15.9322 12 15.9322C14.1463 15.9322 15.8927 14.1699 15.8927 12.004C15.8927 11.1869 15.639 10.419 15.2195 9.78889L18.4293 6.54985Z" fill="currentColor"></path>
                                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M18.4296 6.54952L20.2052 4.75771C20.4979 4.4722 20.4979 3.99964 20.2052 3.71413C19.9223 3.42862 19.4637 3.42862 19.1711 3.71413L18.254 4.63957C18.2442 4.65926 18.2247 4.67895 18.2052 4.69864C18.1954 4.71833 18.1759 4.73802 18.1564 4.75771L17.2881 5.63491L14.1954 8.7558L3.72715 19.3186L3.69789 19.358C3.50276 19.6435 3.54179 20.0383 3.78569 20.2844C3.92228 20.4311 4.1174 20.5 4.30276 20.5C4.48813 20.5 4.6735 20.4311 4.81984 20.2844L15.2198 9.78855L18.4296 6.54952ZM12.0004 14.4555C13.337 14.4555 14.4297 13.3529 14.4297 12.0041C14.4297 11.5906 14.3321 11.1968 14.1565 10.8621L10.8687 14.1798C11.2004 14.3571 11.5907 14.4555 12.0004 14.4555Z" fill="currentColor"></path>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>


                                            <script>
                                                document.getElementById('togglePassword').addEventListener('click', function(e) {
                                                    const password = document.getElementById('password');
                                                    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                                                    password.setAttribute('type', type);
                                                    // toggle the eye slash icon
                                                    this.querySelector('i').classList.toggle('fa-eye');
                                                    this.querySelector('i').classList.toggle('fa-eye-slash');
                                                });
                                            </script>
                                
                                            <div class="d-flex justify-content-center">
                                                <button type="submit" id="BtnEnvio" class="btn btn-primary">
                                                    Acceder
                                                </button>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="sign-bg">
                        <svg width="280" height="230" viewBox="0 0 431 398" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g opacity="0.05">
                                <rect x="-157.085" y="193.773" width="543" height="77.5714" rx="38.7857" transform="rotate(-45 -157.085 193.773)" fill="#3B8AFF" />
                                <rect x="7.46875" y="358.327" width="543" height="77.5714" rx="38.7857" transform="rotate(-45 7.46875 358.327)" fill="#3B8AFF" />
                                <rect x="61.9355" y="138.545" width="310.286" height="77.5714" rx="38.7857" transform="rotate(45 61.9355 138.545)" fill="#3B8AFF" />
                                <rect x="62.3154" y="-190.173" width="543" height="77.5714" rx="38.7857" transform="rotate(45 62.3154 -190.173)" fill="#3B8AFF" />
                            </g>
                        </svg>
                    </div>
                </div>
                <div class="col-md-6 d-md-block d-none bg-primary p-0 mt-n1 vh-100 overflow-hidden">
                    <img src="<?= $utils->assets('Img/auth/01.png'); ?>" class="img-fluid gradient-main animated-scaleX" alt="images">
                </div>
            </div>
        </section>
    </div>

    <!-- Library Bundle Script -->
    <script src="<?= $utils->assets('Js/libs.min.js'); ?>"></script>

    <!-- External Library Bundle Script -->
    <script src="<?= $utils->assets('Js/external.min.js'); ?>"></script>

    <!-- Widgetchart Script -->
    <script src="<?= $utils->assets('Js/charts/widgetcharts.js'); ?>"></script>

    <!-- mapchart Script -->
    <script src="<?= $utils->assets('Js/charts/vectore-chart.js'); ?>"></script>
    <script src="<?= $utils->assets('Js/charts/dashboard.js'); ?>"></script>

    <!-- fslightbox Script -->
    <script src="<?= $utils->assets('Js/plugins/fslightbox.js'); ?>"></script>

    <!-- Settings Script -->
    <script src="<?= $utils->assets('Js/plugins/setting.js'); ?>"></script>

    <!-- Slider-tab Script -->
    <script src="<?= $utils->assets('Js/plugins/slider-tabs.js'); ?>"></script>

    <!-- Form Wizard Script -->
    <script src="<?= $utils->assets('Js/plugins/form-wizard.js'); ?>"></script>
    <script src="<?= $utils->assets('Js/herramientas/formatearInput.js'); ?>"></script>
    <script src="<?= $utils->assets('Js/Fetch/FetchForm.js'); ?>"></script>
    <script src="<?= $utils->assets('Js/sign-in/sign-in.js'); ?>"></script>


    <!-- AOS Animation Plugin-->

    <!-- App Script -->
    <script src="<?= $utils->assets('Js/hope-ui.js'); ?>" defer></script>
    <script src="<?= $utils->assets('Js/sweetalert/sweetalert2.all.min.js'); ?>" defer></script>
    <script src="<?= $utils->assets('Js/sweetalert/sweetalert2.js'); ?>" defer></script>
    <!-- <script src="<?= $utils->assets('Js/sweetalert/sweetalert2.js'); ?>" defer></script> -->



</body>

</html>