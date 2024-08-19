<?php
namespace App\Setting;

// class AntiInyeciones
// {

//     public static function LimpiarForm($Post,$tipos){
//         $datosCombinados = [];
//         foreach ($Post as $clave => $valor) {
//             $datosCombinados[$clave] = [
//                 'value' => $valor,
//                 'type' => $tipos[$clave] ?? 'string' // Suponer string por defecto
//             ];
//         }
        
//         return self::cleanDataArray($datosCombinados);
//     }
//     // Limpiar datos de entrada genéricos
//     public static function cleanInput($data)
//     {
//         $data = trim($data); // Elimina espacios en blanco del inicio y el final
//         $data = stripslashes($data); // Elimina las barras invertidas
//         $data = htmlspecialchars($data); // Convierte caracteres especiales en entidades HTML
//         return $data;
//     }


//     // Limpiar arrays de datos, como $_POST o $_GET
//     // public static function cleanArray($dataArray)
//     // {
//     //     $cleanData = [];
//     //     foreach ($dataArray as $key => $value) {
//     //         // Limpia cada valor del array utilizando cleanInput
//     //         $cleanData[$key] = self::cleanInput($value);
//     //     }
//     //     return $cleanData;
//     // }
//     public static function cleanDataArray($dataSpecs)
//     {
//         $cleanData = [];
//         foreach ($dataSpecs as $key => $specs) {
//             // Comprobar si el valor existe y obtenerlo
//             $value = $specs['value'] ?? null;
//             // Decidir el método de limpieza basado en el tipo especificado
//             switch ($specs['type']) {
//                 case 'decimal':
//                     $cleanData[$key] = self::cleanDecimal($value);
//                     break;
//                 case 'int':
//                     $cleanData[$key] = self::cleanInt($value);
//                     break;
//                 case 'string':
//                     $cleanData[$key] = self::cleanString($value);
//                     break;
//                 case 'email':
//                     $cleanData[$key] = self::cleanEmail($value);
//                     break;
//                 default:
//                     // Si no se especifica un tipo o el tipo no es reconocido, usar limpieza genérica
//                     $cleanData[$key] = self::cleanInput($value);
//                     break;
//             }
//         }
//         return $cleanData;
//     }

//     // Método específico para limpiar números enteros
//     public static function cleanInt($data)
//     {
//         $data = trim($data); 
//         $data = htmlspecialchars($data);
//         return filter_var($data, FILTER_SANITIZE_NUMBER_INT);
//     }
//     public static function cleanDecimal($value) {
//         // FILTER_SANITIZE_NUMBER_FLOAT eliminará todos los caracteres excepto dígitos, un signo menos y un punto decimal.
//         // FILTER_FLAG_ALLOW_FRACTION permitirá que el punto decimal pase a través de la limpieza.
//         return filter_var($value, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
//     }
    

//     // Método específico para limpiar cadenas (strings)
//     public static function cleanString($data)
//     {
//         $data = trim($data);
//          $data = htmlspecialchars($data); 
//         return filter_var($data, FILTER_SANITIZE_STRING);
//     }

//     // Método específico para limpiar correos electrónicos
//     public static function cleanEmail($data)
//     {
//         $data = trim($data);
//          $data = htmlspecialchars($data); 
//         return filter_var($data, FILTER_SANITIZE_EMAIL);
//     }
// }

// Uso de la clase
// $cleanData = DataSanitizer::cleanInput($_POST['data']);
// $cleanArray = DataSanitizer::cleanArray($_POST);
// $cleanInt = DataSanitizer::cleanInt($_POST['number']);
// $cleanString = DataSanitizer::cleanString($_POST['text']);
// $cleanEmail = DataSanitizer::cleanEmail($_POST['email']);


class AntiInyeciones
{
    public static function LimpiarForm($Post, $tipos){
        $datosCombinados = [];
        foreach ($Post as $clave => $valor) {
            $datosCombinados[$clave] = [
                'value' => $valor,
                'type' => $tipos[$clave] ?? 'string' // Suponer string por defecto
            ];
        }
        
        return self::cleanDataArray($datosCombinados);
    }

    // Limpiar datos de entrada genéricos
    public static function cleanInput($data)
    {
        if (is_array($data)) {
            return array_map('self::cleanInput', $data);
        }

        $data = trim($data); // Elimina espacios en blanco del inicio y el final
        $data = stripslashes($data); // Elimina las barras invertidas
        $data = htmlspecialchars($data); // Convierte caracteres especiales en entidades HTML
        return $data;
    }

    public static function cleanDataArray($dataSpecs)
    {
        $cleanData = [];
        foreach ($dataSpecs as $key => $specs) {
            $value = $specs['value'] ?? null;

            if (is_array($value)) {
                $cleanData[$key] = array_map([self::class, 'clean' . ucfirst($specs['type'])], $value);
            } else {
                $cleanData[$key] = self::cleanInput($value);
            }
        }
        return $cleanData;
    }

    // Métodos específicos para limpiar datos
    public static function cleanInt($data)
    {
        $data = self::cleanInput($data);
        return filter_var($data, FILTER_SANITIZE_NUMBER_INT);
    }

    public static function cleanDecimal($data)
    {
        $data = self::cleanInput($data);
        return filter_var($data, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    }

    public static function cleanString($data)
    {
        $data = self::cleanInput($data);
        return filter_var($data, FILTER_SANITIZE_STRING);
    }

    public static function cleanEmail($data)
    {
        $data = self::cleanInput($data);
        return filter_var($data, FILTER_SANITIZE_EMAIL);
    }
}
