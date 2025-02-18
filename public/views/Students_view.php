<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Lista de Aprendices</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="bg-gray-100 text-gray-800">
        <div class="container mx-auto p-6">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-blue-600">Lista de Aprendices por Ficha</h1>
                <!-- Al hacer clic se redirige a la URL que genera el reporte PDF -->
                <a href="reporte" target="_blank" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                    Generar Reporte
                </a>
            </div>


            <?php if (!empty($aprendicesPorFicha)): ?>
                <?php foreach ($aprendicesPorFicha as $ficha => $aprendices): ?>
                    <div class="mb-8 bg-white shadow-lg rounded-lg p-6">
                        <h2 class="text-2xl font-semibold text-gray-700 mb-4">Ficha: <?= htmlspecialchars($ficha) ?></h2>
                        <div class="overflow-x-auto">
                            <table class="w-full border-collapse border border-gray-300 text-sm">
                                <thead class="bg-blue-500 text-white">
                                    <tr>
                                        <th class="p-3 border">Nombre</th>
                                        <th class="p-3 border">Identificación</th>
                                        <th class="p-3 border">Turno</th>
                                        <th class="p-3 border">Fecha</th>
                                        <th class="p-3 border">Hora de Entrada</th>
                                        <th class="p-3 border">Hora de Salida</th>
                                        <th class="p-3 border">Computador</th>
                                        <th class="p-3 border">Código Computador</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($aprendices as $aprendiz): ?>
                                        <tr class="border-b hover:bg-gray-100 text-center">
                                            <td class="p-3 border"><?= htmlspecialchars($aprendiz['nombre']) ?></td>
                                            <td class="p-3 border"><?= htmlspecialchars($aprendiz['numero_identidad']) ?></td>
                                            <td class="p-3 border"><?= htmlspecialchars($aprendiz['turno']) ?></td>
                                            <td class="p-3 border"><?= htmlspecialchars($aprendiz['fecha'] ?? 'Sin registro') ?></td>
                                            <td class="p-3 border">
                                                <?= htmlspecialchars($aprendiz['hora_entrada'] 
                                                    ? date('h:i A', strtotime($aprendiz['hora_entrada'])) 
                                                    : 'Sin registro') ?>
                                            </td>
                                            <td class="p-3 border">
                                                <?= htmlspecialchars($aprendiz['hora_salida'] 
                                                    ? date('h:i A', strtotime($aprendiz['hora_salida'])) 
                                                    : 'Sin registro') ?>
                                            </td>
                                            <td class="p-3 border"><?= htmlspecialchars($aprendiz['computador'] ?? 'Sin registro') ?></td>
                                            <td class="p-3 border"><?= htmlspecialchars($aprendiz['codigo_computador'] ?? 'Sin registro') ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-center text-red-500 text-lg">No hay aprendices registrados.</p>
            <?php endif; ?>
        </div>
    </body>
</html>
