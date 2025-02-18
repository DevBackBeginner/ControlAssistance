<?php
    class DataBase {
        private $host = "localhost";
        private $db = "control_entrada_salida";
        private $user = "root";
        private $pass = "";

        public $conn;

        public function __construct() {
            $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->db);

            // Verificar si la conexión fue exitosa
            if ($this->conn->connect_error) {
                throw new Exception("Error de conexión: " . $this->conn->connect_error);
            }
        }

        public function getConnection() {
            return $this->conn;
        }

        public function close() {
            if ($this->conn) {
                $this->conn->close();
            }
        }
        
    }
?>
