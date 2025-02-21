<?php
    // Se importa el modelo 'AprendizModelo' para poder interactuar con la base de datos
    require_once __DIR__ . '/../models/AprendizModelo.php';

    class AprendizController {

        // Se declara la propiedad para almacenar la instancia del modelo de aprendiz
        private $aprendizModelo;

        // Constructor de la clase
        public function __construct() {
            // Se inicializa la propiedad $modeloAprendiz con una nueva instancia del modelo 'AprendizModelo'
            $this->aprendizModelo = new AprendizModelo();
        }

        // Método para mostrar los aprendices organizados por ficha
        public function mostrarAprendicesPorFicha() {
            // Se llama al método 'obtenerPorFicha' del modelo para obtener los aprendices agrupados por ficha
            $aprendicesPorFicha = $this->aprendizModelo->obtenerTodosPorFicha();

            // Se verifica si no se obtuvieron datos, en cuyo caso se detiene la ejecución con un mensaje de error
            if (!$aprendicesPorFicha) {
                die("Error: No se encontraron datos.");
            }

            // Si los datos fueron encontrados, se carga la vista 'panel.php' para mostrar los aprendices
            include_once __DIR__ . '/../views/learners/panel.php'; // Cargar la vista
        }

        // Método para obtener computadores asociados a un aprendiz
        public function obtenerComputadoresDocumento($documento) {
            try {
                return $this->aprendizModelo->obtenerComputadoresPorDocumento($documento);
            } catch (Exception $e) {
                $_SESSION['mensaje_error'] = "Error al obtener computadores: " . $e->getMessage();
                return [];
            }
        }

        public function filtrarAprendices() {
            // Obtener el valor del filtro 'ficha' de la solicitud POST, si no existe, se asigna una cadena vacía
            $ficha = $_POST['ficha'] ?? '';
            
            // Obtener el valor del filtro 'documento' de la solicitud POST, si no existe, se asigna una cadena vacía
            $documento = $_POST['documento'] ?? '';
        
            // Obtener los resultados de aprendices filtrados de la base de datos usando el modelo
            $aprendicesPorFicha = $this->aprendizModelo->obtenerAprendicesFiltrados($ficha, $documento);
        
            // Incluir la vista que renderiza la tabla con los resultados de los aprendices filtrados
            include_once __DIR__ . '/../views/learners/tabla_aprendices.php'; // Cargar la vista
        }

        // Manejar la solicitud para obtener el contenido del modal
        public function obtenerContenidoModal($aprendizId) {
            // Obtener la información del aprendiz
            $aprendiz = $this->aprendizModelo->obtenerAprendizPorId($aprendizId);

            // Verificar si el aprendiz tiene un computador asignado
            // $computador = $this->aprendizModelo->obtenerComputadorPorAprendizId($aprendizId);

            // Incluir la vista del modal y pasar los datos necesarios
            include 'vistas/modalContenido.php';
        }
        
    }
?>

