<?php 
session_start();
include '../config/db_connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Cuenta Monetaria</title>
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
                
                <a href="deposito_monetario.php">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-home-dollar" width="32" height="32" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M19 10l-7 -7l-9 9h2v7a2 2 0 0 0 2 2h6" />
                    <path d="M9 21v-6a2 2 0 0 1 2 -2h2c.387 0 .748 .11 1.054 .3" />
                    <path d="M21 15h-2.5a1.5 1.5 0 0 0 0 3h1a1.5 1.5 0 0 1 0 3h-2.5" />
                    <path d="M19 21v1m0 -8v1" />
                </svg>
                    Realizar Depósito
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
                    Realizar Retiro
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
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-dollar" width="40" height="40" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                    <path d="M6 21v-2a4 4 0 0 1 4 -4h3" />
                    <path d="M21 15h-2.5a1.5 1.5 0 0 0 0 3h1a1.5 1.5 0 0 1 0 3h-2.5" />
                    <path d="M19 21v1m0 -8v1" />
                </svg>
                    <h3>Agregar Cuenta Monetaria</h3>
                </div>
                <p>
                    Hola, <?php echo $_SESSION['nameUser'] ?>! Aquí puedes Ingresar la información correspondiente para crear una nueva cuenta monetaria.
                </p>
                <p>
                    <b>El sistema te indicará si la cuenta ya existe o no</b>
                </p>
                <form action="procesaCtaMonetaria.php" method="POST" id="miFormulario4">
                    <label class="form-label" for="no_cuenta">*No. Cuenta disponibles registradas por clientes: </label>
                    <select class="form-option" name="no_cuenta" id="no_cuenta">
                        <option value="" disabled selected> - Selecciona una cuenta - </option>
                        <?php 
                        // Para listar las cuentas que ha registrado el usuario conectado
                        $qry = 'SELECT no_cuenta, correo_electronico FROM usuarios_banca';
                        $stmtCuentas = $conn->prepare($qry);
                        //$stmtCuentas->bind_param('ii', $cuentaUser, $cuentaUser);

                        $stmtCuentas->execute();
                        $result2 = $stmtCuentas->get_result();

                        while ($row = $result2->fetch_assoc()) {
                            $displayValue = $row['no_cuenta'] . ' - ' . $row['correo_electronico'];
                            echo '<option value="' . $row['no_cuenta'] . '">' . $displayValue . '</option>';
                        }
                        ?>
                    </select>

                    <label class="form-label" for="nombre_cuenta">*Nombre de la Cuenta: </label>
                    <input class="form-input" type="text" maxlength="200" required id="nombre_cuenta" name="nombre_cuenta">

                    <label class="form-label" for="dpi">*DPI: </label>
                    <input class="form-input" type="number" maxlength="13" required id="dpi" name="dpi" placeholder="Documento de Identificación Personal">

                    <label class="form-label" for="monto_inicial">*Monto Inicial: </label>
                    <input class="form-input" type="number" maxlength="10" required id="monto_inicial" name="monto_inicial">

                    <input type="hidden" name="formulario_enviado" value="1">
                    <button class="form-button" type="submit" onclick="validar4(event)">Registrar Cuenta</button>
                </form>
            </div>
        </section>
    </div>
    <footer class="footer">
        <p>Todos los derechos reservados. Banco XYZ</p>
    </footer>
    <script src="../js/script.js"></script>
    <!-- Incluir SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</body>
</html>