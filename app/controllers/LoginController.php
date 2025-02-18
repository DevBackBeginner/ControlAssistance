<?php
    // Incluir el modelo de login para manejar la autenticación de usuarios
    require_once __DIR__ . '/../models/LoginModel.php';
    
    // Iniciar la sesión para manejar autenticación y mensajes de error/éxito
    session_start();

    class LoginController {
        
        private $loginModel;

        // Constructor: Inicializa el modelo de login
        public function __construct() {
            $this->loginModel = new LoginModel();
        }

        /**
         * Método para mostrar la vista de login
         */
        public function mostrarLogin() {
            include_once __DIR__ . '/../../public/views/Students_view.php';
        }

        /**
         * Método para procesar el formulario de login
         */
        public function procesarLogin() {
            // Verificar si los campos usuario y contraseña han sido enviados
            if (!isset($_POST['usuario']) || !isset($_POST['contrasena'])) {
                $_SESSION['error'] = "Credenciales incorrectas.";
                header("Location: login");
                exit;
            }

            // Inicializar la variable de intentos fallidos si no existe
            if (!isset($_SESSION['intentos'])) {
                $_SESSION['intentos'] = 0;
            }

            // Bloquear acceso si hay demasiados intentos fallidos
            if ($_SESSION['intentos'] >= 5) {
                $_SESSION['error'] = "Demasiados intentos fallidos. Intente más tarde.";
                header("Location: login");
                exit;
            }

            // Sanitizar los datos ingresados por el usuario
            $usuario = htmlspecialchars(trim($_POST['usuario']), ENT_QUOTES, 'UTF-8');
            $contrasena = $_POST['contrasena'];

            // Consultar la base de datos para obtener la información del usuario
            $datosUsuario = $this->loginModel->obtenerUsuario($usuario);

            // Verificar si el usuario existe y la contraseña es correcta
            if ($datosUsuario && password_verify($contrasena, $datosUsuario['contrasena'])) {
                session_regenerate_id(true); // Previene ataques de session fixation

                // Guardar datos del usuario en la sesión
                $_SESSION['id'] = $datosUsuario['id'];
                $_SESSION['usuario'] = $usuario;

                // Restablecer el contador de intentos fallidos
                unset($_SESSION['intentos']); 
                
                // Redirigir al usuario al dashboard
                header("Location: dashboard.php");
                exit;
            } else {
                // Incrementar el contador de intentos fallidos en caso de error
                $_SESSION['intentos']++;
                $_SESSION['error'] = "Credenciales incorrectas.";
                header("Location: login");
                exit;
            }
        }
    }
?>
