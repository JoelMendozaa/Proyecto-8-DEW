<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST, GET");
    header("Access-Control-Allow-Headers: Content-Type");


    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Recibir los datos JSON
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
    
        // Verificar si el JSON es válido
        if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
            echo json_encode([
                "error" => "Error al decodificar JSON: " . json_last_error_msg()
            ]);
            exit;
        }
    
        // Definir la ruta al archivo donde se van a guardar los datos
        $file = __DIR__ . '/usuarioPOST.json';  // Ruta completa del archivo
    
        // Intentar guardar los datos en el archivo JSON
        $result = file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));
    
        if ($result === false) {
            echo json_encode([
                "error" => "No se pudo escribir en el archivo. Verifica los permisos."
            ]);
        } else {
            echo json_encode([
                "message" => "Datos guardados correctamente",
                "data" => $data,
                "bytes_written" => $result
            ]);
        }
    }elseif ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $file = __DIR__ . '/usuarioGET.json';
        // Leer los datos del archivo JSON
        if (file_exists($file)) {
            $json_data = file_get_contents($file);
            $data = json_decode($json_data, true);
            if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
                echo json_encode([
                    "error" => "Error al leer el archivo JSON: " . json_last_error_msg()
                ]);
            } else {
                echo json_encode([
                    "message" => "Datos recuperados correctamente",
                    "data" => $data
                ]);
            }
        } else {
            echo json_encode(["message" => "No hay datos guardados"]);
        }
    }

?>