<?php 
    include 'config/db_connection.php';

    // Recibe el token desde el enlace
    $token = $_GET['token'];

    // Buscar el token en la base de datos
    $query = "SELECT * FROM usuarios_banca WHERE token = ? AND confirmado != 1";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // Token válido, actualiza el estado de confirmación de la cuenta
        $queryUpdate = "UPDATE usuarios_banca SET confirmado = 1 WHERE token = ?";
        $stmtUpdate = $conn->prepare($queryUpdate);
        $stmtUpdate->bind_param('s', $token);
        $stmtUpdate->execute();

        echo "¡Tu cuenta ha sido activada exitosamente! Serás redigido a la página principal, para que te puedas loguear";
        // Redirección a la página principal después de 5 segundos
        echo '<script>
                setTimeout(function() {
                    window.location.href = "https://bancalinea-production.up.railway.app/index.php";
                }, 5000); // 5000 milisegundos = 5 segundos
              </script>';
    } else {
        echo "El token no es válido o la cuenta ya está activada.";
    }

    $stmt->close();
    $stmtUpdate->close();
    $conn->close();
?>
