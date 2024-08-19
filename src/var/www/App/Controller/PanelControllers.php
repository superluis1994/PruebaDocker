<?php

namespace App\Controller;

use Core\Utils;
use App\Models\UserModel;
use App\Models\MarcasModel;
use App\Models\ClienteModel;
use App\Models\ServicioModel;
use App\Models\DatosUserModel;
use App\Setting\Encryptar;
use App\Setting\SessionManager;
use App\Models\EntradasModel;
use App\Setting\AntiInyeciones;
// use App\Setting\AuthValidar;



class PanelControllers 
{
   private $header = [];
   private UserModel $UserModel;
   private MarcasModel $MarcasModel;
   private ClienteModel $ClienteModel;
   private ServicioModel $ServicioModel;

   private DatosUserModel $DatosUserModel;
   private EntradasModel $EntradasModel;
   private Encryptar $Encrypto;
   private AntiInyeciones $inyecciones;


   public function __construct()
   {
     
      $this->header[1] = "Auth";
      $this->UserModel = new UserModel;
      $this->MarcasModel = new MarcasModel;
      $this->ClienteModel = new ClienteModel;
      $this->ServicioModel = new ServicioModel();
 
      $this->EntradasModel = new EntradasModel;
      $this->DatosUserModel = new DatosUserModel;
      $this->Encrypto = new Encryptar($_ENV["JWT_SECRET_KEY"]);
      $this->inyecciones = new AntiInyeciones;
      // echo  var_dump($_SESSION["datos"]);
  
   }
   public function home()
   {
      // session_destroy();
      
     
      if(!SessionManager::isUserLoggedIn()){
         header('Location:'.Utils::url("/Auth"));
         exit;
      }
      

      // $SelectMarca=$this->MarcasModel->getAll();
      $Servicios = $this->ServicioModel->List_servicios();
      $data=[
         "status"=>"success",
         "icono"=>Utils::assets('Img/Logopwa.png'),
         "titulo"=>"PANEL | Home",
         "posicion"=>"HOME",
         "Servicios"=>$Servicios,
         "url"=>[
            "GenerarFactura"=>Utils::url('/panel/factura/registrar'),
            "selectVehiculo"=>Utils::url('/panel/vehiculo/list'),
            "select"=>Utils::url('/panel/marcas/list'),
            "selectCliente"=>Utils::url('/panel/cliente/select'),
            "regitroCliente"=>Utils::url('/panel/cliente/add'),
            "cerrarSesion"=>Utils::url('/panel/salir'),
            // "resetPassword"=>Utils::url('/Auth/reset')
            ]
         ];
         $header = $this->header[1] = "IEPP | PANEL";
         return Utils::viewPanel("Panel.{$_SESSION['datos']['tipo']}.home", $data, $this->header);
      }

   /** CERRAR SESSION DEL USUARIO */
   public function cerrarSesion()
   {
      $response = [
         "status"=>"error",
         'titulo' => 'Sesión no cerrada',
         'msg' => 'por problemas internos no se cerro la sesion',
         'url' => Utils::url(''),
      ];
      
      // $this->UserModel->Online($_SESSION["datos"]["id"],0);
      if(SessionManager::logoutUser()){

             
         $response = [
            "status"=>"success",
            'titulo' => 'Sesión cerrada',
            'msg' => 'presione ok',
            'url' => Utils::url('/Auth'),
         ];
      }

      echo json_encode($response);
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
   public function SelectCliente()
   {
       $search = isset($_GET['q']) ? $_GET['q'] : '';
       $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
       $pageSize = 5; // Tamaño de página, puedes ajustarlo según tus necesidades
   
       $clientes = $this->ClienteModel->getAllSelect($search, $page, $pageSize);
       $total = $this->ClienteModel->countAll($search);
   
       $response = [
           "items" => $clientes,
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
