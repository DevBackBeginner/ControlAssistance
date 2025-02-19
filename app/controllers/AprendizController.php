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

            // Si los datos fueron encontrados, se carga la vista 'vista_aprendices.php' para mostrar los aprendices
            include_once __DIR__ . '/../../public/views/attendance/panel.php'; // Cargar la vista
        }

        public function filtrarAprendices() {
            $ficha = $_POST['ficha'] ?? '';
            $documento = $_POST['documento'] ?? '';
        
            // Obtener los resultados filtrados de la base de datos
            $aprendicesPorFicha = $this->aprendizModelo->obtenerAprendicesFiltrados($ficha, $documento);
        
            // Renderizar solo la tabla de resultados
            include_once __DIR__ . '/../../public/views/partials/tabla_aprendices.php';

        }
    }
?>

