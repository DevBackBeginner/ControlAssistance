<?php
    use core\Router;
    
    require_once '../config/DataBase.php';


    Router::post("LogingDookeerper", [LoginController::class, "ProcessLogin"]);

    Router::get('/', [AprendizController::class, "mostrarAprendicesPorFicha"]);

    Router::get('reporte', [ReporteController::class, "generarPDF"]);

?>