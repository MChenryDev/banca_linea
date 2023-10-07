<?php
session_start();


include '../config/db_connection.php';
$montoMaximoPermitido = $_POST['monto_maximo'];
$cantidadMaximaDia = $_POST['cant_maxima_dia'];

// variable de sesion es la cuenta del usuario que esta conectado en este momento
$cuentaOrigen =  $_SESSION['noCuenta'];

// variables obtenidas por POST
$cuentaDestino = $_POST['cuenta_transferir'];
$monto_transferencia = $_POST['cantida_transferir'];

// Obtener límites de la cuenta de origen
$queryLimites = "SELECT monto_maximo, cant_maxima_dia FROM cuentas_terceros WHERE no_cuenta = ?";
$stmtLimites = $conn->prepare($queryLimites);
$stmtLimites->bind_param('i', $cuentaOrigen);
$stmtLimites->execute();
$stmtLimites->bind_result($montoMaximoPermitido, $cantidadMaximaDia);
$stmtLimites->fetch();
$stmtLimites->close();

// Para averiguar el maximo de cantidad de transacciones
$queryCantidadTransacciones = "SELECT COUNT(*) FROM bitacora_transacciones WHERE cuenta_origen = ? AND DATE(fecha_transaccion) = CURDATE()";
$stmtCantidadTransacciones = $conn->prepare($queryCantidadTransacciones);
$stmtCantidadTransacciones->bind_param('i', $cuentaOrigen);
$stmtCantidadTransacciones->execute();
$stmtCantidadTransacciones->bind_result($cantidadTransacciones);
$stmtCantidadTransacciones->fetch();
$stmtCantidadTransacciones->close();

//////////////////////////////////////////////////////////////////////////////////////////
if ($cantidadTransacciones >= $cantidadMaximaDia) {
    echo "Se ha alcanzado la cantidad máxima de transacciones para hoy.";
}
    elseif ($monto_transferencia > $montoMaximoPermitido) {
    // El monto de transferencia excede el límite permitido
    echo "El monto de transferencia excede el límite permitido para esta cuenta.";
}  else {
    // Llamada al procedimiento almacenado
    $query = "CALL RealizarTransferencia(?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('iid', $cuentaOrigen, $cuentaDestino, $monto_transferencia);
    $stmt->execute();
    $stmt->close();
    
}




$conn->close();
?>