<?php
session_start();
include '../config/db_connection.php';

$noCuenta = $_POST['no_cuenta'];
$cuentaAgrego =  $_SESSION['noCuenta'];

$query = "SELECT * FROM cuenta_monentaria WHERE no_cuenta = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $noCuenta);

$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $montoMaximo = $_POST['monto_maximo'];
    $maxTransacciones = $_POST['max_transacciones'];
    $aliasCuenta = $_POST['alias_cuenta'];

    $insertQuery = "INSERT INTO cuentas_terceros (alias_cuenta_tercero, monto_maximo, cant_maxima_dia, no_cuenta, cuenta_agrego) VALUES (?, ?, ?, ?, ?)";
    $insertStmt = $conn->prepare($insertQuery);
    $insertStmt->bind_param('siiii', $aliasCuenta, $montoMaximo, $maxTransacciones, $noCuenta, $cuentaAgrego);

    if ($insertStmt->execute()) {
        echo "Registro insertado correctamente.";
    } else {
        echo "Error al insertar el registro: " . $insertStmt->error;
    }

    $insertStmt->close();
} else {
    // La cuenta no existe
    echo "La cuenta no existe";
}

$stmt->close();
$conn->close();
?>