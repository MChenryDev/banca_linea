<?php
include '../config/db_connection.php';

    var_dump($_POST);
    
    $nombreCompleto = $_POST['nombre_completo'];
    $usuario = $_POST['usuario'];
    $clave = $_POST['clave'];
    $confirmaClave = $_POST['confirma_clave'];
    $estado = $_POST['estado'];

    // Validar que las contraseñas coincidan
    if ($clave !== $confirmaClave) {
        echo "Las contraseñas no coinciden.";
        exit(); // Detener la ejecución si las contraseñas no coinciden
    }

    // Hashear la contraseña (deberías utilizar una técnica segura de hash)
//    $hashedClave = password_hash($clave, PASSWORD_DEFAULT);
    $hashedClave = md5($clave);

    // Preparar la consulta para la inserción
    $query = "INSERT INTO usuarios_sistema (usuario, nombre_completo, password, id_rol, bloqueado)
              VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $rol = 2; // Supongo que el rol es 2, debes ajustar según tu estructura de base de datos

    // Vincular los parámetros
    $stmt->bind_param('sssii', $usuario, $nombreCompleto, $hashedClave, $rol, $estado);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo "Registro insertado correctamente.";
    } else {
        echo "Error al insertar el registro: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();

    // Redireccionar después de procesar el formulario
    header("Location: agregar_user_caja.php");
    exit(); // Asegurar que el código posterior no se siga ejecutando

?>