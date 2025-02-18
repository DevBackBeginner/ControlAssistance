<?php
    use core\Router;
    
    require_once '../config/DataBase.php';

    Router::get("login", [LoginController::class, "mostrarLogin"]);
    Router::post("procesarLogin", [LoginController::class, "procesarLogin"]);
    Router::post("logout", [LoginController::class, "Logout"]);

    Router::get('/', [AprendizController::class, "mostrarAprendicesPorFicha"]);

    Router::get('panel', [AprendizController::class, "mostrarAprendicesPorFicha"]);

    Router::get('reporte', [ReporteController::class, "generarPDF"]);

    Router::post("registrarPortero", [PorteroController::class, "registrarPortero"]);

    Router::get("loginportero", [PorteroController::class, "mostrarLoginPortero"]);


?>