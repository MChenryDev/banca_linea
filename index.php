<?php
session_start();
$_SERVER['PHP_AUTH_USER'] = '';
$_SERVER['PHP_AUTH_PW'] = '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preload" href="styles/normalize.css">
    <link rel="stylesheet" href="styles/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=PT+Sans:wght@400;700&family=Prompt:wght@100;300;500;600&display=swap" rel="stylesheet">
    <title>Pagina Principal</title>
</head>
<body>
    
        <header>
        <div class="bloque">
            <img src="logo.png" alt="Logo del Banco XYZ">
            <h3>Banco XYZ</h3>
        </div> 
            
            
        </header>
    <div class="nav-bar">
        <nav id="main" class="container">
                <a href="usuariosb/index.php">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-square-rounded" width="32" height="32" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M12 13a3 3 0 1 0 0 -6a3 3 0 0 0 0 6z" />
                    <path d="M12 3c7.2 0 9 1.8 9 9s-1.8 9 -9 9s-9 -1.8 -9 -9s1.8 -9 9 -9z" />
                    <path d="M6 20.05v-.05a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v.05" />
                </svg>
                    Usuarios
                </a>
                <a href="cajeros/index.php">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-square-rounded" width="32" height="32" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M12 13a3 3 0 1 0 0 -6a3 3 0 0 0 0 6z" />
                    <path d="M12 3c7.2 0 9 1.8 9 9s-1.8 9 -9 9s-9 -1.8 -9 -9s1.8 -9 9 -9z" />
                    <path d="M6 20.05v-.05a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v.05" />
                </svg>
                    Cajeros
                </a>
                <a href="administracion/index.php">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-settings" width="32" height="32" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z" />
                    <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" />
                </svg>
                    Administrador
                </a>
                <a href="registro.php">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-square-rounded-plus" width="32" height="32" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M9 12h6" />
                    <path d="M12 9v6" />
                    <path d="M12 3c7.2 0 9 1.8 9 9s-1.8 9 -9 9s-9 -1.8 -9 -9s1.8 -9 9 -9z" />
                </svg>
                    Registro
                </a>
                <a href="logout.php" onclick="logout(event)">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-logout" width="32" height="32" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                  <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" />
                  <path d="M9 12h12l-3 -3" />
                  <path d="M18 15l3 -3" />
                </svg>
                    Salir
                </a>
        </nav>
    </div>
    <div class="container">
        <section >
            <div class="seccion">
                <div class="bloque">
                    <h3>Pagina Principal</h3>
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-home-2" width="40" height="40" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                        <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                        <path d="M10 12h4v4h-4z" />
                    </svg>
                    <?php
                        if (!empty($_SESSION)) { 
                    ?>
                    <h3> | Usuario Conectado: <?php echo $_SESSION['nameUser']?></h3>
                    <?php 
                    } else {
                        echo "";
                    }
                    ?>
                </div>
                
                <p>
                    <b>Si desea iniciar sesión en el "Panel de Usuario" deberá de utilizar su Correo Electrónico como Usuario</b>
                    <ol>
  <li>
    <strong>Panel de Administrador:</strong>
    <p>
    Para utilizar este sitio deberá de solicitar al o, a los administradores las credenciales para poder ingresar al panel de "Administrador". Una vez iniciada sesión como administrador, podrá crear nuevos usuarios con rol de cajeros, además de que tendrá acceso a un monitor de trasferencias donde podrá ver el total de transferencia por hora y total de usuarios que han hecho transacciones por hora durante el día
    </p>
  </li>

  <li>
    <strong>Registro:</strong>
    <p>
    El usuario tendrá la posibilidad de registrarse, al ingresar a la página de registro el usuario deberá de completar los campos solicitados. Al registrarse, el sistema desplegará un mensaje confirmando la operación e indicando que deberá de revisar su correo electrónico para proceder a activar su cuenta. Al ingresar al correo y hacer click al link de confirmación, se abrirá una página indicando que su cuenta ha sido actividad y se le rediccionará en 5 segundos a la página principal del sistema para su correspondiente inicio de sesión.
    </p>
  </li>

  <li>
    <strong>Panel de Usuario:</strong>
    <p>
    Al hacer click en "Usuario" el sistema le pedirá las credenciales que utilizó mientras se registró. Es importante que previamente haya activado su cuenta, de lo contrario, no podrá ingresar. Una vez iniciada sesión como usuario, podrá realizar operaciones como agregar cuentas de terceros, realizar transferencias a cuentas de terceros y consulta de estado de cuenta. Con respecto a la agregación de cuentas de terceros el sistema le notificará si la cuenta de terceros ya existe, si ya existe, el sistema no le permitirá agregar la cuenta. En el caso de las transferencias a cuentas de terceros, el sistema validará las condiciones de máxima cantidad a transferir, y máximo de transferencias por día. Finalmente, en el estado de cuenta podrá ver el detalle de débitos y créditos realizados.
    </p>
  </li>
  <li>
    <strong>Panel de Cajero:</strong>
    <p>
    Aquí podrá crear cuentas monetarias, así mismo, podrá realizar operaciones de retiro y depósito para dichas cuentas. Al momento de agregar una cuenta monetaria, el sistema determinará si la cuenta existe o no.}
    </p>
  </li>

  <li>
    <strong>Salir de la cuenta:</strong>
    <p>
      Para salir de la cuenta, deberá de hacer click en "Salir".
    </p>
  </li>
</ol>
                </p>
            </div>
        </section>
    </div>
    <footer class="footer">
        <p>Todos los derechos reservados. Banco XYZ</p>
    </footer>
        <script>
            function logout() {
                // Limpiar credenciales almacenadas en el navegador
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.open("GET", "logout_ajax.php", true);
                xmlhttp.send();
            }
        </script>
    
</body>
</html>
