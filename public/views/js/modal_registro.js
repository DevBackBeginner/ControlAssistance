function registrar_EntradaAjax(aprendizId) {
    event.preventDefault(); // Evitar el envío del formulario por defecto

    const form = document.getElementById(`asistencia-form-${aprendizId}`);
    const formData = new FormData(form);

    // Enviar la solicitud por fetch
    fetch("registrar_entrada", {
        method: "POST",
        body: formData,
    })
    .then((response) => response.json())
    .then((data) => {
        if (data.success) {
            // Mostrar el mensaje de éxito enviado por el controlador
            alert(data.message);

            // Cerrar el modal y recargar la página para reflejar los cambios
            cerrarModal(`modal-${aprendizId}`);
            location.reload();
        } else {
            // Mostrar el mensaje de error enviado por el controlador
            alert(data.message);
        }
    })
    .catch((error) => {
        alert("Ocurrió un error al registrar la asistencia.");
        console.error("Error:", error);
    });
}

function registrar_SalidaAjax(aprendizId) {
    event.preventDefault(); // Evitar el envío del formulario por defecto

    const form = document.getElementById(`asistencia-salida-form-${aprendizId}`);
    const formData = new FormData(form);

    // Enviar la solicitud por fetch
    fetch("registrar_salida", {
        method: "POST",
        body: formData,
    })
    .then((response) => response.json())
    .then((data) => {
        if (data.success) {
            // Mostrar el mensaje de éxito enviado por el controlador
            alert(data.message);

            // Cerrar el modal y recargar la página para reflejar los cambios
            cerrarModal(`modal-${aprendizId}`);
            location.reload();
        } else {
            // Mostrar el mensaje de error enviado por el controlador
            alert(data.message);
        }
    })
    .catch((error) => {
        alert("Ocurrió un error al registrar la salida.");
        console.error("Error:", error);
    });

    return false; // Evitar el envío del formulario
}
    

// Función para abrir el modal

function abrirModal(modalId) {
    var modal = document.getElementById(modalId);
    if (modal) {
        modal.classList.remove("hidden");
    } else {
        console.error("No se encontró el modal con id: " + modalId);
    }
}
// Función para cerrar el modal
function cerrarModal(modalId) {
var modal = document.getElementById(modalId);
if (modal) {
    modal.classList.add("hidden");
} else {
    console.error("No se encontró el modal con id: " + modalId);
}
}
