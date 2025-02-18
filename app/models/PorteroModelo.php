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
     * @param string $contrasena Contraseña sin hashear (se debería hashear antes de llamar a este método)
     * @param string $correo Correo electrónico del portero
     * @param string $telefono Teléfono de contacto
     * @param string $turno Turno asignado al portero (mañana/tarde/noche)
     * 
     * @return bool Retorna true si la inserción fue exitosa, false en caso de error
     */
    public function crearPortero($nombre, $correo, $contrasena, $telefono, $turno) {
        try {
            // Preparar la consulta SQL
            $sql = "INSERT INTO porteros (nombre, correo, contrasena, telefono, turno) 
                    VALUES (:nombre, :correo,  :contrasena, :telefono, :turno)";

            $stmt = $this->db->prepare($sql);

            // Enlazar los parámetros utilizando bindParam
            $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $stmt->bindParam(':correo', $correo, PDO::PARAM_STR);
            $stmt->bindParam(':contrasena', $contrasena, PDO::PARAM_STR);
            $stmt->bindParam(':telefono', $telefono, PDO::PARAM_STR);
            $stmt->bindParam(':turno', $turno, PDO::PARAM_STR);

            // Ejecutar la consulta
            return $stmt->execute();
        } catch (PDOException $e) {
            // Registrar el error en el log del servidor
            error_log("Error al registrar portero: " . $e->getMessage());
            return false;
        }
    }
}
?>
