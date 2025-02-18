<?php 

// Requiere el archivo de conexión a la base de datos
require_once '../config/DataBase.php';

class PorteroModel {
    private $db; // Propiedad para la conexión a la base de datos

    // Constructor de la clase
    public function __construct() {
        // Crear una nueva instancia de la base de datos
        $conn = new DataBase();
        
        // Obtener la conexión establecida
        $this->db = $conn->getConnection();
    }

    /**
     * Método para registrar un nuevo portero en la base de datos
     * 
     * @param string $nombre Nombre del portero
     * @param string $usuario Nombre de usuario
     * @param string $contrasena Contraseña sin hashear (se debería hashear antes de llamar a este método)
     * @param string $correo Correo electrónico del portero
     * @param string $telefono Teléfono de contacto
     * @param string $turno Turno asignado al portero (mañana/tarde/noche)
     * 
     * @return bool Retorna true si la inserción fue exitosa, false en caso de error
     */
    public function crearPortero($nombre, $usuario, $contrasena, $correo, $telefono, $turno) {
        try {
            // Hashear la contraseña antes de insertarla en la base de datos
            $hash_contrasena = password_hash($contrasena, PASSWORD_DEFAULT);

            // Preparar la consulta SQL con placeholders (?) para evitar inyecciones SQL
            $stmt = $this->db->prepare("INSERT INTO porteros (nombre, usuario, contrasena, correo, telefono, turno) 
                                        VALUES (?, ?, ?, ?, ?, ?)");

            // Enlazar parámetros a la consulta con bind_param (todos son strings "s")
            $stmt->bind_param("ssssss", $nombre, $usuario, $hash_contrasena, $correo, $telefono, $turno);

            // Ejecutar la consulta y retornar el resultado
            return $stmt->execute();
        } catch (Exception $e) {
            // Registrar el error en el log del servidor
            error_log("Error al registrar portero: " . $e->getMessage());
            return false;
        }
    }
}
?>
