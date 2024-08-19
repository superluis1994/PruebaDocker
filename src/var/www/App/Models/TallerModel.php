<?php

namespace App\Models;

use App\Setting\Conexion;
use App\Setting\Encryptar;
use PDO;

class TallerModel
{
    private $tabla = "datos_taller";
    private $alias = "dtt"; // Alias de la tabla referente al modelo
    private $primaryKey = "id_sucursal";
    private $db;
    private $fecha;
    private $OrderBy = "id_sucursal";

    public function __construct()
    {

        date_default_timezone_set('America/El_Salvador');
        $this->fecha = date('Y-m-d');
        $this->db = Conexion::getConexion_();
    }

    public function getAll($limited)
    {
        $stmt = $this->db->prepare("SELECT cl.id_cliente as id, cl.nombre, cl.telefono, cl.apellidos, cl.fecha_registro
        FROM {$this->tabla} {$this->alias}
        ORDER BY {$this->OrderBy} ASC LIMIT $limited");
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
    
    
    // Método para buscar un registro por su clave primaria
    public function findById($id)
    {
        $stmt = $this->db->prepare("SELECT *
        FROM {$this->tabla} {$this->alias} 
        WHERE {$this->primaryKey} = :ID");
        $stmt->bindParam(':ID', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }









    public function getAllBusqueda(array $data,$limited)
    {
        $condicion="";
        $offset = "OFFSET 0";
        if($data["busqueda"]!=""){
            $busqueda = strtoupper($data["busqueda"]);
            $condicion = "WHERE ({$this->alias}.nombre LIKE '%" . $busqueda . "%' OR 
                                 {$this->alias}.apellidos LIKE '%" . $busqueda . "%' OR 
                                 {$this->alias}.telefono LIKE '%" . $busqueda . "%' OR 
                                 {$this->alias}.fecha_registro LIKE '%" . $busqueda . "%')";
        }
        if ($data["paginacion"] != "" && $data["paginacion"] != 1) {
        $offset = "OFFSET " . abs((intval(@$data["paginacion"]) * $limited) - $limited);
        }
        $stmt = $this->db->prepare("SELECT cl.id_cliente AS id, cl.nombre, cl.apellidos, cl.telefono,  cl.fecha_registro
        FROM {$this->tabla} {$this->alias} $condicion
        ORDER BY {$this->alias}.{$this->OrderBy} ASC LIMIT $limited $offset");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        // return $stmt;
    }
    public function getAllCountBusqueda(array $data)
    {
        $condicion="";
        if($data["busqueda"]!=""){
               $condicion = "WHERE ({$this->alias}.nombre LIKE '%" . $data["busqueda"] 
               ."%' OR {$this->alias}.apellidos LIKE '%" . $data["busqueda"] . "%' OR {$this->alias}.telefono LIKE '%" 
                .$data["busqueda"] . "%' OR {$this->alias}.fecha_registro LIKE '%" .$data["busqueda"] . "%')";
        }
        $stmt = $this->db->prepare("SELECT COUNT(*) AS total 
        FROM {$this->tabla} {$this->alias} $condicion ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
/** BUSCADOR SELECT CONSULTA */
public function getAllSelect($search = '', $page = 1, $pageSize = 30)
{
    $offset = ($page - 1) * $pageSize;
    $search = '%' . $search . '%';
    
    $stmt = $this->db->prepare("SELECT id_cliente AS id, CONCAT(nombre, ' ', apellidos) AS `text` 
                                FROM {$this->tabla} {$this->alias}
                                WHERE  nombre LIKE :search OR  apellidos LIKE :search
                                LIMIT :offset, :pageSize");
    $stmt->bindParam(':search', $search, PDO::PARAM_STR);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->bindParam(':pageSize', $pageSize, PDO::PARAM_INT);
    $stmt->execute();
    
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function countAll($search = '')
{
    $search = '%' . $search . '%';
    
    $stmt = $this->db->prepare("SELECT COUNT(*) as total 
                                FROM {$this->tabla} {$this->alias}
                                WHERE  nombre LIKE :search OR  apellidos LIKE :search ");
    $stmt->bindParam(':search', $search, PDO::PARAM_STR);
    $stmt->execute();
    
    return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
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
