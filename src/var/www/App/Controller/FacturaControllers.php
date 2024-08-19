<?php

namespace App\Controller;

use Core\Utils;
use App\Models\ServicioModel;
use App\Models\ClienteModel;
use App\Models\TalentoModel;
use App\Models\FacturaModel;
use App\Models\TallerModel;
use App\Setting\Encryptar;
use App\Setting\SessionManager;
use App\Setting\AntiInyeciones;
use App\Setting\AuthValidar;
use TCPDF;
use App\Servicios\SvFacturas;



class FacturaControllers
{
    private $header = [];
    private ServicioModel $ServicioModel;
    private FacturaModel $FacturaModel;
    private ClienteModel $ClienteModel;
    private TallerModel $TallerModel;
    private Encryptar $Encrypto;
    private AntiInyeciones $inyecciones;


    public function __construct()
    {

        $this->header[1] = "Auth";
        $this->ServicioModel = new ServicioModel();
        $this->ClienteModel = new ClienteModel();
        $this->TallerModel = new TallerModel();
        $this->FacturaModel = new FacturaModel();
        $this->Encrypto = new Encryptar($_ENV["JWT_SECRET_KEY"]);
        $this->inyecciones = new AntiInyeciones;
        // echo  var_dump($_SESSION["datos"]);

    }
    public function home()
    {
        // session_destroy();


        if (!SessionManager::isUserLoggedIn()) {
            header('Location:' . Utils::url("/Auth"));
            exit;
        }



        $data = [
            "status" => "success",
            "icono" => Utils::assets('Img/panel/cpanel.svg'),
            "titulo" => "PANEL | Home",
            "posicion" => "HOME",
            "url" => [
                "regitroEntrada" => Utils::url('/panel/entrada/add'),
                "selectVehiculo" => Utils::url('/panel/vehiculo/list'),
                "select" => Utils::url('/panel/marcas/list'),

            ]
        ];
        $header = $this->header[1] = "IEPP | PANEL";
        return Utils::viewPanel("Panel.{$_SESSION['datos']['tipo']}.home", $data, $this->header);
    }


    // public function Registrar_factura()
    // {
    //    $response = [
    //       "status"=>"error",
    //       'titulo' => 'Factura no Generadad',
    //       'msg' => 'Se presentaron errores con los datos',
    //       'url' => "",
    //    ];
    //    // Recibir los datos del formulario
    //    $servicios = $_POST['servicios']; // Array de IDs de servicios
    //    $precios = $_POST['precios']; // Array de precios ingresados
    //    $cantidades = $_POST['cantidades']; // Array de cantidades ingresadas

    //    // Definir los tipos de datos esperados para cada campo del formulario
    //    $tipos = [
    //       'servicios' => 'int', // Suponiendo que los IDs de servicios son enteros
    //       'precios' => 'decimal', // Los precios son números decimales
    //       'cantidades' => 'int', // Las cantidades son enteros
    //       'cliente' => 'string', // El nombre del cliente es una cadena
    //       'vehiculo' => 'string' // La descripción del vehículo es una cadena
    //    ];

    //    // Limpiar los datos del formulario usando la clase AntiInyeciones
    //    $limpios = AntiInyeciones::LimpiarForm($_POST, $tipos);

    //    // Inicializar las variables con los datos limpios
    //    $servicios = $limpios['servicios'];
    //    $precios = $limpios['precios'];
    //    $cantidades = $limpios['cantidades'];

    //    $totalServicio = 0;

    //    $ArrayData["datos"] = [
    //       "cliente" => $limpios["cliente"],
    //       "vehiculo" => $limpios["vehiculo"],
    //    ];

    //    // Inicializar el array de servicios
    //    $ArrayData["servicios"] = [];

    //    foreach ($servicios as $index => $servicioId) {
    //       $precio = floatval($precios[$index]);
    //       $cantidad = intval($cantidades[$index]);
    //       $subTotal = $precio * $cantidad;
    //       $totalServicio += $subTotal;

    //       // Agregar cada servicio como un elemento del array de servicios
    //       $ArrayData["servicios"][] = [
    //          "servicio" => $servicioId,
    //          "precio" => $precio,
    //          "cantidad" => $cantidad,
    //          "subTotal" => $subTotal
    //       ];
    //    }

