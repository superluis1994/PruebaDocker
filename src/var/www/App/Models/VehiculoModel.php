<?php

namespace App\Models;
use App\Setting\Conexion;
use App\Setting\Encryptar;
use PDO;

class VehiculoModel
{
    private $tabla = "vehiculos";
    private $alias = "v"; // Alias de la tabla referente al modelo
    private $primaryKey = "id_vehiculo";
    private $db;

    public function __construct()
    {
        $this->db = Conexion::getConexion_();
    }
    public function veliculos_cliente($id_cliente){
        $stmt = $this->db->prepare("SELECT id_vehiculo as id, mV.nombre as marca, modelo, año  
                                    FROM {$this->tabla} {$this->alias}
                                    INNER JOIN marca_vehiculo mV ON mV.id_marca = {$this->alias}.marca
                                    WHERE `id_cliente` = :ID");
        $stmt->bindParam(':ID', $id_cliente, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    
}
