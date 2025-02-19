<?php 

// Requiere el archivo de conexión a la base de datos
require_once '../config/DataBase.php';

class RegistroModelo {
    private $db; // Propiedad para la conexión a la base de datos

    // Constructor de la clase
    public function __construct() {
        // Crear una nueva instancia de la base de datos
        $conn = new DataBase();
        
        // Obtener la conexión establecida
        $this->db = $conn->getConnection();
    }

}
?>
