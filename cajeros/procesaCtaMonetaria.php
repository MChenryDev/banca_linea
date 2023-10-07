<?php
// PARA PROCESAR LA CRECION DE CUENTA MONETARIA
session_start();
include '../config/db_connection.php';

$noCuenta = $_POST['no_cuenta'];

//$cuentaAgrego =  $_SESSION['noCuenta'];


$query = "SELECT * FROM cuenta_monentaria WHERE no_cuenta = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $noCuenta);

$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    $nombreCuenta = $_POST['nombre_cuenta'];
    $dpi = $_POST['dpi'];
    $montoInicial = $_POST['monto_inicial'];

    $insertQuery = "INSERT INTO cuenta_monentaria (no_cuenta, nombre_cuenta, dpi, monto_inicial, monto_total) VALUES (?, ?, ?, ?, ?)";
    $insertStmt = $conn->prepare($insertQuery);
    $insertStmt->bind_param('isidd', $noCuenta, $nombreCuenta, $dpi, $montoInicial, $montoInicial);

    if ($insertStmt->execute()) {
        echo json_encode(array("success" => true, "message" => "Registro insertado correctamente."));
    } else {
        echo json_encode(array("success" => false, "message" => "Error al insertar el registro: " . $insertStmt->error));
    }
    

    $insertStmt->close();
} else {
    // La cuenta no existe
    echo json_encode(array("success" => false, "message" => "La cuenta ya existe, por favor, intenta con otra cuenta"));
}

$stmt->close();
$conn->close();
?>


