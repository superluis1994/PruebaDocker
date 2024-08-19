<?php

namespace App\Controller;

use Core\Utils;
use App\Models\VehiculoModel;

use App\Models\UserModel;
use App\Models\MarcasModel;
use App\Models\ClienteModel;
use App\Setting\Encryptar;
use App\Setting\SessionManager;
use App\Setting\AntiInyeciones;
use App\Setting\AuthValidar;



class VehiculoControllers 
{
   private $header = [];
   private VehiculoModel $VehiculoModel;
   private UserModel $UserModel;
   private MarcasModel $MarcasModel;
   private ClienteModel $ClienteModel;

   private Encryptar $Encrypto;
   private AntiInyeciones $inyecciones;


   public function __construct()
   {
     
      $this->header[1] = "Auth";
      $this->VehiculoModel = new VehiculoModel ();


      $this->UserModel = new UserModel;
      $this->MarcasModel = new MarcasModel;
      $this->ClienteModel = new ClienteModel;
 
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
      

      
      $data=[
         "status"=>"success",
         "icono"=>Utils::assets('Img/panel/cpanel.svg'),
         "titulo"=>"PANEL | Home",
         "posicion"=>"HOME",
         "url"=>[
            "regitroEntrada"=>Utils::url('/panel/entrada/add'),
            "selectVehiculo"=>Utils::url('/panel/vehiculo/list'),
            "select"=>Utils::url('/panel/marcas/list'),
          
            ]
         ];
         $header = $this->header[1] = "IEPP | PANEL";
         return Utils::viewPanel("Panel.{$_SESSION['datos']['tipo']}.home", $data, $this->header);
      }


   public function SelectVehiculo()
   {

      $cliente=$this->inyecciones->cleanInput($_POST["cliente"]);
      $resul = $this->VehiculoModel->veliculos_cliente($cliente);
       $response = [
           "items" => $resul,
           "total_count" => ""
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
