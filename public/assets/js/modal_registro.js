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
    


// Función para abrir el modal con Bootstrap
function abrirModal(modalId) {
    var modalElement = document.getElementById(modalId); // Obtener el modal por ID
    if (modalElement) {
        // Eliminar el atributo aria-hidden para asegurar accesibilidad
        modalElement.removeAttribute('aria-hidden');

        // Crear una instancia de Bootstrap Modal y mostrarla
        var modalInstance = new bootstrap.Modal(modalElement);
        modalInstance.show();
    } else {
        console.error("No se encontró el modal con el ID: " + modalId);
    }
}

// Función que cierra el modal dado su ID
function cerrarModal(modalId) {
    const modalElement = document.getElementById(modalId);
    if (modalElement) {
        let modalInstance;
        // Intenta obtener la instancia existente de Bootstrap
        if (typeof bootstrap.Modal.getInstance === "function") {
            modalInstance = bootstrap.Modal.getInstance(modalElement);
        }
        // Si no existe, crea una nueva instancia
        if (!modalInstance) {
            modalInstance = new bootstrap.Modal(modalElement);
        }
        modalInstance.hide();
    } else {
        console.error("No se encontró el modal con id: " + modalId);
    }
}

// Función que asigna el listener a los botones de cerrar
function initializeCloseModalButtons() {
    const closeButtons = document.querySelectorAll(".close-modal-btn");
    closeButtons.forEach(button => {
        button.addEventListener("click", function() {
            const modalId = this.getAttribute("data-modal-id");
            cerrarModal(modalId);
        });
    });
}

// Inicializa los listeners una vez que el DOM esté cargado
document.addEventListener("DOMContentLoaded", initializeCloseModalButtons);

function closeActiveModal() {
    // Busca el modal activo (el que tenga la clase "show")
    const activeModal = document.querySelector('.modal.show');
    if (activeModal) {
        // Disparar un evento "beforeClose" (opcional) para que otros scripts puedan reaccionar
        activeModal.dispatchEvent(new Event('beforeClose'));

        // Remover el backdrop de forma robusta
        document.querySelectorAll('.modal-backdrop').forEach(backdrop => {
        backdrop.parentNode.removeChild(backdrop);
        });

        // Ocultar el modal: removemos la clase "show" y ajustamos estilos
        activeModal.classList.remove('show');
        activeModal.style.display = 'none';
        activeModal.setAttribute('aria-hidden', 'true');

        // Restaurar el scroll del body, en caso de que se haya bloqueado
        document.body.classList.remove('modal-open');
        document.body.style.overflow = '';

        // Disparar un evento "hidden.bs.modal" para imitar el comportamiento de Bootstrap
        activeModal.dispatchEvent(new Event('hidden.bs.modal'));

        // Recargar la página después de cerrar el modal
        location.reload();
    } else {
        console.error('No hay un modal activo para cerrar.');
    }
    }
