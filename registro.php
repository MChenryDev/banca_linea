<?php
session_start();

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
    <title>Registro</title>
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
                
                <a href="index.php">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-logout" width="32" height="32" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                  <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" />
                  <path d="M9 12h12l-3 -3" />
                  <path d="M18 15l3 -3" />
                </svg>
                    Volver
                </a>
        </nav>
    </div>
    <div class="container">
        <section >
            <div class="seccion">
                <h3>Registro de Nuevo Usuario</h3>
                <form class="registro-form" action="registro_usuario_procesar.php" method="post" id="miFormulario7">
                    <label class="form-label" for="numero_cuenta">No. Cuenta:</label>
                    <input class="form-input" type="text" id="numero_cuenta" name="numero_cuenta" required>
                    <label class="form-label" for="correo">Correo Electrónico:</label>
                    <input class="form-input" type="email" id="correo" name="correo" required>
                    <label class="form-label" for="telefono">No. De Teléfono:</label>
                    <input class="form-input" type="tel" id="telefono" name="telefono" required>
                    <label class="form-label" for="contrasena">Contraseña:</label>
                    <input class="form-input" type="password" id="contrasena" name="contrasena" required>
                    <label class="form-label" for="confirmar_contrasena">Confirmación de Contraseña:</label>
                    <input class="form-input" type="password" id="confirmar_contrasena" name="confirmar_contrasena" required>
                    <button class="form-button" type="submit" class="registro-button" onclick="validar7(event)">Registrar</button>
                </form>
            </div>
        </section>
    </div>
    <footer class="footer">
        <p>Todos los derechos reservados. Banco Max</p>
    </footer>
        <script src="js/script.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</body>
</html>
