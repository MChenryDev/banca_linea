<?php
session_start();
include '../config/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'];
    $nuevoEstado = $_POST['estado'];

    $sql = "UPDATE usuarios_sistema SET bloqueado = $nuevoEstado WHERE usuario = '$usuario'";

    if ($conn->query($sql) === TRUE) {
        echo "Estado actualizado exitosamente.";
    } else {
        echo "Error al actualizar el estado: " . $conn->error;
    }
}

$conn->close();

?>