    //    $ArrayData["total"] = [
    //       "total" => $totalServicio,
    //    ];
    //    $resp=$this->FacturaModel->factura_add($ArrayData);
    //    if($resp){
    //       $response = [
    //          "status"=>"success",
    //          'titulo' => 'Factura Generadad',
    //          'msg' => 'Puede descargar su factura',
    //          'url' => "",
    //       ];
    //    }
    //    header('Content-Type: application/json');
    //    //  echo json_encode($_POST['servicios']);
    //    echo json_encode($response);
    //    exit();
    // }

    public function Registrar_factura()
    {
        $response = [
            "status" => "error",
            'titulo' => 'Factura no Generada',
            'msg' => 'Se presentaron errores con los datos',
            'url' => "",
        ];

        // Recibir los datos del formulario
        @$servicios = $_POST['servicios']; // Array de IDs de servicios
        @$precios = $_POST['precios']; // Array de precios ingresados
        @$cantidades = $_POST['cantidades']; // Array de cantidades ingresadas
        @$observaciones = $_POST['observaciones']; // Array de observaciones ingresadas

        // Definir los tipos de datos esperados para cada campo del formulario
        $tipos = [
            'servicios' => 'int', // Suponiendo que los IDs de servicios son enteros
            'precios' => 'decimal', // Los precios son números decimales
            'cantidades' => 'int', // Las cantidades son enteros
            'cliente' => 'string', // El nombre del cliente es una cadena
            'vehiculo' => 'string', // La descripción del vehículo es una cadena
            'observaciones' => 'string' // Observaciones es una cadena
        ];

        // Limpiar los datos del formulario usando la clase AntiInyeciones
        $limpios = AntiInyeciones::LimpiarForm($_POST, $tipos);

        // Inicializar las variables con los datos limpios
        @$servicios = $limpios['servicios'];
        @$precios = $limpios['precios'];
        @$cantidades = $limpios['cantidades'];
        @$observaciones = $limpios['observaciones'];

        $totalServicio = 0;

        $ArrayData["datos"] = [
            "cliente" => @$limpios["cliente"],
            "vehiculo" => @$limpios["vehiculo"],
        ];

        // Inicializar el array de servicios
        $ArrayData["servicios"] = [];

        foreach ($servicios as $index => $servicioId) {
            $precio = floatval($precios[$index]);
            $cantidad = intval($cantidades[$index]);
            $subTotal = $precio * $cantidad;
            $totalServicio += $subTotal;

            // Agregar cada servicio como un elemento del array de servicios
            $ArrayData["servicios"][] = [
                "servicio" => $servicioId,
                "precio" => $precio,
                "cantidad" => $cantidad,
                "subTotal" => $subTotal,
                "observaciones" => $observaciones[$index] ?? '' // Asigna observaciones si existe, de lo contrario vacío
            ];
        }

        $ArrayData["total"] = [
            "total" => $totalServicio,
        ];

        // Llamar al modelo para insertar la factura
        $resp = $this->FacturaModel->factura_add($ArrayData);
        if ($resp) {
            $response = [
                "status" => "success",
                'titulo' => 'Factura Generada',
                'msg' => 'Puede descargar su factura',
                'url' => "", // Aquí puedes poner la URL para descargar la factura si es necesario
            ];
        }

        // Enviar la respuesta como JSON
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }



    public function pdf($id)
    {
        // $Pdf = new SvFacturas();
        $dato = $this->Encrypto->decryptItem($id);
        $dataCliente = $this->ClienteModel->findById($dato);
        // $dataTaller = 


        if (empty($dataCliente)) {
            $response = [
                "status" => "error",
                'titulo' => 'link incorrecto',
                'msg' => 'no se puede generar su factura',
            ];
            echo json_encode($response);

            exit();
        }
        $dataTaller = $this->TallerModel->findById(1);
        $svFactura = new SvFacturas();

        $productos = [
            ['nombre' => 'Producto A', 'precio' => 10, 'cantidad' => 2, 'total' => 20],
            ['nombre' => 'Producto B', 'precio' => 5, 'cantidad' => 3, 'total' => 15],
            ['nombre' => 'Producto C', 'precio' => 8, 'cantidad' => 1, 'total' => 8],
            ['nombre' => 'Producto D', 'precio' => 12, 'cantidad' => 4, 'total' => 48],
            ['nombre' => 'Producto E', 'precio' => 7, 'cantidad' => 5, 'total' => 35],
            ['nombre' => 'Producto F', 'precio' => 15, 'cantidad' => 2, 'total' => 30],
            ['nombre' => 'Producto G', 'precio' => 20, 'cantidad' => 1, 'total' => 20],
            ['nombre' => 'Producto H', 'precio' => 3, 'cantidad' => 10, 'total' => 30],
            ['nombre' => 'Producto I', 'precio' => 6, 'cantidad' => 2, 'total' => 12],
            ['nombre' => 'Producto J', 'precio' => 18, 'cantidad' => 3, 'total' => 54],
            ['nombre' => 'Producto K', 'precio' => 25, 'cantidad' => 1, 'total' => 25],
            ['nombre' => 'Producto L', 'precio' => 9, 'cantidad' => 4, 'total' => 36]
        ];


        $total = 400;

        $svFactura->generarPDF($dataCliente, $dataTaller, $productos, $total);
    }
    // public function pdf(){

