<?php
// ESTA PARTE ES PARA OBTENER INFO DE TRANSACCIONES DESDE LA BITACORA DE TRANSACCIONES
include '../config/db_connection.php'; // Asegúrate de incluir la conexión a tu base de datos

// Consulta para obtener la cantidad de transacciones y el monto acumulado para cada hora
$query = "SELECT HOUR(fecha_transaccion) AS hora, COUNT(DISTINCT cuenta_origen) AS cantidad_usuarios
            FROM bitacora_transacciones
            WHERE DATE(fecha_transaccion) = CURDATE()
            GROUP BY HOUR(fecha_transaccion)";

$result = $conn->query($query);

$data = array();

while ($row = $result->fetch_assoc()) {
    $data['horas'][] = $row['hora'];
    $data['usuarios'][] = $row['cantidad_usuarios'];
}

echo json_encode($data);
?>
