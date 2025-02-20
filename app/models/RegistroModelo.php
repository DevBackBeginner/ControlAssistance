<?php 

require_once '../config/DataBase.php';

class RegistroModelo {
    private $db;

    public function __construct() {
        $conn = new DataBase();
        $this->db = $conn->getConnection();
        date_default_timezone_set('America/Bogota');

    }

    // Registrar entrada/salida de asistencia
    public function registrarEntrada($aprendizId)
    {
        $fechaHoraActual = date('Y-m-d H:i:s');

        // Actualizar `hora_entrada` solo si está en NULL
        $sqlUpdate = "UPDATE asistencias 
                      SET hora_entrada = :fecha_hora 
                      WHERE aprendiz_id = :aprendiz_id 
                      AND hora_entrada IS NULL";

        $stmtUpdate = $this->db->prepare($sqlUpdate);
        return $stmtUpdate->execute([
            ':fecha_hora' => $fechaHoraActual,
            ':aprendiz_id' => $aprendizId,
        ]);
    }

    // Método para registrar la hora de salida
    public function registrarSalida($aprendizId)
    {
        $fechaHoraActual = date('Y-m-d H:i:s');

        // Actualizar `hora_salida` solo si ya existe una `hora_entrada` no nula y `hora_salida` es NULL
        $sqlUpdate = "UPDATE asistencias 
                      SET hora_salida = :fecha_hora 
                      WHERE aprendiz_id = :aprendiz_id 
                      AND hora_entrada IS NOT NULL 
                      AND hora_salida IS NULL";

        $stmtUpdate = $this->db->prepare($sqlUpdate);
        return $stmtUpdate->execute([
            ':fecha_hora' => $fechaHoraActual,
            ':aprendiz_id' => $aprendizId,
        ]);
    }

    // Obtener computadores por documento de aprendiz
    public function obtenerComputadoresPorDocumento($documento) {
        try {
    
            $query = $this->db->prepare("
                SELECT c.id, c.marca, c.codigo
                FROM asistencias a
                INNER JOIN computadores c ON a.computador_id = c.id
                INNER JOIN aprendices ap ON a.aprendiz_id = ap.id
                WHERE ap.documento = ? 
                AND a.salida_computador IS NULL
            ");
            $query->execute([$documento]);
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Error al obtener computadores: " . $e->getMessage());
            return [];
        }
    }
    

    // Registrar un nuevo computador
    public function registrarComputador($marca, $codigo) {
        try {
            $verificarQuery = $this->db->prepare("SELECT id FROM computadores WHERE codigo = ?");
            $verificarQuery->execute([$codigo]);

            if ($verificarQuery->fetch()) {
                throw new Exception("El computador con este código ya está registrado.");
            }

            $query = $this->db->prepare("INSERT INTO computadores (marca, codigo) VALUES (?, ?)");
            $query->execute([$marca, $codigo]);
        } catch (Exception $e) {
            error_log("Error al registrar computador: " . $e->getMessage());
            throw $e;
        }
    }

}
?>
