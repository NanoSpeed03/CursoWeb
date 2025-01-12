<?php
    include_once "connect.php";
    $mysqli = connect();

    if(!isset($_GET["query"])){
        exit();
    }

    if($_GET["libros"]){
        $sql = "SELECT * FROM libros" // TODO: Rellena la query en SQL para recuperar todos los campos de la tabla libros
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

    $mysqli -> close();
?>