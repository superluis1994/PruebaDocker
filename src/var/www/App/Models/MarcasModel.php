<?php

namespace App\Models;
use App\Setting\Conexion;
use App\Setting\Encryptar;
use PDO;

class MarcasModel
{
    private $tabla = "marca_vehiculo";
    private $alias = "mv"; // Alias de la tabla referente al modelo
    private $primaryKey = "id_marca";
    private $db;
    private $OrderBy = "nombre";

    public function __construct()
    {
        $this->db = Conexion::getConexion_();
    }
/** BUSCADOR SELECT CONSULTA */
    public function getAll($search = '', $page = 1, $pageSize = 30)
    {
        $offset = ($page - 1) * $pageSize;
        $search = '%' . $search . '%';
        
        $stmt = $this->db->prepare("SELECT id_marca as id, nombre as `text` 
                                    FROM {$this->tabla} {$this->alias}
                                    WHERE `status` = 1 AND nombre LIKE :search
                                    LIMIT :offset, :pageSize");
        $stmt->bindParam(':search', $search, PDO::PARAM_STR);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindParam(':pageSize', $pageSize, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getAllList($LIMIT){
        $stmt = $this->db->prepare("SELECT id_marca as id, nombre , st.titulo 
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
    
    public function countAll($search = '')
    {
        $search = '%' . $search . '%';
        
        $stmt = $this->db->prepare("SELECT COUNT(*) as total 
                                    FROM {$this->tabla} {$this->alias}
                                    WHERE `status` = 1 AND nombre LIKE :search");
        $stmt->bindParam(':search', $search, PDO::PARAM_STR);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }
    /**FINAL  BUSCADOR SELECT CONSULTA */    

    public function getAllBusqueda(array $data,$limited)
    {
        $condicion="";
        $offset = "OFFSET 0";
        if($data["busqueda"]!=""){
            $busqueda = strtoupper($data["busqueda"]);
            $condicion = "WHERE ({$this->alias}.nombre LIKE '%" . $busqueda . "%' OR 
                                 st.titulo LIKE '" . $busqueda . "%')";
        }
        if ($data["paginacion"] != "" && $data["paginacion"] != 1) {
        $offset = "OFFSET " . abs((intval(@$data["paginacion"]) * $limited) - $limited);
        }
        $stmt = $this->db->prepare("SELECT id_marca as id, nombre, st.titulo
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
                                  st.titulo LIKE '" . $busqueda . "%')";
        }
        $stmt = $this->db->prepare("SELECT COUNT(*) AS total 
        FROM {$this->tabla} {$this->alias} 
        INNER JOIN status AS st ON st.id_status = {$this->alias}.status
        $condicion ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // Método para buscar un registro por su dui
    public function findByDui($id)
    {
        $stmt = $this->db->prepare("SELECT id_marca as nombre,st.titulo as estado
          FROM {$this->tabla} {$this->alias} 
          INNER JOIN status AS st ON st.id_status = {$this->alias}.status
        WHERE usuario = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    // Método para activar online
    public function Online($id,$online)
    {
        $stmt = $this->db->prepare("UPDATE {$this->tabla}  SET `online`=:ONLINE
        WHERE `id_user` = :ID");
        $stmt->bindParam(':ID', $id, PDO::PARAM_INT);
        $stmt->bindParam(':ONLINE', $online, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    // Método para buscar un registro por su clave primaria
    public function findById($id)
    {
        $stmt = $this->db->prepare("SELECT id_marca as id, nombre,st.titulo as estado
        FROM {$this->tabla} {$this->alias} 
        INNER JOIN status AS st ON st.id_status = {$this->alias}.status
        WHERE {$this->primaryKey} = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
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

    // Método para actualizar un registro
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

    // Método para eliminar un registro
    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM {$this->tabla} WHERE {$this->primaryKey} = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
