<?php
session_start();


function authenticate_user()
{
    $_SERVER['PHP_AUTH_USER'] = '';
    $_SERVER['PHP_AUTH_PW'] = '';
    header("HTTP/1.1 401 Unauthorized");
    header('WWW-Authenticate: Basic realm="Mi Dominio"');
    echo 'Debe proporcionar credenciales.';    
    exit;
}

if (!isset($_SERVER['PHP_AUTH_USER'])) {
    authenticate_user();
} else {
    include '../config/db_connection.php';

    $query = "SELECT usuario, password FROM usuarios_sistema
              WHERE usuario='$_SERVER[PHP_AUTH_USER]' 
              AND password=MD5('$_SERVER[PHP_AUTH_PW]')
              AND id_rol = 2"; // nos aseguramos que sea el cajero que tiene el id_rol = 2

    if ($resultado = $conn->query($query)) {
        if ($resultado->num_rows == 0) {
            authenticate_user();
        } else {
            $row = $resultado->fetch_assoc();
            $usuario = $row['usuario'];
            // Crear variable de session para usarla donde nos plazca
            $_SESSION['nameUser'] = $usuario;
          }
        } else {
          printf("Error: %s\n", $conn->error);
        }
      }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preload" href="../styles/normalize.css">
    <link rel="stylesheet" href="../styles/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=PT+Sans:wght@400;700&family=Prompt:wght@100;300;500;600&display=swap" rel="stylesheet">
    <title>Panel Cajero</title>
</head>
<body>
    
        <header>
            <div class="bloque">
                <img src="../logo.png" alt="Logo del Banco XYZ">
                <h3>Banco XYZ</h3>
            </div> 
            
            
        </header>
    <div class="nav-bar">
        <nav id="main" class="container">
                
                <a href="agregar_cta_monetaria.php">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-square-rounded-plus" width="32" height="32" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M9 12h6" />
                    <path d="M12 9v6" />
                    <path d="M12 3c7.2 0 9 1.8 9 9s-1.8 9 -9 9s-9 -1.8 -9 -9s1.8 -9 9 -9z" />
                </svg>
                    Crear Cuenta Monetaria
                </a>
                <a href="deposito_monetario.php">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-home-dollar" width="32" height="32" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M19 10l-7 -7l-9 9h2v7a2 2 0 0 0 2 2h6" />
                    <path d="M9 21v-6a2 2 0 0 1 2 -2h2c.387 0 .748 .11 1.054 .3" />
                    <path d="M21 15h-2.5a1.5 1.5 0 0 0 0 3h1a1.5 1.5 0 0 1 0 3h-2.5" />
                    <path d="M19 21v1m0 -8v1" />
                </svg>
                    Depósito Monetario
                </a>
                <a href="retiro_monetario.php">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-coins" width="32" height="32" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M9 14c0 1.657 2.686 3 6 3s6 -1.343 6 -3s-2.686 -3 -6 -3s-6 1.343 -6 3z" />
                    <path d="M9 14v4c0 1.656 2.686 3 6 3s6 -1.344 6 -3v-4" />
                    <path d="M3 6c0 1.072 1.144 2.062 3 2.598s4.144 .536 6 0c1.856 -.536 3 -1.526 3 -2.598c0 -1.072 -1.144 -2.062 -3 -2.598s-4.144 -.536 -6 0c-1.856 .536 -3 1.526 -3 2.598z" />
                    <path d="M3 6v10c0 .888 .772 1.45 2 2" />
                    <path d="M3 11c0 .888 .772 1.45 2 2" />
                </svg>
                    Retiro Monetario
                </a>
                <a href="../logout.php" onclick="logout()">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-logout" width="32" height="32" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                  <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" />
                  <path d="M9 12h12l-3 -3" />
                  <path d="M18 15l3 -3" />
                </svg>
                    Volver al Inicio
                </a>
        </nav>
    </div>
    <div class="container">
        <section >
            <div class="seccion">
                <div class="bloque">
                    <h3>Panel Cajero</h3>
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-dollar" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                        <path d="M6 21v-2a4 4 0 0 1 4 -4h3" />
                        <path d="M21 15h-2.5a1.5 1.5 0 0 0 0 3h1a1.5 1.5 0 0 1 0 3h-2.5" />
                        <path d="M19 21v1m0 -8v1" />
                    </svg>
                </div>
                <p>
                    Bienvenido, <?php echo $_SESSION['nameUser'] ?>! 
                </p>
                <p>
                    Este es el panel de Cajero, aquí podrás crear cuentas monetarias, así mismo, podrás realizar operaciones de depósito y retiro para dichas cuentas monetarias.  <?php echo ''; $conn->close(); ?>
                </p>
            </div>
        </section>
    </div>
    <footer class="footer">
        <p>Todos los derechos reservados. Banco XYZ</p>
    </footer>
<script src="../js/script.js"></script>
    
</body>
</html>
