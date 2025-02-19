 // Escuchar el evento 'input' en el formulario para hacer la búsqueda en tiempo real
 document.getElementById('filterForm').addEventListener('input', function(event) {
    event.preventDefault(); // Evitar recargar la página

    // Crear un objeto FormData para capturar los datos del formulario
    const formData = new FormData(this);

    // Hacer una solicitud AJAX con fetch al backend
    fetch('filtrar_aprendices', {
        method: 'POST', // Usamos POST para la consulta
        body: formData
    })
    .then(response => response.text()) // Obtener la respuesta como texto
    .then(data => {
        // Actualizar el contenido del contenedor de resultados
        document.getElementById('tabla-resultados').innerHTML = data;
    })
    .catch(error => console.error('Error al filtrar aprendices:', error));
});