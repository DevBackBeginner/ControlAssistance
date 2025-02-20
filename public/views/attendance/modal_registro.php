<!-- Modal para el aprendiz (identificador único basado en el id del aprendiz) -->
<div id="modal-<?= $aprendizId ?>" class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center">
    <div class="bg-white p-4 rounded-lg shadow-xl w-11/12 md:w-1/3">

        <?php if (!empty($error_message)): ?>
            <div id="error-session" class="bg-red-100 text-red-800 p-3 rounded-lg mb-3">
                <?= htmlspecialchars($error_message) ?>
            </div>
        <?php endif; ?>
        
        <!-- Paso 1: Registro de Asistencia -->
        <div id="step-1-<?= $aprendizId ?>">
            <h2 class="text-lg font-bold mb-3">Registro de Entrada</h2>

            <form id="asistencia-form-<?= $aprendizId ?>" method="POST" onsubmit="return registrar_EntradaAjax('<?= $aprendizId ?>')">
                <!-- Contenedor para mostrar mensajes -->
                <input type="hidden" name="tipo" value="entrada">
                <input type="hidden" name="aprendiz_id" value="<?= htmlspecialchars($aprendiz['id']) ?>">

                <div class="flex space-x-3">
                    <!-- Botón de registrar -->
                    <button type="submit" class="flex-1 bg-green-500 text-white py-2 px-3 rounded-md hover:bg-green-600 transition-colors">
                        Registrar Entrada
                    </button>

                    <!-- Botón de cerrar -->
                    <button type="button" 
                            onclick="cerrarModal('modal-<?= $aprendizId ?>')" 
                            class="flex-1 bg-red-500 text-white py-2 px-3 rounded-md hover:bg-red-600 transition-colors">
                        Cerrar
                    </button>
                </div>
            </form>
        </div>

        <div id="step-2-<?= $aprendizId ?>">
            <h2 class="text-lg font-bold mb-3">Registro de Salida</h2>

            <form id="asistencia-salida-form-<?= $aprendizId ?>" method="POST" onsubmit="return registrar_SalidaAjax('<?= $aprendizId ?>')">
                <!-- Contenedor para mostrar mensajes -->
                <input type="hidden" name="tipo" value="salida">
                <input type="hidden" name="aprendiz_id" value="<?= htmlspecialchars($aprendiz['id']) ?>">

                <div class="flex space-x-3">
                    <!-- Botón de registrar -->
                    <button type="submit" class="flex-1 bg-blue-500 text-white py-2 px-3 rounded-md hover:bg-blue-600 transition-colors">
                        Registrar Salida
                    </button>

                    <!-- Botón de cerrar -->
                    <button type="button" 
                            onclick="cerrarModal('modal-<?= $aprendizId ?>')" 
                            class="flex-1 bg-red-500 text-white py-2 px-3 rounded-md hover:bg-red-600 transition-colors">
                        Cerrar
                    </button>
                </div>
            </form>
        </div>
     
        <!-- Paso 2: Preguntar si se desea registrar un computador -->
        <div id="step-6-<?= $aprendizId ?>" class="hidden">        
            <!-- Opciones para registrar computador (se muestra si elige "Sí") -->
            <div id="computador-options-<?= $aprendizId ?>" class="hidden mt-3">
                <?php if (!empty($aprendiz['computadores'])): ?>
                    <label class="block mb-1 text-sm font-medium">Seleccione su Computador</label>
                    <select class="border border-gray-300 p-2 w-full rounded-md" name="computador_id">
                        <?php foreach ($aprendiz['computadores'] as $computador): ?>
                            <option value="<?= htmlspecialchars($computador['id']) ?>">
                                <?= htmlspecialchars($computador['marca'] . ' - ' . $computador['codigo']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                <?php else: ?>
                    <h3 class="mt-3 text-base font-semibold">Registrar Nuevo Computador</h3>
                    <!-- Formulario para registrar un nuevo computador -->
                    <form id="computador-form-<?= $aprendizId ?>" action="registrarComputador" method="POST">
                        <!-- Enviar el id del aprendiz para relacionar el computador -->
                        <input type="hidden" name="aprendiz_id" value="<?= htmlspecialchars($aprendizId) ?>">
                        <div class="mt-3">
                            <label class="block mb-1 text-sm font-medium">Marca del Computador</label>
                            <input type="text" class="border border-gray-300 p-2 w-full rounded-md" name="marca" placeholder="Ingrese la marca">
                        </div>
                        <div class="mt-3">
                            <label class="block mb-1 text-sm font-medium">Código del Computador</label>
                            <input type="text" class="border border-gray-300 p-2 w-full rounded-md" name="codigo" placeholder="Ingrese el código">
                        </div>
                        <button type="submit" class="mt-3 bg-blue-500 text-white py-2 px-3 rounded-md hover:bg-blue-600 transition-colors">
                            Registrar Computador
                        </button>
                    </form>
                <?php endif; ?>
            </div>     
        </div>
    </div>
</div>
