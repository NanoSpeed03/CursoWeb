<?php
    include "connect.php";  // Asegúrate de que esta es la conexión correcta a la base de datos
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Recuperar datos del formulario
        $titulo = $_POST['titulo'] ?? null;
        $autor = $_POST['autor'] ?? null;
        $anio = $_POST['ano'] ?? null;

        // Verificar que los datos requeridos no estén vacíos
        if ($titulo && $autor && $anio) {
            // Preparar la consulta SQL para insertar los datos
            $stmt = $conn->prepare("INSERT INTO libros (titulo, autor, ano) VALUES (?, ?, ?)");
            $stmt->bind_param("ssi", $titulo, $autor, $anio); // "ssi" indica: string, string, integer

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
$conn->close();

?>