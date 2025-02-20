<?php 

// Incluir el modelo que maneja las operaciones relacionadas con el registro
require_once __DIR__ . '/../models/RegistroModelo.php';

// Iniciar la sesión para manejar la autenticación y los mensajes de error/éxito
session_start();

// Definición de la clase RegistroController
class RegistroController {
    // Propiedad privada para almacenar la instancia del modelo de registro
    private $registroModelo;

    // Constructor: Se instancia el modelo RegistroModelo para poder interactuar con la base de datos
    public function __construct() {
        $this->registroModelo = new RegistroModelo();
    }

    // Método para manejar el registro de entrada de asistencia
    public function registrarEntrada() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $aprendizId = $_POST['aprendiz_id'] ?? null;

            if ($aprendizId) {
                try {
                    $resultado = $this->registroModelo->registrarEntrada($aprendizId);
                    
                    // Responder con JSON
                    if ($resultado) {
                        echo json_encode(['success' => true, 'message' => 'Entrada registrada correctamente.']);
                    } else {
                        echo json_encode(['success' => false, 'message' => 'Error al registrar la entrada.']);
                    }
                } catch (Exception $e) {
                    echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'ID del aprendiz no proporcionado.']);
            }
        }
    }

    // Método para manejar el registro de salida de asistencia
    public function registrarSalida() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $aprendizId = $_POST['aprendiz_id'] ?? null;

            if ($aprendizId) {
                try {
                    $resultado = $this->registroModelo->registrarSalida($aprendizId);
                    
                    // Responder con JSON
                    if ($resultado) {
                        echo json_encode(['success' => true, 'message' => 'Salida registrada correctamente.']);
                    } else {
                        echo json_encode(['success' => false, 'message' => 'Error al registrar la salida.']);
                    }
                } catch (Exception $e) {
                    echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'ID del aprendiz no proporcionado.']);
            }
        }
    }

    // Método para obtener computadores asociados a un aprendiz
    public function obtenerComputadoresPorDocumento($documento) {
        try {
            return $this->registroModelo->obtenerComputadoresPorDocumento($documento);
        } catch (Exception $e) {
            $_SESSION['mensaje_error'] = "Error al obtener computadores: " . $e->getMessage();
            return [];
        }
    }

    // Método para registrar un computador
    public function registrarComputador() {
        try {
            // Obtener datos del formulario POST
            $marca = $_POST['marca'] ?? '';
            $codigo = $_POST['codigo'] ?? '';

            // Llamar al modelo para registrar el computador
            $this->registroModelo->registrarComputador($marca, $codigo);

            // Mensaje de éxito
            $_SESSION['mensaje_exito'] = "Computador registrado correctamente.";
        } catch (Exception $e) {
            // Manejar errores y mostrar mensajes al usuario
            $_SESSION['mensaje_error'] = "Error al registrar computador: " . $e->getMessage();
        }

        // Redirigir a la página de inicio o a la vista adecuada
        header("Location: panel");
        exit();
    }
}
