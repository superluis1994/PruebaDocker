<?php
// este se utiliza para cargar todos los css y js las librerias
namespace Core;

use Core\App;
use App\Setting\MenuBuilder;

class Utils
{
    // este se utiliza para los enlaces o redireciones en las view 
    static function url($path =  "")
    {
        $url = App::getPath() . $path;
        $url = preg_replace('#/+#', '/', $url);
        return $url;
    }
    // y este se encarga de cargar las view del sistema
    static function assets($path = "")
    {
        $url = App::getPath() . "/Resources/Assets/{$path}";
        $url = preg_replace('#/+#', '/', $url);
        return $url;
    }
    static function ArrayUrl()
    {
        $url = explode('/', $_SERVER['REQUEST_URI']);
        unset($url[0]);
        return $url;
    }

    // Esta carga la view unicas que no tienen vista internas 
    static function view($path = "", $data = [] ,$header="")
    {
        // instancie la clase aqui para tener acceso a sus clases assets
        $utils = new Utils();
        $url = "./Resources/Views/";
       $path = str_replace(".", "/", $path);
        foreach ($data as $key => $value) {
            $key = $value;
        }
        
        // $content = "";
        // $content .= require_once  $url . "Partials/Header.php";
        // $content .=  require_once $url . '' . $path . ".php";
        // $content .= require_once  $url . "Partials/Footer.php";
        return require_once $url . '' . $path . ".php";;
    }
    
    static function viewPanel($path = "", $data = [])
    {
        // instancie la clase aqui para tener acceso a sus clases assets
        $utils = new Utils();
              // Crear una instancia de MenuBuilder
        $menu = new MenuBuilder();
        // Generar el HTML del menú
        $menuHtml = $menu->buildMenu();
        $data["menu"] = $menuHtml;
        $url = "./Resources/Views/";
        $path = explode('.', $path);
        foreach ($data as $key => $value) {
            $key = $value;
        }
  
        $content = "";
        $content .= require_once  $url . $path[0]."/Partials/Header.php";
// Suponiendo que $url, $path[0], $path[1], y $path[2] están definidos correctamente
        $filePath = $url . $path[0] . "/" . $path[1] . "/" . $path[2] . ".php";

// Usar operador ternario para verificar si el archivo existe
        $content .= file_exists($filePath) ? require_once $filePath : require_once $url . $path[0] . "/" . $path[1] . "/Error.php";
        // $content .= require_once $url . $path[0] ."/".$path[1]. "/".$path[2].".php";

        $content .= require_once  $url . $path[0]."/Partials/Footer.php";
        return $content;
    }

}
