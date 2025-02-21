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
    public function registroEntrada($aprendizId, )
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

    //   public function obtenerComputadores($aprendizId) {
    //     // Consulta SQL para obtener los computadores asignados
    //     $sql = "SELECT * FROM computadores WHERE aprendiz_id = :aprendiz_id";
        
    //     $stmt = $this->db->prepare($sql);
    //     $stmt->bindParam(':aprendiz_id', $aprendizId, PDO::PARAM_INT);
    //     $stmt->execute();

    //     // Verificar si hay resultados
    //     if ($stmt->rowCount() > 0) {
    //         return $stmt->fetchAll(PDO::FETCH_ASSOC); // Devuelve los datos de los computadores
    //     } else {
    //         return []; // Si no hay computadores, devuelve un arreglo vacío
    //     }
    // }
    
    // Registrar un nuevo computador
    public function registrarComputador($aprendizId, $marca, $codigo) {
        try {
            $query = $this->db->prepare("INSERT INTO computadores (aprendiz_id, marca, codigo) VALUES (?, ?, ?)");
            $query->execute([$aprendizId, $marca, $codigo]);
            return true;
        } catch (Exception $e) {
            error_log("Error al registrar computador: " . $e->getMessage());
            return false;
        }
    }
    

}
?>
