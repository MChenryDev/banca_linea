<?php
session_start();
include '../config/db_connection.php';

// Variables obtenidas por POST
$cuentaDeposito = $_POST['cuenta_deposito']; // Número de cuenta a la cual se le hará el depósito
$cantidadDeposito = $_POST['cantidad_deposito']; // Cantidad a depositar

// Obtener el saldo actual de la cuenta
$querySaldo = "SELECT monto_inicial FROM cuenta_monentaria WHERE no_cuenta = ?";
$stmtSaldo = $conn->prepare($querySaldo);
$stmtSaldo->bind_param('i', $cuentaDeposito);
$stmtSaldo->execute();
$resultSaldo = $stmtSaldo->get_result();

if ($resultSaldo->num_rows > 0) {
    $row = $resultSaldo->fetch_assoc();
    $saldoActual = $row['monto_inicial'];

    // Calcular el nuevo saldo después del depósito
    $nuevoSaldo = $saldoActual + $cantidadDeposito;

    // Actualizar el saldo en la base de datos
    $queryActualizarSaldo = "UPDATE cuenta_monentaria SET monto_inicial = ? WHERE no_cuenta = ?";
    $stmtActualizarSaldo = $conn->prepare($queryActualizarSaldo);
    $stmtActualizarSaldo->bind_param('di', $nuevoSaldo, $cuentaDeposito);
    if ($stmtActualizarSaldo->execute()) {
        // Registro exitoso, puedes mostrar un mensaje o redirigir a una página de éxito
        echo json_encode(array("success" => true, "message" => "Depósito realizado con éxito. Nuevo saldo: Q" . $nuevoSaldo));
    } else {
        // Error al actualizar el saldo
        echo json_encode(array("success" => true, "message" => "Error al actualizar el saldo: " . $stmtActualizarSaldo->error));
    }
} else {
    // No se encontró la cuenta
    echo json_encode(array("success" => true, "message" => "La cuenta seleccionada no existe."));
}

// Cerrar conexiones y liberar recursos
$stmtSaldo->close();
$stmtActualizarSaldo->close();
$conn->close();
?>
