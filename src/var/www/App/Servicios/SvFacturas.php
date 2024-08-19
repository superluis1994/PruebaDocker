<?php

namespace App\Servicios;

use Dompdf\Dompdf;
use Core\Utils;

class SvFacturas
{
    private $dompdf;

    // Constructor de la clase
    private $Url;
    public function __construct()
    {
        $this->Url = new Utils();
        $this->dompdf = new Dompdf();
    }

    // Método para generar la factura en PDF
    public function generarPDF($datosCliente,$datosTaller, $productos, $total)
    {
        $html = $this->crearHTML($datosCliente, $datosTaller, $productos, $total);
        $this->dompdf->loadHtml($html);
        $this->dompdf->setPaper('A4', 'portrait');
        $this->dompdf->render();
        $this->dompdf->stream("factura.pdf", array("Attachment" => false));
    }

    private function crearHTML($datosCliente,$datosTaller, $productos, $total)
    {
        //  
        $path = $_SERVER['DOCUMENT_ROOT'] . $this->Url->assets('Img/Logopwa.jpg');
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

        $bootstrapCss = file_get_contents('Resources/Assets/Css/pdf.css');
        $html = "<style>{$bootstrapCss}</style>";
        $html .= '<div class="container mt-2">';
        $html .= '<div class="header d-flex justify-content-between align-items-center">'; // Contenedor Flexbox para el logo y el título
        $html .= '<div>'; // Contenedor para los detalles del taller
        $html .= '<h1>Factura</h1>';
        $html .= '</div>';
        $html .= "<img src='{$base64}' class='logo' alt='Logo Empresa' style='max-height: 100px;'>"; // Logo del taller a la derecha
        $html .= '</div>';
        $html .= '<hr class="custom-hr">';
        
        // Contenedor para los detalles del taller y del cliente
        $html .= '<div class="row float-container mt-3">';
        $html .= '<div class="col-md-6 float-item">'; // Columna izquierda: Detalles del Taller
        $html .= '<h2>Detalles del Taller</h2>';
        $html .= "<p><strong>Nombre del Taller:</strong> {$datosTaller['nombre']}<br>";
        $html .= "<strong>Dirección:</strong> {$datosTaller['direccion']}<br>";
        $html .= "<strong>Teléfono:</strong> {$datosTaller['telefono']}<br>";
        $html .= "<strong>Correo:</strong> {$datosTaller['correo']}</p>";
        $html .= '</div>';
        
        $html .= '<div class="col-md-6 float-item">'; // Columna derecha: Datos del Cliente
        $html .= '<h2>Datos del Cliente</h2>';
        $html .= "<p><strong>Nombre:</strong> {$datosCliente['nombre']} {$datosCliente['apellidos']}<br>";
        $html .= "<strong>Dirección:</strong> {$datosCliente['direccion']}<br>";
        $html .= "<strong>Teléfono:</strong> {$datosCliente['telefono']}</p>";
        $html .= '</div>';
        $html .= '</div>'; // Fin del contenedor row
        
        
        // Detalles de los servicios
        $html .= '<table class="table table-striped">';
        $html .= '<h2>Detalles de los Servicios</h2>';
        $html .= '<thead>';
        $html .= '<tr>';
        $html .= '<th scope="col">Servicios Realizados</th>';
        $html .= '<th scope="col">Precio</th>';
        $html .= '<th scope="col">Cantidad</th>';
        $html .= '<th scope="col">Total</th>';
        $html .= '</tr>';
        $html .= '</thead>';
        $html .= '<tbody>';
        foreach ($productos as $producto) {
            $html .= "<tr>";
            $html .= "<td>{$producto['nombre']}</td>";
            $html .= "<td>\${$producto['precio']}</td>";
            $html .= "<td>{$producto['cantidad']}</td>";
            $html .= "<td>\${$producto['total']}</td>";
            $html .= "</tr>";
        }
        $html .= '</tbody>';
        $html .= '</table>';
        $html .= "<h3 class='text-end mt-4'>Total a Pagar: \${$total}</h3>";
        $html .= '</div>'; // Fin del contenedor
        
        return $html;
        
        
        
    }
}
