<?php 

    require_once '../config/DataBase.php';

    class LoginModel{
        private $db;

        public function __construct (){
            $conn = new DataBase();
            // Obtener la conexión y asignarla a la variable $db
            $this->db = $conn->getConnection();        
        }

        public function obtenerUsuario($usuario) {
            // Preparar la consulta para evitar SQL Injection
            if (!$stmt = $this->db->prepare("SELECT id, usuario, contrasena FROM porteros WHERE usuario = ?")) {
                die("Error en la consulta: " . $this->db->error);
            }
        
            $stmt->bind_param("s", $usuario);
            $stmt->execute();
            $result = $stmt->get_result();
            
            // Verificar si se encontró un usuario
            if ($datos = $result->fetch_assoc()) {
                $stmt->close(); // Liberar memoria
                return $datos;
            } else {
                $stmt->close(); // Liberar memoria
                return null; // Usuario no encontrado
            }
        }
        
    }
?>
