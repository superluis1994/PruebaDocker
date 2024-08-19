<?php

namespace App\Models;
use App\Setting\Conexion;
use App\Setting\Encryptar;
use PDO;

class ServicioModel
{
    private $tabla = "servicios";
    private $alias = "s"; // Alias de la tabla referente al modelo
    private $primaryKey = "id_servicio";
    private $db;
    private $OrderBy = "nombre";

    public function __construct()
    {
        $this->db = Conexion::getConexion_();
    }
    public function List_servicios(){
        $stmt = $this->db->prepare("SELECT id_servicio as id, nombre, precio_sugerido as precio 
                                    FROM {$this->tabla} {$this->alias}
                                    WHERE `status` = 1");
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAll($LIMIT){
        $stmt = $this->db->prepare("SELECT id_servicio as id, nombre, precio_sugerido as precio, st.titulo 
                                    FROM {$this->tabla} {$this->alias}
                                    INNER JOIN status AS st ON st.id_status = {$this->alias}.status
                                    ORDER BY {$this->alias}.{$this->OrderBy} ASC LIMIT :LIMIT");
                                    $stmt->bindParam(':LIMIT', $LIMIT, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllCount()
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) AS total 
        FROM {$this->tabla} {$this->alias} ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getAllBusqueda(array $data,$limited)
    {
        $condicion="";
        $offset = "OFFSET 0";
        if($data["busqueda"]!=""){
            $busqueda = strtoupper($data["busqueda"]);
            $condicion = "WHERE ({$this->alias}.nombre LIKE '%" . $busqueda . "%' OR 
                                 {$this->alias}.precio_sugerido LIKE '%" . $busqueda . "%' OR 
                                 st.titulo LIKE '" . $busqueda . "%' OR 
                                 {$this->alias}.descripcion LIKE '%" . $busqueda . "%')";
        }
        if ($data["paginacion"] != "" && $data["paginacion"] != 1) {
        $offset = "OFFSET " . abs((intval(@$data["paginacion"]) * $limited) - $limited);
        }
        $stmt = $this->db->prepare("SELECT id_servicio as id, nombre, precio_sugerido as precio, st.titulo
        FROM {$this->tabla} {$this->alias} 
        INNER JOIN status AS st ON st.id_status = {$this->alias}.status
        $condicion
        ORDER BY {$this->alias}.{$this->OrderBy} ASC LIMIT $limited $offset");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        // return $stmt;
    }
    public function getAllCountBusqueda(array $data)
    {
        $condicion="";
        if($data["busqueda"]!=""){
            $busqueda = strtoupper($data["busqueda"]);
            $condicion = "WHERE ({$this->alias}.nombre LIKE '%" . $busqueda . "%' OR 
                                 {$this->alias}.precio_sugerido LIKE '%" . $busqueda . "%' OR 
                                  st.titulo LIKE '" . $busqueda . "%' OR 
                                 {$this->alias}.descripcion LIKE '%" . $busqueda . "%')";
        }
        $stmt = $this->db->prepare("SELECT COUNT(*) AS total 
        FROM {$this->tabla} {$this->alias} 
        INNER JOIN status AS st ON st.id_status = {$this->alias}.status
        $condicion ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
      // Método para buscar un registro por su clave primaria
      public function findById($id)
      {
          $stmt = $this->db->prepare("SELECT id_servicio as id, nombre as servicio, precio_sugerido as precio, descripcion , st.titulo as estado
          FROM {$this->tabla} {$this->alias} 
          INNER JOIN status AS st ON st.id_status = {$this->alias}.status
          WHERE {$this->primaryKey} = :ID");
          $stmt->bindParam(':ID', $id, PDO::PARAM_INT);
          $stmt->execute();
          return $stmt->fetch(PDO::FETCH_ASSOC);
      }
      public function create(array $data)
      {
          // Asume que $data es un array asociativo con las columnas y sus valores
          $columns = implode(", ", array_keys($data));
          $values = ":" . implode(", :", array_keys($data));
  
          $stmt = $this->db->prepare("INSERT INTO {$this->tabla} ({$columns}) VALUES ({$values})");
  
          foreach ($data as $key => $value) {
              $stmt->bindValue(":$key", $value);
          }
  
          return $stmt->execute();
      }
      public function update($id, array $data)
      {
          $setPart = [];
          foreach ($data as $key => $value) {
              $setPart[] = "{$key} = :{$key}";
          }
          $setPart = implode(", ", $setPart);
  
          $stmt = $this->db->prepare("UPDATE {$this->tabla} SET {$setPart} WHERE {$this->primaryKey} = :id");
  
          foreach ($data as $key => $value) {
              $stmt->bindValue(":$key", $value);
          }
          $stmt->bindValue(':id', $id);
  
          return $stmt->execute();
      }

    
}
