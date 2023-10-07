<?php 
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Cuenta de Terceros</title>
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
                
                <a href="realizar_transferencia.php">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-square-rounded-plus" width="32" height="32" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M9 12h6" />
                    <path d="M12 9v6" />
                    <path d="M12 3c7.2 0 9 1.8 9 9s-1.8 9 -9 9s-9 -1.8 -9 -9s1.8 -9 9 -9z" />
                </svg>
                    Realizar Transferencia
                </a>
                <a href="index.php">
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
        <section>
            <div class="seccion">
            <div class="bloque">
                <h3>Agregar Nueva Cuenta de Terceros</h3>
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-dollar" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                    <path d="M6 21v-2a4 4 0 0 1 4 -4h3" />
                    <path d="M21 15h-2.5a1.5 1.5 0 0 0 0 3h1a1.5 1.5 0 0 1 0 3h-2.5" />
                    <path d="M19 21v1m0 -8v1" />
                </svg>
            </div>
                <p>
                    Hola, <?php echo $_SESSION['nameUser'] ?>! Aquí puedes Ingresar la información correspondiente para crear una nueva cuenta de terceros.
                </p>
                <p>
                    <b>Si el sistema indica que la cuenta de terceros "No existe" puede deberse de que digitó mal el número de cuenta o que aún no se le haya creado una cuenta monetaria</b>
                </p>
                <form action="procesaFormCuentaTerceros.php" method="POST" id="miFormulario2">
                    <label class="form-label" for="no_cuenta">*No. Cuenta: </label>
                    <input class="form-input" type="number" maxlength="11" required id="no_cuenta" name="no_cuenta">

                    <label class="form-label" for="monto_maximo">*Monto Máximo: </label>
                    <input class="form-input" type="number" maxlength="10" required id="monto_maximo" name="monto_maximo" placeholder="Monto máximo que se puede transferir a esta cuenta">

                    <label class="form-label" for="max_transacciones">*Cantidad Máxima de Transacciones: </label>
                    <input class="form-input" type="number" maxlength="10" required id="max_transacciones" name="max_transacciones" placeholder="Cantidad máxima de transferencias diarias que se 
pueden realizar a la cuenta.">

                    <label class="form-label" for="alias_cuenta">*Alias de la Cuenta: </label>
                    <input class="form-input" type="text" maxlength="100" required id="alias_cuenta" name="alias_cuenta">

                    <input type="hidden" name="formulario_enviado" value="1">
                    <button class="form-button" type="submit" onclick="validar2(event)">Registrar Cuenta</button>
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