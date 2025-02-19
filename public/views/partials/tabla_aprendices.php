<?php if (!empty($aprendicesPorFicha)): ?>
    <?php foreach ($aprendicesPorFicha as $ficha => $aprendices): ?>
        <div class="mb-8 bg-white shadow-lg rounded-lg p-6">
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">Ficha: <?= htmlspecialchars($ficha) ?></h2>
            <div class="overflow-x-auto">
                <table class="w-full border-collapse border border-gray-200 text-sm">
                    <thead class="bg-blue-500 text-white">
                        <tr>
                            <th class="p-4 border">Nombre</th>
                            <th class="p-4 border">Identificación</th>
                            <th class="p-4 border">Turno</th>
                            <th class="p-4 border">Hora de Entrada</th>
                            <th class="p-4 border">Hora de Salida</th>
                            <th class="p-4 border">Computador</th>
                            <th class="p-4 border">Código Computador</th>
                            <th class="p-4 border">Acciones</th> <!-- Nueva columna para el botón -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($aprendices as $aprendiz): ?>
                            <tr class="border-b border-gray-200 hover:bg-gray-100 text-center transition-all">
                                <td class="p-4 border"><?= htmlspecialchars($aprendiz['nombre']) ?></td>
                                <td class="p-4 border"><?= htmlspecialchars($aprendiz['numero_identidad']) ?></td>
                                <td class="p-4 border"><?= htmlspecialchars($aprendiz['turno']) ?></td>
                                <td class="p-4 border"><?= htmlspecialchars($aprendiz['hora_entrada'] ?? 'Sin registro') ?></td>
                                <td class="p-4 border"><?= htmlspecialchars($aprendiz['hora_salida'] ?? 'Sin registro') ?></td>
                                <td class="p-4 border"><?= htmlspecialchars($aprendiz['computador'] ?? 'Sin registro') ?></td>
                                <td class="p-4 border"><?= htmlspecialchars($aprendiz['codigo_computador'] ?? 'Sin registro') ?></td>
                                <td class="p-4 border">
                                    <!-- Formulario del botón de registrar -->
                                    <form action="registrar_aprendiz" method="POST">
                                        <input type="hidden" name="documento" value="<?= htmlspecialchars($aprendiz['numero_identidad']) ?>">
                                        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-lg shadow-md hover:bg-green-600 transition-all">
                                            Registrar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p class="text-center text-red-500 text-lg">No se encontraron resultados.</p>
<?php endif; ?>
