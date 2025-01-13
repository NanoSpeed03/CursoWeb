document.getElementById('libreriaForm').addEventListener('submit', function (event) {
    event.preventDefault(); 

    // Datos formulario
    const titulo = document.getElementById('titulo').value;
    const autor = document.getElementById('autor').value;
    const ano = document.getElementById('ano').value;

    // Crear el objeto de datos
    const data = new FormData();
    data.append('titulo', titulo);
    data.append('autor', autor);
    data.append('ano', ano);

    // Enviar los datos con fetch
    fetch('http://localhost/registro.php', { 
        method: 'POST',
        body: data,
    })
    .then(response => {
                // Comprobar si la respuesta es correcta
                if (!response.ok) {
                    throw new Error(`Error HTTP: ${response.status}`);
                }

                // Imprimir el cuerpo de la respuesta en consola para depuración
                return response.text();  // Usar text() en lugar de json() para ver qué devuelve
            })
    .then(data => {
        console.log('Respuesta del servidor:', data); // Aquí verás el contenido recibido
        document.getElementById('mensaje').innerText = 'Datos enviados con éxito';
    })
    .catch(error => {
        console.error('Error en la solicitud:', error);
        document.getElementById('mensaje').innerText = 'Error al enviar los datos';
    });
});