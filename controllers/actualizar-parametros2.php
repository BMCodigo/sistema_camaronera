<?php
error_reporting(0);
include '../models/conexion.php';
//$objeto = new corrida();
$conectar = new Conexion();
$conexion = $conectar->conectar();
$camaronera = $_POST['camaronera'];
// Habilitar visualización de errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$diff = date("Y-m-d H:i:s");  
// Incluye el autoloader generado por Composer
require __DIR__ . '/../vendor/autoload.php';

// Usar las clases de PhpOffice\PhpSpreadsheet
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Función para procesar el archivo Excel y devolver los datos en un array
function processExcelFile($filePath) {
    $spreadsheet = IOFactory::load($filePath);
    $data = [];
    foreach ($spreadsheet->getAllSheets() as $sheet) {
        $sheetData = $sheet->toArray();
        // Validar que el encabezado tenga los campos correctos
        $headers = array_map('strtolower', array_shift($sheetData));
        if ($headers === ['peso', 'bw', 'rendimiento']) {
            $data[] = $sheetData;
        } else {
            throw new Exception("El archivo no cumple con los encabezados requeridos: Peso, bw, Rendimiento.");
        }
    }
    return $data;
}

/*
select id_biotipo, fecha_registro,factor,biomasa,rendimiento,estado from datos_conversion;
select tipo, fecha_registro, estado, responsable from tipos_conversion;
*/
// Función para insertar datos en la base de datos MySQL
//reemplazar, por punto en las variables peso factor y rendimiento
function insertDataIntoDatabase($data,$fileName,$camaronera) {
     $conectar = new Conexion();
/*preg_match('/(\d+)$/', $fileName, $matches);
$filenumber = $matches;
echo $filenumber;*/

$conexion = $conectar->conectar();
$sqlis ="UPDATE datos_conversion SET estado = '0' WHERE id_biotipo= '2' AND id_camaronera='$camaronera';";
$query = mysqli_query($conexion, $sqlis);
    foreach ($data as $sheetData) {
        foreach ($sheetData as $row) {
            $peso = str_replace(['%', ','], ['', '.'], $row[0]);
            $factor = str_replace(['%', ','], ['', '.'], $row[1]);
            $rendimiento = str_replace(['%', ','], ['', '.'], $row[2]);
 $sqli ="INSERT INTO datos_conversion (id_biotipo, fecha_registro, factor,bodyweight,rendimiento,estado, id_camaronera) VALUES(2,(NOW()), '$peso', '$factor', '$rendimiento','1','$camaronera');";
$query = mysqli_query($conexion, $sqli);
        }
    }
    $currentname = $_POST['registro'];
   $sqlis ="UPDATE tipos_conversion SET tipo = '$currentname' WHERE id_tipo = 2 AND id_camaronera='$camaronera';";
$query = mysqli_query($conexion, $sqlis);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['excels']) && !empty($_FILES['excels']['name'][0])) {
        $allData = [];
        $uploadDir = __DIR__ . '/../archivos/';

        // Procesar cada archivo subido
        try {
            foreach ($_FILES['excels']['tmp_name'] as $key => $tmpName) {
                $fileName = basename($_FILES['excels']['name'][$key]);
                $fileTmpPath = $tmpName;
                $filePath = $uploadDir . $fileName;
                
                // Mover el archivo subido a la carpeta de destino
                if (move_uploaded_file($fileTmpPath, $filePath)) {
                    $fileData = processExcelFile($filePath);
                    $allData[] = [
                        'file_name' => $fileName,
                        'data' => $fileData
                    ];
                    
                    // Insertar datos en la base de datos
                    insertDataIntoDatabase($fileData,$fileName,$camaronera);
                } else {
                    echo "Error al subir $fileName.";
                }
            }

            // Crear una nueva hoja de cálculo con los datos procesados
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            // Ejemplo de cómo insertar los datos en la hoja de cálculo
            $rowNumber = 1;
            foreach ($allData as $file) {
                $sheet->setCellValue('A' . $rowNumber, 'Data from ' . $file['file_name']);
                $rowNumber++;
                foreach ($file['data'] as $sheetData) {
                    foreach ($sheetData as $row) {
                        $columnNumber = 'A';
                        foreach ($row as $cell) {
                            $sheet->setCellValue($columnNumber . $rowNumber, $cell);
                            $columnNumber++;
                        }
                        $rowNumber++;
                    }
                }
                $rowNumber++;
            }
            
            // Guardar la nueva hoja de cálculo en un archivo
            $archivoXLS = $uploadDir . 'file2-'. $diff . '.xlsx'; 
            $writer = new Xlsx($spreadsheet);
            $writer->save($archivoXLS);
           ?>

    <script>
       alert(" Datos guardados! ", );
       window.location.href="../views/index.php?page=parametrosbio";
    </script>

<?php
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        } finally {
            
        }
    } else {
        echo "No se guardaron los registros.";
    }
}
?>
