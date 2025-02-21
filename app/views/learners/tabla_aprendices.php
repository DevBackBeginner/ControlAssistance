<?php if (!empty($aprendicesPorFicha)): ?>
    <?php foreach ($aprendicesPorFicha as $ficha => $aprendices): ?>
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-primary text-white">
                <h2 class="h5 mb-0">
                    Ficha: <?= htmlspecialchars($ficha); ?>  
                </h2>
                
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover mb-0">
                        <thead class="thead-light">
                            <tr class="text-center">
                                <th>Nombre</th>
                                <th>Identificación</th>
                                <th>Turno</th>
                                <th>Hora de Entrada</th>
                                <th>Hora de Salida</th>
                                <th>Entrada Computador</th>
                                <th>Salida Computador</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($aprendices as $index => $aprendiz): 
                                $aprendizId = !empty($aprendiz['id']) ? $aprendiz['id'] : $index;
                            ?>
                                <tr class="text-center">
                                    <td><?= htmlspecialchars($aprendiz['nombre']) ?></td>
                                    <td><?= htmlspecialchars($aprendiz['numero_identidad']) ?></td>
                                    <td><?= htmlspecialchars($aprendiz['turno']) ?></td>
                                    <td><?= htmlspecialchars($aprendiz['hora_entrada'] ?? 'Sin registro') ?></td>
                                    <td><?= htmlspecialchars($aprendiz['hora_salida'] ?? 'Sin registro') ?></td>
                                    <td><?= htmlspecialchars($aprendiz['entrada_computador'] ?? 'No') ?></td>
                                    <td><?= htmlspecialchars($aprendiz['salida_computador'] ?? 'No') ?></td>
                                    <td>
                                        <?php if (empty($aprendiz['hora_entrada'])): ?>
                                            <!-- Botón de registrar entrada -->
                                            <button type="button" 
                                                    onclick="abrirModal('modal-<?= $aprendizId ?>')"
                                                    class="btn btn-success btn-sm btn-registro-entrada">
                                                Registrar Entrada
                                            </button>
                                        <?php elseif (empty($aprendiz['hora_salida'])): ?>
                                            <!-- Botón de registrar salida -->
                                            <button type="button" 
                                                    onclick="abrirModal('modal-<?= $aprendizId ?>')"
                                                    class="btn btn-dark btn-sm btn-registro-salida">
                                                Registrar Salida
                                            </button>
                                        <?php else: ?>
                                            <!-- Badge de asistencia completa -->
                                            <span class="badge badge-pill badge-success">
                                                Asistencia Completa
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <!-- Modal para este aprendiz -->
                                <?php include "modal_registro.php" ?> 
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p class="text-center no-resultados">No se encontraron resultados.</p>
<?php endif; ?>