<?php include_once __DIR__ . '/../../views/layouts/header.php'; ?>

<link rel="stylesheet" href="/ControlAssistance/public/assets/css/panel.css">

<div class="container-fluid mb-4 bg-light" style="padding-top: 160px; ">

    <!-- Formulario de búsqueda -->
    <div class="card mb-4 shadow-sm rounded-lg" style="border: 1px solid #005f2f; max-width: 95%; margin: 0 auto;">
        <div class="card-header text-white" style="background-color: #005f2f;">
            <h2 naclass="h5 mb-0 " style="color: white;">Buscar Aprendiz</h2>
        </div>
        <div class="card-body" style="background-color: #f5f5f5;">
            <form id="filterForm" class="row g-3">
                <div class="col-md-6">
                    <label for="fichaInput" class="form-label">Ficha</label>
                    <input 
                        type="text" 
                        name="ficha" 
                        placeholder="Buscar por ficha" 
                        class="form-control" 
                        id="fichaInput"
                    >
                </div>
                <div class="col-md-6">
                    <label for="documentoInput" class="form-label">Documento</label>
                    <input 
                        type="text" 
                        name="documento" 
                        placeholder="Buscar por documento" 
                        class="form-control" 
                        id="documentoInput"
                    >
                </div>
            </form>
        </div>
    </div>

    <!-- Contenedor de resultados -->
    <div id="tabla-resultados" class="card shadow-sm rounded-lg" style="border: 1px solid #005f2f; max-width: 95%; margin: 0 auto;">
        <div class="card-header text-white" style="background-color: #005f2f;">
            <h2 class="h5 mb-0">Resultados de Búsqueda</h2>
        </div>
        <div class="card-body" style="background-color: #ffffff;">
            <?php include "tabla_aprendices.php"; ?>
        </div>
    </div>
</div>

<?php include_once __DIR__ . '/../../views/layouts/footer.php'; ?>
<script src="/ControlAssistance/public/assets/js/filtro.js"></script>
<script src="/ControlAssistance/public/assets/js/modal_registro.js"></script>