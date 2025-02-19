<!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Lista de Aprendices</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="bg-gray-50 text-gray-800">
        <div class="container mx-auto p-8">
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-4xl font-extrabold text-blue-700">Lista de Aprendices por Ficha</h1>
                <div class="flex gap-4">
                    <!-- Botón de cerrar sesión -->
                    <form action="logout" method="POST">
                        <button type="submit" class="bg-red-500 text-white px-5 py-2 rounded-lg shadow-md hover:bg-red-600 transition-all">
                            Cerrar Sesión
                        </button>
                    </form>
                </div>
            </div>

            <!-- Formulario de búsqueda -->
            <div class="mb-8 bg-white shadow-md rounded-lg p-6">
                <form id="filterForm" class="flex flex-col md:flex-row gap-4">
                    <!-- Campo de búsqueda por ficha -->
                    <input 
                        type="text" 
                        name="ficha" 
                        placeholder="Buscar por ficha" 
                        class="border border-gray-300 rounded-lg p-3 w-full md:w-1/2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        id="fichaInput"
                    >

                    <!-- Campo de búsqueda por documento -->
                    <input 
                        type="text" 
                        name="documento" 
                        placeholder="Buscar por documento" 
                        class="border border-gray-300 rounded-lg p-3 w-full md:w-1/2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        id="documentoInput"
                    >
                </form>
            </div>

            <!-- Contenedor de resultados -->
            <div id="tabla-resultados">
                <?php include 'views/partials/tabla_aprendices.php'; ?>
            </div>
        </div>
        <script src="../public/views/js/filtro.js"></script>

    </body>
</html>
