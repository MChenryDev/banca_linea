<?php
$host = 'localhost'; // Cambia esto si tu base de datos está en un servidor remoto
$dbname = 'banca_linea';
$username = 'root';
$password = '';

// Crear conexión
$conn = new mysqli($host, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error al conectar a la base de datos: " . $conn->connect_error);
}
?>