<?php
spl_autoload_register(function ($class) {
    // Cargar la clase desde el directorio `core/`
    $class = str_replace("\\", "/", $class);
    if (file_exists($class. '.php')) {
        require_once $class . '.php';
    }
    // echo $class."<br>";
});

require_once('vendor/autoload.php');
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
// Importación de clases
use Core\Request;
use Core\Route;
use Core\App;
use Core\Requiere;

// Instanciación de clases
$request = new Request();
$route = new Route();
$app = new App();
$Requiere = new Requiere('Routes');
$Requiere->cargar();

App::assets($request->getPublicUrl());
$routes = Route::getRoutes();
$url = $request->getUrl();
$request ->validate($routes, $url);


