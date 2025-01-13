document.addEventListener("DOMContentLoaded", function() {
    const botonRecuperar = document.getElementById('recuperarLibros');
    
    botonRecuperar.addEventListener('click', function() {
        fetch('http://localhost/api.php?query=libros') // Solicitud GET al archivo PHP
            .then(response => {
                // Comprobar si la respuesta es correcta
                if (!response.ok) {
                    throw new Error(`Error HTTP: ${response.status}`);
                }

                // Imprimir el cuerpo de la respuesta en consola para depuración
                return response.text();  // Usar text() en lugar de json() para ver qué devuelve
            })
            .then(text => {
                console.log('Respuesta del servidor:', text); // Imprimir respuesta en consola

                // Intentar convertir el texto en JSON
                try {
                    const data = JSON.parse(text);
                    
                    if (data.length > 0) {
                        const tbody = document.querySelector('table tbody');
                        tbody.innerHTML = ''; // Limpiar la tabla antes de agregar los datos

                        data.forEach(libro => {
                            const fila = document.createElement('tr');
                            fila.innerHTML = `
                                <td>${libro.titulo}</td>
                                <td>${libro.autor}</td>
                                <td>${libro.ano}</td>
                            `;
                            tbody.appendChild(fila); // Añadir la fila a la tabla
                        });
                    } else {
                        alert('No se encontraron libros.');
                    }
                } catch (error) {
                    console.error('Error al analizar JSON:', error);
                    alert('Hubo un problema al procesar los datos del servidor.');
                }
            })
            .catch(error => {
                console.error('Error en la solicitud:', error);
                alert('Hubo un error con la solicitud. Revise la consola para detalles.');
            });
    });
});