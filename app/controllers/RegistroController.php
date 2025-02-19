<?php 

    // Incluir el modelo que maneja las operaciones relacionadas con porteros
    require_once __DIR__ . '/../models/PorteroModelo.php';
    
    // Iniciar la sesión para manejar la autenticación y los mensajes de error/éxito
    session_start();

    // Definición de la clase PorteroController
    class RegistroController {
        // Propiedad privada para almacenar la instancia del modelo de portero
        private $registroModelo;

        // Constructor: Se instancia el modelo PorteroModel para poder interactuar con la base de datos
        
        public function __construct() {
            $this->registroModelo = new RegistroModelo();   
        }

      
        
    
    }
?>
