<?php

namespace App\Models;
use App\Setting\Conexion;
use App\Setting\Encryptar;
use PDO;

class FacturaModel
{
    private $tabla = "facturas";
    private $alias = "f"; // Alias de la tabla referente al modelo
    private $primaryKey = "id_factura";
    private $db;

    public function __construct()
    {
        $this->db = Conexion::getConexion_();
    }
    // public function factura_add(array $data){
    //     $stmt = $this->db->prepare("INSERT INTO {$this->tabla}(`id_factura`, `id_cliente`, `fecha_emision`, `total`, `estado`) 
    //                                VALUES () ");
    //     $stmt->bindParam(':ID', $id_cliente, PDO::PARAM_INT);
    //     $stmt->execute();
        
    //     return $stmt->fetchAll(PDO::FETCH_ASSOC);
    // }

    public function factura_add(array $data) {
        try {
            // Iniciar una transacción
            $this->db->beginTransaction();
    
            // Insertar en la tabla de facturas
            $stmtFactura = $this->db->prepare("INSERT INTO facturas (id_cliente, total, fecha_emision, estado) 
                                               VALUES (:id_cliente, :total, NOW(), :estado)");
            $stmtFactura->bindParam(':id_cliente', $data['datos']['cliente'], PDO::PARAM_INT);
            $stmtFactura->bindParam(':total', $data['total']['total'], PDO::PARAM_STR);
            $estado = 'pendiente';
            $stmtFactura->bindParam(':estado', $estado, PDO::PARAM_STR);
            $stmtFactura->execute();
    
            // Verificar si la inserción en la tabla de facturas fue exitosa
            if ($stmtFactura->rowCount() == 0) {
                throw new Exception("Error al insertar la factura.");
            }
    
            // Obtener el ID de la factura insertada
            $id_factura = $this->db->lastInsertId();
    
            // Preparar la sentencia para insertar en detalle_factura
            $stmtDetalle = $this->db->prepare("INSERT INTO detalle_factura (id_factura, tipo, id_item, cantidad, precio_unitario, observaciones)
                                               VALUES (:id_factura, :tipo, :id_item, :cantidad, :precio_unitario, :observaciones)");
    
            // Insertar cada detalle de servicio
            foreach ($data['servicios'] as $detalle) {
                $stmtDetalle->bindParam(':id_factura', $id_factura, PDO::PARAM_INT);
                $stmtDetalle->bindParam(':tipo', $detalle['servicio'], PDO::PARAM_STR); // Suponiendo que 'tipo' es equivalente a 'servicio'
                $stmtDetalle->bindParam(':id_item', $detalle['servicio'], PDO::PARAM_INT);
                $stmtDetalle->bindParam(':cantidad', $detalle['cantidad'], PDO::PARAM_INT);
                $stmtDetalle->bindParam(':precio_unitario', $detalle['precio'], PDO::PARAM_STR);
                $stmtDetalle->bindParam(':observaciones', $detalle['observaciones'], PDO::PARAM_STR); // Agregar observaciones
    
                $stmtDetalle->execute();
    
                // Verificar si la inserción en detalle_factura fue exitosa
                if ($stmtDetalle->rowCount() == 0) {
                    throw new Exception("Error al insertar el detalle de la factura.");
                }
            }
    
            // Confirmar la transacción
            $this->db->commit();
            return true;
    
        } catch (Exception $e) {
            // En caso de error, revertir la transacción
            $this->db->rollBack();
            throw $e; // Relanzar la excepción para manejar el error externamente
        }
    }
    

    // public function factura_add(array $data) {
    //     try {
    //         // Iniciar una transacción
    //         $this->db->beginTransaction();
    
    //         // Insertar en la tabla de facturas
    //         $stmtFactura = $this->db->prepare("INSERT INTO facturas (id_cliente, total, fecha_emision, estado) 
    //                                            VALUES (:id_cliente, :total, NOW(), :estado)");
    //         $stmtFactura->bindParam(':id_cliente', $data['datos']['cliente'], PDO::PARAM_INT);
    //         $stmtFactura->bindParam(':total', $data['total']['total'], PDO::PARAM_STR);
    //         $estado = 'pendiente';
    //         $stmtFactura->bindParam(':estado', $estado, PDO::PARAM_STR);
    //         $stmtFactura->execute();
    
    //         // Verificar si la inserción en la tabla de facturas fue exitosa
    //         if ($stmtFactura->rowCount() == 0) {
    //             throw new Exception("Error al insertar la factura.");
    //         }
    
    //         // Obtener el ID de la factura insertada
    //         $id_factura = $this->db->lastInsertId();
    
    //         // Preparar la sentencia para insertar en detalle_factura
    //         $stmtDetalle = $this->db->prepare("INSERT INTO detalle_factura (id_factura, tipo, id_item, cantidad, precio_unitario)
    //                                            VALUES (:id_factura, :tipo, :id_item, :cantidad, :precio_unitario)");
    
    //         // Insertar cada detalle de servicio
    //         foreach ($data['servicios'] as $detalle) {
    //             $stmtDetalle->bindParam(':id_factura', $id_factura, PDO::PARAM_INT);
    //             $stmtDetalle->bindParam(':tipo', $detalle['servicio'], PDO::PARAM_STR); // Asumiendo que 'tipo' es equivalente a 'servicio'
    //             $stmtDetalle->bindParam(':id_item', $detalle['servicio'], PDO::PARAM_INT); // Asumiendo que 'id_item' es equivalente a 'servicio'
    //             $stmtDetalle->bindParam(':cantidad', $detalle['cantidad'], PDO::PARAM_INT);
    //             $stmtDetalle->bindParam(':precio_unitario', $detalle['precio'], PDO::PARAM_STR);
    //             $stmtDetalle->execute();
    
    //             // Verificar si la inserción en detalle_factura fue exitosa
    //             if ($stmtDetalle->rowCount() == 0) {
    //                 throw new Exception("Error al insertar el detalle de la factura.");
    //             }
    //         }
    
    //         // Confirmar la transacción
    //         $this->db->commit();
    //         return true;
    
    //     } catch (Exception $e) {
    //         // En caso de error, revertir la transacción
    //         $this->db->rollBack();
    //         throw $e; // Relanzar la excepción para manejar el error externamente
    //     }
    // }
    
    
    

    
}
