<?php

namespace App\Controller;

use Core\Utils;
use App\Models\MarcasModel;
use App\Setting\Encryptar;
use App\Setting\SessionManager;
use App\Setting\AntiInyeciones;
use App\Setting\AuthValidar;
use App\Setting\Paginacion;



class MarcasControllers
{
   private $header = [];
   private MarcasModel $MarcasModel;
   private Encryptar $Encrypto;
   private AntiInyeciones $inyecciones;
   private $paginas;
   private $limited;


   public function __construct()
   {
     
      $this->header[1] = "Auth";
      $this->MarcasModel = new MarcasModel();
      $this->Encrypto = new Encryptar($_ENV["JWT_SECRET_KEY"]);
      $this->inyecciones = new AntiInyeciones;
      $this->paginas = 5;
      $this->limited =5;
      // echo  var_dump($_SESSION["datos"]);
  
   }
   public function home()
   {
      // session_destroy();
      
     
      if(!SessionManager::isUserLoggedIn()){
         header('Location:'.Utils::url("/Auth"));
         exit;
      }

      $Marcas= $this->MarcasModel->getAllList($this->limited);
      
      //print_r($Servicios);
      $count=$this->MarcasModel->getAllCount();
      $paginacion =  new Paginacion($count[0]["total"], $this->limited,$this->paginas, 1, "");
      $pag = $paginacion->createLink("pagination justify-content-center");
      
      
      $data=[
         "status"=>"success",
         "icono"=>Utils::assets('Img/Logopwa.png'),
         "titulo"=>"PANEL | MARCAS",
         "posicion"=>"MARCAS",
         "data"=>$Marcas,
         "paginacion" =>$pag,
         "url"=>[
            "data_id" => Utils::url('/panel/Administracion/marca/id'),
            "update" => Utils::url('/panel/Administracion/marca/update'),
            "add" => Utils::url('/panel/Administracion/marca/add'),
            "busqueda" => Utils::url('/panel/Administracion/marca/busqueda'),
            "paginacion" => Utils::url('/panel/Administracion/marca/paginacion'),
            ]
         ];
         $header = $this->header[1] = "IEPP | PANEL";
         return Utils::viewPanel("Panel.{$_SESSION['datos']['tipo']}.marcas", $data, $this->header);
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

      $Servicios = $this->MarcasModel->getAllBusqueda($dataSanitizada,$this->limited);

      $count=$this->MarcasModel->getAllCountBusqueda($dataSanitizada);
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
         'servicios' => $Servicios,
         'paginacion' => $pag
      ];
      echo json_encode($response);
      exit();
   }
   
   
   
   /**SE ENCARGA DE BUSCAR LOS SERVICIOS POR ID */
   public function MarcaId()
   {
      $response = [
         "status" => "error",
         'titulo' => 'Error',
         'msg' => 'No se pudo obtener los servicios',
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
      $SerId = $this->inyecciones->cleanInt($_POST["id"]);
      $Servicio = $this->MarcasModel->findById($SerId);
      if(count($Servicio)>0){
         $response = [
            "status" => "success",
            'titulo' => 'Lista Clientes',
            'msg' => 'El json tiene los clientes',
            'marca' => $Servicio,
         ];
      }
      echo json_encode($response);
      exit();
   }
   public function create()
   {
      $response = [
         "status" => "error",
         'titulo' => 'Error',
         'msg' => 'No se pudo obtener los servicios',
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
         "status" => "int",
      ];
      $Datos = [
         "nombre" => $_POST["nombre"],
         "status" => $_POST["estado"]
      ];
      $dataSanitizada=[];
      $dataSanitizada = $this->inyecciones->LimpiarForm($Datos, $estructuraDatos);
     
      $resp = $this->MarcasModel->create($dataSanitizada);
      if ($resp == true) {
         $response = [
            "status" => "success",
            'titulo' => 'Registrado',
            'msg' => 'Se registro correctamente',
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
      // print_r($dataSanitizada);
      echo json_encode($response);
      // echo json_encode($_POST);
      exit();
   }
   public function update()
   {
      $response = [
         "status" => "error",
         'titulo' => 'Error',
         'msg' => 'No se pudo obtener los servicios',
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
      // $SerId = $this->inyecciones->cleanInt($_POST["id"]);
      // $Servicio = $this->ServicioModel->findById($SerId);
      // if(count($Servicio)>0){
      //    $response = [
      //       "status" => "success",
      //       'titulo' => 'Lista Clientes',
      //       'msg' => 'El json tiene los clientes',
      //       'servicio' => $Servicio,
      //    ];
      // }

      $estructuraDatos = [
         "id_marca" => "int",
         "nombre" => "string",
         "status" => "int",
      ];
      $Datos = [
         "id_marca" => $_POST["id"],
         "nombre" => $_POST["nombre"],
         "status" => $_POST["estado"],
      ];
      $dataSanitizada=[];
      $dataSanitizada = $this->inyecciones->LimpiarForm($Datos, $estructuraDatos);
      $id=$dataSanitizada["id_marca"];
      unset($dataSanitizada["id_marca"]);
      $resp = $this->MarcasModel->update($id,$dataSanitizada);
      if ($resp == true) {
         $response = [
            "status" => "success",
            'titulo' => 'Actulizado',
            'msg' => 'El servicio se actualizo correctamente',
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
      // print_r($dataSanitizada);
      echo json_encode($response);
      // echo json_encode($_POST);
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
