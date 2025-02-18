<?php 
    // Incluir la configuración de la base de datos
    require_once '../config/DataBase.php';

    /**
     * Modelo de Aprendiz para interactuar con la base de datos.
     */
    class AprendizModelo {
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

        /**
         * Método para obtener todos los aprendices agrupados por ficha.
         *
         * Esta consulta obtiene información de los estudiantes, su ficha, sus asistencias y datos de computadores asociados.
         *
         * @return array Arreglo asociativo donde cada clave es el código de la ficha y su valor es un arreglo de estudiantes asociados.
         */
        public function obtenerTodosPorFicha() {
            // Definir la consulta SQL con varios JOIN para relacionar las tablas de estudiantes, fichas, asistencias y computadores
            $sql = "SELECT 
                        e.id, 
                        e.numero_identidad, 
                        e.nombre, 
                        f.codigo AS ficha, 
                        f.turno, 
                        a.fecha, 
                        a.hora_entrada, 
                        a.hora_salida, 
                        c.nombre AS computador, 
                        c.codigo AS codigo_computador
                    FROM estudiantes e
                    INNER JOIN estudiante_ficha ef ON e.id = ef.estudiante_id
                    INNER JOIN fichas f ON ef.ficha_id = f.id
                    LEFT JOIN asistencias a ON a.estudiante_id = e.id
                    LEFT JOIN computadores c ON a.computador_id = c.id
                    ORDER BY f.codigo";

            // Ejecutar la consulta en la base de datos
            $result = $this->db->query($sql);

            // Inicializar un arreglo para almacenar los estudiantes agrupados por ficha
            $studentsByFicha = [];
            // Recorrer cada fila del resultado
            while ($student = $result->fetch_assoc()) {
                // Agrupar los estudiantes usando el código de ficha como clave
                $studentsByFicha[$student['ficha']][] = $student;
            }

            // Retornar el arreglo de estudiantes agrupados por ficha
            return $studentsByFicha;
        }
    }
?>
