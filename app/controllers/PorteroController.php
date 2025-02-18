<?php 

    // Incluir el modelo que maneja las operaciones relacionadas con porteros
    require_once __DIR__ . '/../models/PorteroModelo.php';
    
    // Iniciar la sesión para manejar la autenticación y los mensajes de error/éxito
    session_start();

    // Definición de la clase PorteroController
    class PorteroController {
        // Propiedad privada para almacenar la instancia del modelo de portero
        private $porteroModelo;

        // Constructor: Se instancia el modelo PorteroModel para poder interactuar con la base de datos
        
        public function __construct() {
            $this->porteroModelo = new PorteroModel();   
        }

        public function mostrarLoginPortero(){
            include_once __DIR__ . '/../../public/views/auth/registro.php'; // Cargar la vista

        }

        /**
         * Método para registrar un nuevo portero.
         * Verifica que el usuario tenga permisos de administrador, sanitiza la entrada,
         * valida los datos y, finalmente, guarda la información en la base de datos.
         */
        public function registrarPortero() {
            // Verificar que el usuario esté autenticado y tenga rol de administrador
            // if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'admin') {
            //     $_SESSION['error'] = "Acceso denegado.";
            //     header("Location: login");
            //     exit;
            // }

            // Verificar que se haya enviado el formulario mediante el método POST
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Sanitizar los datos recibidos del formulario
                $nombre = htmlspecialchars(trim($_POST['nombre']), ENT_QUOTES, 'UTF-8');
                $correo = filter_var(trim($_POST['correo']), FILTER_SANITIZE_EMAIL);
                $telefono = filter_var(trim($_POST['telefono']), FILTER_SANITIZE_NUMBER_INT);
                $turno = htmlspecialchars(trim($_POST['turno']), ENT_QUOTES, 'UTF-8');
                $contrasena = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash de la contraseña para almacenamiento seguro

                // Validar que el correo tenga un formato correcto
                if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
                    $_SESSION['error'] = "Correo electrónico no válido.";
                    header("Location: loginportero");
                    exit;
                }

                // Validar que el número de teléfono contenga entre 7 y 15 dígitos
                if (!preg_match('/^\d{7,15}$/', $telefono)) {
                    $_SESSION['error'] = "Número de teléfono inválido.";
                    header("Location: loginportero");
                    exit;
                }

                // Validar que la contraseña tenga al menos 8 caracteres e incluya letras y números
                if (strlen($contrasena) < 8 || !preg_match('/[A-Za-z]/', $contrasena) || !preg_match('/[0-9]/', $contrasena)) {
                    $_SESSION['error'] = "La contraseña debe tener al menos 8 caracteres, incluir letras y números.";
                    header("Location: loginportero");
                    exit;
                }
                // Llamar al método del modelo para crear un nuevo portero en la base de datos
                $resultado = $this->porteroModelo->crearPortero($nombre,  $correo, $contrasena, $telefono, $turno);

                // Evaluar el resultado de la operación de inserción en la base de datos
                if ($resultado) {
                    // Si la inserción es exitosa, establecer un mensaje de éxito y redirigir al dashboard
                    $_SESSION['success'] = "Portero registrado con éxito.";
                    header("Location: panel");
                } else {
                    // Si ocurre un error, establecer un mensaje de error y redirigir de vuelta a la página de registro
                    $_SESSION['error'] = "Error al registrar el portero.";
                    header("Location: loginportero");
                }
                // Finalizar la ejecución del script
                exit;
            }
        }
    }
?>
