

<!doctype html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Error</title>
      
      <!-- Favicon -->
      <link rel="shortcut icon" href="<?= $utils->assets('images/favicon.ico')?>"/>
      
      <!-- Library / Plugin Css Build -->
      <link rel="stylesheet" href="<?= $utils->assets('Css/libs.min.css')?>"/>
      
      
      <!-- Hope Ui Design System Css -->
      <link rel="stylesheet" href="<?= $utils->assets('Css/hope-ui.min.css?v=2.0.0')?>"/>
      
      <!-- Custom Css -->
      <link rel="stylesheet" href="<?= $utils->assets('Css/custom.min.css?v=2.0.0')?>"/>
      
      <!-- Dark Css -->
      <link rel="stylesheet" href="<?= $utils->assets('Css/dark.min.css')?>"/>
      
      <!-- Customizer Css -->
      <link rel="stylesheet" href="<?= $utils->assets('Css/customizer.min.css')?>"/>
      
      <!-- RTL Css -->
      <link rel="stylesheet" href="<?= $utils->assets('Css/rtl.min.css')?>"/>
      
      
  </head>
  <body class=" " data-bs-spy="scroll" data-bs-target="#elements-section" data-bs-offset="0" tabindex="0">
    <!-- loader Start -->
    <div id="loading">
      <div class="loader simple-loader">
          <div class="loader-body"></div>
      </div>    </div>
    <!-- loader END -->
    
      <div class="wrapper">
<!-- <script src="http://cdnjs.cloudflare.com/ajax/libs/gsap/1.18.0/TweenMax.min.js"></script> -->

<div class="gradient">
    <div class="container">
        <img src="<?= $utils->assets('images/error/404.png')?>" class="img-fluid mb-4 w-50" alt=""> 
        <h2 class="mb-0 mt-4 text-white">Oops! Esta página no se encuentra.</h2>
        <p class="mt-2 text-white">La página que buscas no existe.</p>
        <a class="btn bg-white text-primary d-inline-flex align-items-center" href="<?= $utils->url('/panel/home')?>">Regresar a Home</a>
    </div>
    <div class="box">
        <div class="c xl-circle">
            <div class="c lg-circle">
                <div class="c md-circle">
                    <div class="c sm-circle">
                        <div class="c xs-circle">                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    
</div>
      </div>
    
    <!-- Library Bundle Script -->
    <script src="<?=$utils->assets('Js/libs.min.js')?>"></script>
    
    <!-- External Library Bundle Script -->
    <script src="<?=$utils->assets('Js/external.min.js')?>"></script>
    
    <!-- Widgetchart Script -->
    <!-- <script src="<?=$utils->assets('Js/charts/widgetcharts.js')?>"></script> -->
    
    <!-- fslightbox Script -->
    <script src="<?=$utils->assets('Js/plugins/fslightbox.js')?>"></script>
    
    <!-- Settings Script -->
    <script src="<?=$utils->assets('Js/plugins/setting.js')?>"></script>
    
    <!-- Slider-tab Script -->
    <script src="<?=$utils->assets('Js/plugins/slider-tabs.js')?>"></script>
    
    <!-- Form Wizard Script -->
    <script src="<?=$utils->assets('Js/plugins/form-wizard.js')?>"></script>
    
    <!-- AOS Animation Plugin-->
    
    <!-- App Script -->
    <script src="<?=$utils->assets('Js/hope-ui.js')?>" defer></script>
    
  </body>
</html>