<?php 
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Usuario</title>
    <link rel="preload" href="../styles/normalize.css">
    <link rel="stylesheet" href="../styles/styles.css">
    <!-- Incluir SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=PT+Sans:wght@400;700&family=Prompt:wght@100;300;500;600&display=swap" rel="stylesheet">
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
                <!-- <a href="#">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-home-2" width="32" height="32" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                    <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                    <path d="M10 12h4v4h-4z" />
                </svg>
                    Principal
                </a> -->
                <a href="gestion_user_cajeros.php">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-square-rounded-plus" width="32" height="32" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M9 12h6" />
                    <path d="M12 9v6" />
                    <path d="M12 3c7.2 0 9 1.8 9 9s-1.8 9 -9 9s-9 -1.8 -9 -9s1.8 -9 9 -9z" />
                </svg>
                    Volver a Gestión de Cajeros
                </a>
                <!-- <a href="#">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-plus" width="32" height="32" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" />
                    <path d="M9 12h6" />
                    <path d="M12 9v6" />
                </svg>
                    Agregar Nuevo Usuario
                </a> -->
                <!-- <a href="#">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chart-bar" width="32" height="32" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                  <path d="M3 12m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v6a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                  <path d="M9 8m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v10a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                  <path d="M15 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v14a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                  <path d="M4 20l14 0" />
                </svg>
                    Monitor de Transferencias
                </a> -->
                <!-- <a href="index.php">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-logout" width="32" height="32" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                  <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" />
                  <path d="M9 12h12l-3 -3" />
                  <path d="M18 15l3 -3" />
                </svg>
                    Regresar
                </a> -->
        </nav>
        
    </div>
    <div class="container">
        <section>
            <div class="seccion">
                <div class="bloque">
                    <h3>Agregar Nuevo Usuario Cajero</h3>
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-dollar" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                        <path d="M6 21v-2a4 4 0 0 1 4 -4h3" />
                        <path d="M21 15h-2.5a1.5 1.5 0 0 0 0 3h1a1.5 1.5 0 0 1 0 3h-2.5" />
                        <path d="M19 21v1m0 -8v1" />
                    </svg>
                </div>
                <p>
                    Hola, <?php echo $_SESSION['nameUser'] ?>! Aquí puedes Ingresar la información correspondiente para crear un nuevo usuario cajero. Por favor, completa los siguientes campos.
                </p>
                <form action="procesaFormCajero.php" method="POST" id="miFormulario">
                    <label class="form-label" for="nombre_completo">*Nombre Completo: </label>
                    <input class="form-input" type="text" maxlength="300" required id="nombre_completo" name="nombre_completo">

                    <label class="form-label" for="usuario">*Usuario: </label>
                    <input class="form-input" type="text" maxlength="50" required id="usuario" name="usuario">

                    <label class="form-label" for="clave">*Clave: </label>
                    <input class="form-input" type="password" maxlength="100" required id="clave" name="clave">

                    <label class="form-label" for="confirma_clave">*Confirmación Clave: </label>
                    <input class="form-input" type="password" maxlength="100" required id="confirma_clave" name="confirma_clave">

                    <label class="form-label" for="estado">*Estado: </label>
                    <select class="form-option" name="estado" id="estado" required>
                        <option selected value="" disabled>- Selecciona una opción -</option>
                        <option value="0">Desbloqueado</option>
                        <option value="1">Bloqueado</option>
                    </select>
                    <input type="hidden" name="formulario_enviado" value="1">
                    <button class="form-button" type="submit" onclick="validar(event)">Registrar Usuario</button>
                </form>
                
            </div>
        </section>
    </div>
    <footer class="footer">
        <p>Todos los derechos reservados. Banco Max</p>
    </footer>
    <script src="../js/script.js"></script>
    <!-- Incluir SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</body>
</html>