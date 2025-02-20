<?php
    use core\Router;
    
    require_once '../config/DataBase.php';

    Router::get("login", [LoginController::class, "mostrarLogin"]);

    Router::post("procesarLogin", [LoginController::class, "procesarLogin"]);
    
    Router::post("logout", [LoginController::class, "Logout"]);

    Router::get('/', [AprendizController::class, "mostrarAprendicesPorFicha"]);

    Router::get('panel', [AprendizController::class, "mostrarAprendicesPorFicha"]);

    Router::post('filtrar_aprendices', [AprendizController::class, "filtrarAprendices"]);

    Router::post('registrar_entrada', [RegistroController::class, 'registrarEntrada']);
    
    Router::post('registrar_salida', [RegistroController::class, 'registrarSalida']);
    
    Router::post('registrarComputador', [RegistroController::class, "registrarComputador"]);

    Router::get('generarReporte', [ReporteController::class, "generarPDF"]);

    Router::post("registrarPortero", [RegistroController::class, "registrarPortero"]);



?>