<?php
session_start();
include '../config/db_connection.php';

// Variables obtenidas por POST
$cuentaRetiro = $_POST['cuenta_retiro']; // Número de cuenta a la cual se le hará el retiro
$cantidadRetiro = $_POST['cantidad_retiro']; // Cantidad a retirar

// Obtener el saldo actual de la cuenta
$querySaldo = "SELECT monto_inicial FROM cuenta_monentaria WHERE no_cuenta = ?";
$stmtSaldo = $conn->prepare($querySaldo);
$stmtSaldo->bind_param('i', $cuentaRetiro);
$stmtSaldo->execute();
$resultSaldo = $stmtSaldo->get_result();

if ($resultSaldo->num_rows > 0) {
    $row = $resultSaldo->fetch_assoc();
    $saldoActual = $row['monto_inicial'];

    // Verificar si el retiro es válido (no excede el saldo)
    if ($cantidadRetiro <= $saldoActual) {
        // Calcular el nuevo saldo después del retiro
        $nuevoSaldo = $saldoActual - $cantidadRetiro;

        // Actualizar el saldo en la base de datos
        $queryActualizarSaldo = "UPDATE cuenta_monentaria SET monto_inicial = ? WHERE no_cuenta = ?";
        $stmtActualizarSaldo = $conn->prepare($queryActualizarSaldo);
        $stmtActualizarSaldo->bind_param('di', $nuevoSaldo, $cuentaRetiro);

        if ($stmtActualizarSaldo->execute()) {
            // Registro exitoso, puedes mostrar un mensaje o redirigir a una página de éxito
            echo json_encode(array("success" => true, "message" => "Retiro realizado con éxito. Nuevo saldo: Q" . $nuevoSaldo));
        } else {
            // Error al actualizar el saldo
            echo json_encode(array("success" => false, "message" => "Error al actualizar el saldo: " . $stmtActualizarSaldo->error));
        }
    } else {
        // El retiro excede el saldo actual
        http_response_code(400);
        echo json_encode(array("success" => false, "message" => "No puedes retirar más de lo que tienes en la cuenta."));
    }
} 
else {
    // No se encontró la cuenta
    echo json_encode(array("success" => false, "message" => "La cuenta seleccionada no existe."));
}

// Cerrar conexiones y liberar recursos
$stmtSaldo->close();
$stmtActualizarSaldo->close();
$conn->close();
?>