    //     function generarPDF($data) {
    //         // Crear nuevo documento PDF
    //         $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    //         // Configuraciones del documento
    //         $pdf->SetCreator(PDF_CREATOR);
    //         $pdf->SetAuthor('Tu Empresa');
    //         $pdf->SetTitle('Factura');
    //         $pdf->SetSubject('Factura');
    //         $pdf->SetKeywords('TCPDF, PDF, factura');

    //         // Añadir una página
    //         $pdf->AddPage();

    //         // Logo
    //         if (isset($data['empresa']['logo'])) {
    //             $pdf->Image($data['empresa']['logo'], 10, 10, 40, '', '', '', '', false, 300, '', false, false, 0, false, false, false);
    //         }

    //         // Datos de la empresa
    //         $pdf->SetFont('helvetica', '', 10);
    //         $pdf->SetXY(50, 10);
    //         $empresa_info = "{$data['empresa']['nombre']}\n" .
    //                         "NIF: {$data['empresa']['nif']}\n" .
    //                         "{$data['empresa']['direccion']}\n" .
    //                         "{$data['empresa']['ciudad']}, {$data['empresa']['pais']}\n" .
    //                         "Telf: {$data['empresa']['telefono']}\n" .
    //                         "{$data['empresa']['email']}";
    //         $pdf->MultiCell(100, 5, $empresa_info, 0, 'L');

    //         // Datos del cliente
    //         $cliente_info = "{$data['cliente']['nombre']}\n" .
    //                         "NIF: {$data['cliente']['nif']}\n" .
    //                         "{$data['cliente']['direccion']}\n" .
    //                         "{$data['cliente']['ciudad']}, {$data['cliente']['pais']}\n" .
    //                         "Telf: {$data['cliente']['telefono']}";
    //         $pdf->SetXY(150, 10);
    //         $pdf->MultiCell(100, 5, $cliente_info, 0, 'L');

    //         // Número y fecha de factura
    //         $pdf->SetXY(150, 30);
    //         $pdf->MultiCell(50, 5, "Número de factura: {$data['factura']['numero']}\nFecha factura: {$data['factura']['fecha']}", 0, 'R');

    //         // Línea debajo de los datos
    //         $pdf->Line(10, 50, 200, 50); // Coordenadas de la línea

    //         // Espacio
    //         $pdf->Ln(40);

    //         // Título "FACTURA"
    //         $pdf->SetFont('helvetica', 'B', 20);
    //         $pdf->Cell(0, 10, 'FACTURA', 0, 1, 'L');

    //         // Espacio
    //         $pdf->Ln(5);

    //         // Tabla de servicios
    //         $pdf->SetFont('helvetica', 'B', 10);
    //         $pdf->SetFillColor(240, 240, 240);
    //         $pdf->Cell(90, 7, 'Concepto', 1, 0, 'L', 1);
    //         $pdf->Cell(20, 7, 'Cantidad', 1, 0, 'C', 1);
    //         $pdf->Cell(30, 7, 'Base imp.', 1, 0, 'R', 1);
    //         $pdf->Cell(30, 7, 'I.V.A.', 1, 1, 'R', 1);

    //         $pdf->SetFont('helvetica', '', 10);
    //         foreach ($data['servicios'] as $servicio) {
    //             $pdf->MultiCell(90, 7, $servicio['descripcion'], 1, 'L');
    //             $pdf->SetXY($pdf->GetX() + 90, $pdf->GetY() - 7);
    //             $pdf->Cell(20, 7, $servicio['cantidad'], 1, 0, 'C');
    //             $pdf->Cell(30, 7, '$' . number_format($servicio['base'], 2), 1, 0, 'R');
    //             $pdf->Cell(30, 7, "{$servicio['iva']}% ({$servicio['iva_valor']})", 1, 1, 'R');
    //         }

