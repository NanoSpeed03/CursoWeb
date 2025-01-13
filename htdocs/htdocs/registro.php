<?php

    // Encabezados para permitir solicitudes CORS y especificar JSON
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    include "connect.php";  // Asegúrate de que esta es la conexión correcta a la base de datos

    // Llamar a la función de conexión
    $conn = connect();  // Esto obtiene el objeto de conexión a la base de datos

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Recuperar datos del formulario
        $titulo = $_POST['titulo'] ?? null;
        $autor = $_POST['autor'] ?? null;
        $anio = $_POST['ano'] ?? null;

        // Verificar que los datos requeridos no estén vacíos
        if ($titulo && $autor && $anio) {
            // Preparar la consulta SQL para insertar los datos
            $stmt = $conn->prepare("INSERT INTO libros (titulo, autor, ano) VALUES (?, ?, ?)");

            if (!$stmt) {
                die(json_encode(["error" => "Error al preparar la consulta SQL: " . $conn->error]));
            }
    
            // Vincular los parámetros y ejecutar la consulta
            $stmt->bind_param("ssi", $titulo, $autor, $anio);    

            // Ejecutar la consulta
            if ($stmt->execute()) {
                echo json_encode(array("message" => "Libro añadido correctamente."));
            } else {
                echo json_encode(array("error" => "Error al añadir el libro.", "details" => $stmt->error));
            }

            // Cerrar el statement
            $stmt->close();
        } else {
            echo json_encode(array("error" => "Faltan datos requeridos: título, autor o año."));
        }
    } else {
        echo json_encode(array("error" => "Método HTTP no permitido. Usa POST."));
}
// Cerrar la conexión
$conn->close();

?>