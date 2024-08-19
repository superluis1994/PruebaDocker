<?php

namespace App\Controller;

use Core\Utils;
use App\Models\MarcasModel;
use App\Models\ClienteModel;
use App\Setting\SessionManager;
use App\Setting\AntiInyeciones;
use App\Setting\Paginacion;



class ClienteControllers
{
   private $header = [];
   private ClienteModel $ClienteModal;
   private MarcasModel $MarcasModel;
   private AntiInyeciones $inyecciones;
   private $paginas;
   private $limited;


   public function __construct()
   {

      $this->header[1] = "Auth";
      $this->MarcasModel = new MarcasModel;
      $this->ClienteModal = new ClienteModel;
      $this->inyecciones = new AntiInyeciones;
      $this->paginas = 10;
      $this->limited =4;
      // echo  var_dump($_SESSION["datos"]);

   }
   public function home()
   {
      // session_destroy();


      if (!SessionManager::isUserLoggedIn()) {
         header('Location:' . Utils::url("/Auth"));
         exit;
      }
      $SelectMarca = $this->MarcasModel->getAll();
      $data = [
         "status" => "success",
         "icono"=>Utils::assets('Img/Logopwa.png'),
         "titulo" => "PANEL | Home",
         "posicion" => "HOME",
         "MarcaSelec" => $SelectMarca,
         "url" => [
            "regitroEntrada" => Utils::url('/panel/entrada/add'),
            "select" => Utils::url('/panel/marcas/list'),
            "regitroCliente" => Utils::url('/panel/cliente/add'),
            "cerrarSesion" => Utils::url('/panel/salir'),
            // "resetPassword"=>Utils::url('/Auth/reset')
         ]
      ];
      $header = $this->header[1] = "IEPP | PANEL";
      return Utils::viewPanel("Panel.{$_SESSION['datos']['tipo']}.home", $data, $this->header);
   }

   public function addCliente()
   {
      $response = [
         "status" => "error",
         'titulo' => 'Error',
         'msg' => 'No se pudo realizar el regitro',
         'data' => "",
         'url' => ""
      ];

      if (!SessionManager::isUserLoggedIn()) {

         $response = [
            "status" => "error", // Puede ser "error", "fail" o un código específico que signifique no autenticado
            "titulo" => "No autenticado",
            "msg" => "No tienes permiso para realizar esta acción. Por favor, inicia sesión.",
            "url" => Utils::url('/Auth')
         ];
         echo json_encode($response);
         exit;
      }


      $estructuraDatos = [
         "nombre" => "string",
         "apellido" => "string",
         "telefono" => "string",
         "correo" => "string",
         "direccion" => "string",
         "marca" => "string",
         "modelo" => "string",
         "year" => "string",
         "placa" => "string",
         "SerieMotor" => "string"
      ];
        $dataSanitizada=[];
      $dataSanitizada = $this->inyecciones->LimpiarForm($_POST, $estructuraDatos);
      $resp = $this->ClienteModal->ClienteAdd($dataSanitizada);
      if ($resp == true) {
         $response = [
            "status" => "success",
            'titulo' => 'correcto',
            'msg' => 'Cliente Registrado correctamente',
            'data' => $dataSanitizada,
            'url' => "",
         ];
      } else {

         $response = [
            "status" => "error", // Puede ser "error", "fail" o un código específico que signifique no autenticado
            "titulo" => "Error",
            "msg" => "Surgieron algunos errores.",
            "url" => ''
         ];
      }

      echo json_encode($response);
   }

   public function listClientes()
   {
      if (!SessionManager::isUserLoggedIn()) {
         header('Location:' . Utils::url("/Auth"));
         exit;
      }

      $clienteList = $this->ClienteModal->getAll($this->limited);
      $count=$this->ClienteModal->getAllCount();
      $paginacion =  new Paginacion($count[0]["total"], $this->limited,$this->paginas, 1, "");
      $pag = $paginacion->createLink("pagination justify-content-center");
      $data = [
         "status" => "success",
         "icono"=>Utils::assets('Img/Logopwa.png'),
         "titulo" => "PANEL | CLIENTES",
         "posicion" => "CLIENTES",
         "data" => $clienteList,
         "paginacion" =>$pag,
         "url" => [
            "busqueda" => Utils::url('/panel/cliente/busqueda'),
            "paginacion" => Utils::url('/panel/cliente/paginacion'),
         ]
      ];
      return Utils::viewPanel("Panel.{$_SESSION['datos']['tipo']}.listado_clientes", $data);
   }

   public function BusquedasYpaginacion()
   {
      
      $response = [
         "status" => "error",
         'titulo' => 'Error',
         'msg' => 'No se pudo realizar el regitro',
         'data' => "",
         'url' => ""
      ];
      if (!SessionManager::isUserLoggedIn()) {
         
         $response = [
            "status" => "error", // Puede ser "error", "fail" o un código específico que signifique no autenticado
            "titulo" => "No autenticado",
            "msg" => "No tienes permiso para realizar esta acción. Por favor, inicia sesión.",
            "url" => Utils::url('/Auth')
         ];
         echo json_encode($response);
         exit;
      }
   
      $estructuraDatos = [
         "busqueda" => "string",
         "paginacion" => "string",
         "grupPaginacion" => "string",
      ];
      $dataSanitizada=[];
      $dataSanitizada = $this->inyecciones->LimpiarForm($_POST, $estructuraDatos);

      $clienteList = $this->ClienteModal->getAllBusqueda($dataSanitizada,$this->limited);

      $count=$this->ClienteModal->getAllCountBusqueda($dataSanitizada);
      $paginacion =  new Paginacion($count[0]["total"], $this->limited,$this->paginas,$dataSanitizada["paginacion"] , $dataSanitizada["grupPaginacion"]);
      $pag = $paginacion->createLink("pagination justify-content-center");

      // $marcas = $this->MarcasModel->getAll($search, $page, $pageSize);
      // $total = $this->MarcasModel->countAll($search);

      // header('Content-Type: application/json');
      // echo json_encode($response);

      $response = [
         "status" => "success",
         'titulo' => 'Lista Clientes',
         'msg' => 'El json tiene los clientes',
         'clientes' => $clienteList,
         'paginacion' => $pag
      ];
      echo json_encode($response);
      exit();
   }
   public function SelectMarcas()
   {
      $search = isset($_GET['q']) ? $_GET['q'] : '';
      $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
      $pageSize = 30; // Tamaño de página, puedes ajustarlo según tus necesidades

      $marcas = $this->MarcasModel->getAll($search, $page, $pageSize);
      $total = $this->MarcasModel->countAll($search);

      $response = [
         "items" => $marcas,
         "total_count" => $total
      ];

      header('Content-Type: application/json');
      echo json_encode($response);
      exit();
   }



   /**SE ENCARGA DE CARGAR LOS DATOS */
   public function loadMsg()
   {
   }
   /**SE ENCARGA DE GESTIONAR CONSULTAS FETCH */
   public function questionMsg()
   {
   }
}
