<?php

namespace App\Controller;

use Core\Utils;
use App\Models\UserModel;
use App\Models\DatosUserModel;
use App\Setting\Encryptar;
use App\Setting\AuthValidar;

class DBControllers 
{
   private $header = [];
   private UserModel $UserModel;
   private DatosUserModel $DatosUserModel;
   private Encryptar $Encrypto;
   public function __construct()
   {
      $this->header[1] = "Auth";
      $this->UserModel = new UserModel;
      $this->DatosUserModel = new DatosUserModel;
      $this->Encrypto = new Encryptar($_ENV["JWT_SECRET_KEY"]);     

   }
   public function home()
   {
      $data=[
         "status"=>"success",
         "icono"=>Utils::assets('Img/auth/ico.png'),
         "titulo"=>"IEPP | DB",
         "url"=>[
            "form"=>Utils::url('/Auth/acceder'),
            "resetPassword"=>Utils::url('/Auth/reset')
         ]
      ];
  
      return Utils::view("DB.Home", $data,null);
   }

   /**SE ENCARGA DE CARGAR LOS DATOS */
   public function Autenticar()
   {
      
   }
   /**SE ENCARGA DE GESTIONAR CONSULTAS FETCH */
   public function questionMsg()
   {
   }
}
