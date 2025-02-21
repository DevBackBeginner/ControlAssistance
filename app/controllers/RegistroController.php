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
                    // Primero, registrar la entrada
                    $resultadoEntrada = $this->registroModelo->registroEntrada($aprendizId);
    
                    // Responder con JSON para continuar con la pregunta del computador
                    if ($resultadoEntrada) {
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

    // Método para registrar un computador
    public function registrarComputador() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $aprendizId = $_POST['aprendiz_id'] ?? null;
            $marcaComputador = $_POST['marca_computador'] ?? null;
            $codigoComputador = $_POST['codigo_computador'] ?? null;
    
            if ($aprendizId && $marcaComputador && $codigoComputador) {
                try {
                    $resultado = $this->registroModelo->registrarComputador($aprendizId, $marcaComputador, $codigoComputador);
    
                    if ($resultado) {
                        echo json_encode(['success' => true, 'message' => 'Computador registrado correctamente.']);
                    } else {
                        echo json_encode(['success' => false, 'message' => 'Error al registrar el computador.']);
                    }
                } catch (Exception $e) {
                    echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'Datos incompletos.']);
            }
        }
    }
    
    
}