    //         // Totales
    //         $pdf->SetFont('helvetica', 'B', 10);
    //         $pdf->Cell(140, 7, 'Total Base Imponible:', 0, 0, 'R');
    //         $pdf->Cell(30, 7, '$' . number_format($data['totales']['base_imponible'], 2), 1, 1, 'R');

    //         $pdf->Cell(140, 7, 'Total I.V.A.:', 0, 0, 'R');
    //         $pdf->Cell(30, 7, '$' . number_format($data['totales']['iva'], 2), 1, 1, 'R');

    //         $pdf->SetFont('helvetica', 'B', 14);
    //         $pdf->Cell(140, 7, 'TOTAL:', 0, 0, 'R');
    //         $pdf->Cell(30, 7, '$' . number_format($data['totales']['total'], 2), 1, 1, 'R');

    //         // Información adicional
    //         $pdf->Ln(10);
    //         $pdf->SetFont('helvetica', 'B', 10);
    //         $pdf->Cell(0, 10, 'Información:', 0, 1, 'L');
    //         $pdf->SetFont('helvetica', '', 10);
    //         $pdf->MultiCell(0, 0, $data['informacion_adicional'], 0, 'L');

    //         // Cerrar y devolver el documento
    //         $pdf->Output('factura.pdf', 'I');
    //     }


    //     $data = [
    //         'empresa' => [
    //             'logo' => Utils::assets('Img/Logopwa.png'),
    //             'nombre' => 'Tu Empresa',
    //             'nif' => '12345678Z',
    //             'direccion' => 'Calle Falsa 123',
    //             'ciudad' => 'Madrid',
    //             'pais' => 'España',
    //             'telefono' => '123456789',
    //             'email' => 'empresa@correo.com'
    //         ],
    //         'cliente' => [
    //             'nombre' => 'Juan Pérez',
    //             'nif' => '87654321X',
    //             'direccion' => 'Otra Calle 456',
    //             'ciudad' => 'Barcelona',
    //             'pais' => 'España',
    //             'telefono' => '987654321'
    //         ],
    //         'factura' => [
    //             'numero' => '2024-001',
    //             'fecha' => '01/08/2024'
    //         ],
    //         'servicios' => [
    //             [
    //                 'descripcion' => 'Cambio de aceite',
    //                 'cantidad' => 1,
    //                 'base' => 50.00,
    //                 'iva' => 21,
    //                 'iva_valor' => 10.50
    //             ],
    //             [
    //                 'descripcion' => 'Lavado de coche',
    //                 'cantidad' => 1,
    //                 'base' => 30.00,
    //                 'iva' => 21,
    //                 'iva_valor' => 6.30
    //             ]
    //         ],
    //         'totales' => [
    //             'base_imponible' => 80.00,
    //             'iva' => 16.80,
    //             'total' => 96.80
    //         ],
    //         'informacion_adicional' => 'Gracias por su compra. Por favor, conserve esta factura como comprobante de su transacción.'
    //     ];





    //     // // Ejemplo de datos de entrada
    //     // $data = [
    //     //     "datos" => [
    //     //         "cliente" => "Juan Perez",
    //     //         "vehiculo" => "Toyota Corolla"
    //     //     ],
    //     //     "servicios" => [
    //     //         [
    //     //             "servicio" => "Cambio detttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttt aceite rrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrr",
    //     //             "precio" => 50,
    //     //             "cantidad" => 1,
    //     //             "subTotal" => 50
    //     //         ],
    //     //         [
    //     //             "servicio" => "Lavado",
    //     //             "precio" => 25,
    //     //             "cantidad" => 2,
    //     //             "subTotal" => 50
    //     //         ]
    //     //     ],
    //     //     "total" => [
    //     //         "total" => 100
    //     //     ]
    //     // ];

    //     // Llamar a la función para generar el PDF
    //     generarPDF($data);

    //         }


    /**SE ENCARGA DE CARGAR LOS DATOS */
    public function loadMsg() {}
    /**SE ENCARGA DE GESTIONAR CONSULTAS FETCH */
    public function questionMsg() {}
}
