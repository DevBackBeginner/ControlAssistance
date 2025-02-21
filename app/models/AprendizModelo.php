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
            // Definir la consulta SQL con JOIN para relacionar las tablas aprendices, fichas, asistencias y computadores
            $sql = "SELECT 
                a.id, 
                a.numero_identidad, 
                a.nombre, 
                f.codigo_ficha AS ficha, 
                f.turno, 
                asi.hora_entrada, 
                asi.hora_salida, 
                asi.entrada_computador,
                asi.salida_computador,
                c.marca_computador AS computador, 
                c.codigo_computador
            FROM aprendices a
            INNER JOIN fichas f ON a.ficha_id = f.id
            LEFT JOIN asistencias asi ON asi.aprendiz_id = a.id
            LEFT JOIN computadores c ON c.aprendiz_id = a.id
            ORDER BY f.codigo_ficha";
        
            $stmt = $this->db->prepare($sql);
            $stmt->execute(); // Ejecutar la consulta
        
            // Obtener los resultados como un arreglo asociativo
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
            // Inicializar un arreglo para almacenar los aprendices agrupados por ficha
            $studentsByFicha = [];
        
            // Recorrer cada fila del resultado
            foreach ($result as $student) {
                // Agrupar los aprendices usando el código de ficha como clave
                $studentsByFicha[$student['ficha']][] = $student;
            }
            
            // Retornar el arreglo de estudiantes agrupados por ficha
            return $studentsByFicha;
        }
        

        public function obtenerAprendicesFiltrados($ficha, $documento) {
            // Consulta con INNER JOIN para unir aprendices y fichas
            $sql = "SELECT 
                        a.*, 
                        f.codigo_ficha AS ficha, 
                        f.turno,
                        c.marca_computador, 
                        c.codigo_computador
                    FROM aprendices a
                    INNER JOIN fichas f ON a.ficha_id = f.id
                    LEFT JOIN computadores c ON c.aprendiz_id = a.id
                    WHERE 1=1";  // Condición base para agregar filtros dinámicamente
            
            $params = [];
            
            // Validar y agregar condición para el código de ficha
            if (!empty($ficha)) {
                $sql .= " AND f.codigo_ficha LIKE ?";  // Filtro de coincidencia parcial
                $params[] = "%$ficha%";  // Parámetro seguro
            }
        
            // Validar y agregar condición para el número de identidad
            if (!empty($documento)) {
                $sql .= " AND a.numero_identidad LIKE ?";  // Filtro de coincidencia parcial
                $params[] = "%$documento%";  // Parámetro seguro
            }
        
            // Preparar y ejecutar la consulta con PDO para evitar inyecciones SQL
            $stmt = $this->db->prepare($sql);
            $stmt->execute($params);  // Ejecutar con los parámetros proporcionados
        
            // Obtener los resultados
            $aprendices = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
            // Agrupar aprendices por ficha (usando el alias "ficha" que ahora es el código de ficha)
            $aprendicesPorFicha = [];
            foreach ($aprendices as $aprendiz) {
                $aprendicesPorFicha[$aprendiz['ficha']][] = $aprendiz;
            }
        
            // Retornar los aprendices agrupados por ficha
            return $aprendicesPorFicha;
        }
        
        public function obtenerAprendizPorId($aprendizId) {
            $query = "SELECT * FROM aprendices WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $aprendizId, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
    
        // Obtener información del computador asignado al aprendiz
        public function obtenerComputadoresPorAprendizId($aprendizId) {
            $query = "SELECT 
                        computador_id, 
                        marca_computador, 
                        codigo_computador, 
                        aprendiz_id 
                    FROM computadores 
                    WHERE aprendiz_id = :aprendiz_id";
            
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':aprendiz_id', $aprendizId, PDO::PARAM_INT);
            $stmt->execute();
            
            // Devolver todos los computadores asociados al aprendiz
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        
        
        
        // Obtener computadores por documento de aprendiz
        public function obtenerComputadoresPorDocumento($documento) {
            try {
                // Consulta actualizada para reflejar la relación directa entre aprendices y computadores
                $query = $this->db->prepare("
                    SELECT 
                        c.computador_id, 
                        c.marca_computador, 
                        c.codigo_computador
                    FROM computadores c
                    INNER JOIN aprendices ap ON c.aprendiz_id = ap.id
                    WHERE ap.numero_identidad = ? 
                ");
                
                // Ejecutar la consulta con el documento proporcionado
                $query->execute([$documento]);
                
                // Devolver todos los computadores asociados al aprendiz
                return $query->fetchAll(PDO::FETCH_ASSOC);
            } catch (Exception $e) {
                error_log("Error al obtener computadores: " . $e->getMessage());
                return [];
            }
        }
    
        
    }
?>
