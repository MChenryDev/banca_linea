<?php 
session_start();

include '../config/db_connection.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Retiro Monetario</title>
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
                    Deposito Monetario
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
        <section>
            <div class="seccion">
            <div class="bloque">
                <h3>Retiro Monetario</h3>
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-moneybag" width="40" height="40" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M9.5 3h5a1.5 1.5 0 0 1 1.5 1.5a3.5 3.5 0 0 1 -3.5 3.5h-1a3.5 3.5 0 0 1 -3.5 -3.5a1.5 1.5 0 0 1 1.5 -1.5z" />
                    <path d="M4 17v-1a8 8 0 1 1 16 0v1a4 4 0 0 1 -4 4h-8a4 4 0 0 1 -4 -4z" />
                </svg>
            </div>
                
                <p>
                    Hola, <?php echo $_SESSION['nameUser'] ?>! Aquí puedes Ingresar la información correspondiente para realizar retiros a cuentas monetarias. Por favor, completa los siguientes campos.
                </p>
                <form action="procesaRetiro.php" method="POST" id="miFormulario6">
                    <label class="form-label" for="cuenta_retiro">*Cuenta a la cuál se le hará el retiro: </label>
                    <select class="form-option" name="cuenta_retiro" id="cuenta_retiro" required  onchange="actualizarInfoCuenta()">
                        <option selected value="" disabled>- Selecciona una opción -</option>
                        <?php 
                        // Para listar las cuentas monetarias
                        $qry = 'SELECT no_cuenta, nombre_cuenta FROM cuenta_monentaria';
                        $stmtCuentas = $conn->prepare($qry);

                        $stmtCuentas->execute();
                        $result2 = $stmtCuentas->get_result();

                        while ($row = $result2->fetch_assoc()) {
                            $displayValue = $row['no_cuenta'] . ' - ' . $row['nombre_cuenta'];
                            echo '<option value="' . $row['no_cuenta'] . '">' . $displayValue . '</option>';
                        }
                        ?>
                    </select>
                    <label style="color:dimgray" class="form-label" for="">Saldo de cuenta Seleccionada: <span id="info_saldo"></span></label><br>
                    <!-- Campos ocultos -->
                    <input type="hidden" name="saldo_cuenta" id="saldo_cuenta" value="">

                    <label class="form-label" for="cantidad_retiro">Cantidad a Retirar</label>
                    <input class="form-input" type="numb" name="cantidad_retiro" id="cantidad_retiro" required>
                    
                    <input type="hidden" name="formulario_enviado" value="1">
                    <button class="form-button" type="submit" onclick="validar6(event)">Realizar Retiro</button>
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
    <script>
        function actualizarInfoCuenta() { 
            var selectedCuenta = document.getElementById("cuenta_retiro").value;

            // Ejemplo de cómo obtener la información y actualizar los elementos span
            var cuentaInfo = cuentasInfo[selectedCuenta]; // Suponiendo que cuentasInfo es un objeto con la información de cada cuenta
            if (cuentaInfo) {
                document.getElementById("info_saldo").innerText = cuentaInfo.monto_inicial;

                // Obtener y almacenar el saldo actual de la cuenta
                var saldoCuenta = cuentaInfo.monto_inicial;
                document.getElementById("info_saldo").innerText = saldoCuenta;

                // Almacenar el saldo de la cuenta en el campo oculto
                document.getElementById("saldo_cuenta").value = cuentaInfo.monto_inicial;
                
            }
        }
    </script>


    <?php // Esto es para mandar un JSON y para que sea consumido por medio de javascript para mostrar info de saldo actual de la cuenta
    $cuentasInfo = array(); // Aquí se almacenará la información de cada cuenta

    // Obtener información de cada cuenta y almacenarla en $cuentasInfo
    $queryCuentas = 'SELECT no_cuenta, monto_inicial FROM cuenta_monentaria';
    $resultCuentas = $conn->query($queryCuentas);

    while ($rowCuenta = $resultCuentas->fetch_assoc()) {
        $cuentasInfo[$rowCuenta['no_cuenta']] = array(
            'monto_inicial' => $rowCuenta['monto_inicial']
        );
    }

    echo '<script>';
    echo 'var cuentasInfo = ' . json_encode($cuentasInfo) . ';'; // Convertir a JSON para que JavaScript pueda usarlo
    echo '</script>';
    ?>  
</body>
</html>