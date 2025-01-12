document.getElementById('libreriaForm').addEventListener('submit', function (event) {
    event.preventDefault(); 

    // Capturar los datos del formulario
    const titulo = document.getElementById('titulo').value;
    const autor = document.getElementById('autor').value;
    const ano = document.getElementById('ano').value;

    // Crear el objeto de datos
    const data = new FormData();
    data.append('titulo', titulo);
    data.append('autor', autor);
    data.append('ano', ano);

    // Enviar los datos con fetch
    fetch('registro.php', { 
        method: 'POST',
        body: data,
    })
    .then(response => response.json())  // Esperamos una respuesta JSON
    .then(data => {
        // Mostrar el mensaje de éxito o error
        document.getElementById('mensaje').innerText = data.message || data.error;
    })
    .catch(error => {
        console.error('Error en la solicitud:', error);
        document.getElementById('mensaje').innerText = 'Error al enviar los datos';
    });
});