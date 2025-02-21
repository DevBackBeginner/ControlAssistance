<?php
    require_once '../config/DataBase.php';

    class ComputadorModelo
    {
        // Propiedad para almacenar la conexión a la base de datos
        private $db;

        /**
            * Constructor: Crea una nueva instancia de la base de datos y asigna la conexión a la propiedad $db.
            */
        public function __construct() {
            // Crear una instancia de la clase DataBase para obtener la conexión
            $conn = new DataBase();
            // Asignar la conexión establecida a la propiedad $db
            $this->db = $conn->getConnection();
        }
    
        // Método para obtener todos los computadores registrados
        public function obtenerComputadores($aprendizId) {
            $query = "SELECT * FROM computadores WHERE aprendiz_id = :aprendiz_id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':aprendiz_id', $aprendizId);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function tieneComputador($aprendizId) {
    
            $query = "SELECT id FROM computadores WHERE aprendiz_id = :aprendizId LIMIT 1";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':aprendizId', $aprendizId, PDO::PARAM_INT);
            $stmt->execute();
    
            return $stmt->fetch(PDO::FETCH_ASSOC);  // Retorna el computador si existe
        }
    

        // Método para obtener un computador por su ID (opcional)
        public function obtenerComputadorPorId($id) {
            $query = "SELECT * FROM computadores WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
    }
?>