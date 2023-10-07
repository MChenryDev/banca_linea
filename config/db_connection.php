<?php
session_start();
$host = 'containers-us-west-130.railway.app'; 
$dbname = 'railway';
$username = 'root';
$password = 'mi4O2D08rmByLUxuRXUW';
$port = '7264';

// $DB_HOST=$_ENV["DB_HOST"];
// $DB_USER=$_ENV["DB_USER"];
// $DB_PASSWORD=$_ENV["DB_PASSWORD"];
// $DB_NAME=$_ENV["DB_NAME"];
// $DB_PORT=$_ENV["DB_PORT"];


// CONEXION LOCAL
$conn = new mysqli($host, $username, $password, $dbname, $port);

// CONEXION EN NUBE
// $conn = new mysqli("DB_HOST", "DB_USER", "DB_PASSWORD", "DB_NAME", "DB_PORT");

// Verificar la conexión
if ($conn->connect_error) {
    die("Error al conectar a la base de datos: " . $conn->connect_error);
}
?>