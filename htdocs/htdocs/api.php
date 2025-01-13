<?php

    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    // Encabezados para permitir solicitudes CORS y especificar JSON
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");

    include_once "connect.php";
    $conn = connect();

    if(!isset($_GET["query"])){
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $sql = "SELECT * FROM libros"; // TODO: Rellena la query en SQL para recuperar todos los campos de la tabla libros
        $result = $conn->query($sql);

        // Verificar si hay resultados
        if ($result->num_rows > 0) {
            $data = array(); // Array para almacenar los resultados
            
            // Recorrer cada fila y agregarla al array
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            
            // Convertir el array a formato JSON
            echo json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        } else {
            echo json_encode(array("message" => "No se encontraron datos."));
        }

        exit();
    }

    $conn -> close();
?>