<?php 
session_start();
$cuentaUser = $_SESSION['noCuenta'];

include '../config/db_connection.php';

// query que comprueba si la cuenta monetaria existe o no, si no existe hay que crearla desde el panel de cajero

$query = 'SELECT COUNT(*) AS cuenta_existe 
            FROM usuarios_banca as a 
            INNER JOIN cuenta_monentaria as b 
            ON a.no_cuenta = b.no_cuenta WHERE a.no_cuenta = ?';

$stmt = $conn->prepare($query);
$stmt->bind_param('i', $cuentaUser);

$stmt->execute();
$result = $stmt->get_result();

// Obtener el resultado de la cuenta
$row = $result->fetch_assoc();
$accountExists = $row['cuenta_existe'] == 1;



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Realizar Transferencia</title>
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
                
                <a href="agregar_cuentas_terceros.php">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-square-rounded-plus" width="32" height="32" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M9 12h6" />
                    <path d="M12 9v6" />
                    <path d="M12 3c7.2 0 9 1.8 9 9s-1.8 9 -9 9s-9 -1.8 -9 -9s1.8 -9 9 -9z" />
                </svg>
                    Agregar Cuenta de Terceros
                </a>
                <a href="estadoCuenta.php">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-coins" width="32" height="32" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M9 14c0 1.657 2.686 3 6 3s6 -1.343 6 -3s-2.686 -3 -6 -3s-6 1.343 -6 3z" />
                    <path d="M9 14v4c0 1.656 2.686 3 6 3s6 -1.344 6 -3v-4" />
                    <path d="M3 6c0 1.072 1.144 2.062 3 2.598s4.144 .536 6 0c1.856 -.536 3 -1.526 3 -2.598c0 -1.072 -1.144 -2.062 -3 -2.598s-4.144 -.536 -6 0c-1.856 .536 -3 1.526 -3 2.598z" />
                    <path d="M3 6v10c0 .888 .772 1.45 2 2" />
                    <path d="M3 11c0 .888 .772 1.45 2 2" />
                </svg>
                    Estado de Cuenta
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
                <h3>Transferencias</h3>
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrows-transfer-down" width="32" height="32" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M17 3v6" />
                    <path d="M10 18l-3 3l-3 -3" />
                    <path d="M7 21v-18" />
                    <path d="M20 6l-3 -3l-3 3" />
                    <path d="M17 21v-2" />
                    <path d="M17 15v-2" />
                </svg>
            </div>
                <?php
                if ($accountExists) {
                    // Mostrar el formulario solo si la cuenta existe
                ?>
                <p>
                    Hola, <?php echo $_SESSION['nameUser'] ?>! Aquí puedes Ingresar la información correspondiente para realizar tu transferencia a cuentas de terceros. Por favor, completa los siguientes campos.
                </p>
                <form action="procesaTransferencia.php" method="POST" id="miFormulario3">
                    <label class="form-label" for="cuenta_origen">Cuenta que realizará la transferencia: </label>
                    <input class="form-input" type="number" disabled value="<?php echo $_SESSION['noCuenta'] ?>">
                    <label class="form-label" for="cuenta_transferir">*Cuenta a la cuál se le hará la Transferencia: </label>
                    <select class="form-option" name="cuenta_transferir" id="cuenta_transferir" required onchange="actualizarInfoCuenta()">
                        <option selected value="" disabled>- Selecciona una opción -</option>
                        <?php 
                        // Para listar las cuentas que ha registrado el usuario conectado
                        $qry = 'SELECT no_cuenta, alias_cuenta_tercero FROM cuentas_terceros WHERE cuenta_agrego = ?
                                AND no_cuenta != ?';
                        $stmtCuentas = $conn->prepare($qry);
                        $stmtCuentas->bind_param('ii', $cuentaUser, $cuentaUser);

                        $stmtCuentas->execute();
                        $result2 = $stmtCuentas->get_result();

                        while ($row = $result2->fetch_assoc()) {
                            $displayValue = $row['no_cuenta'] . ' - ' . $row['alias_cuenta_tercero'];
                            echo '<option value="' . $row['no_cuenta'] . '">' . $displayValue . '</option>';
                        }
                        ?>
                    </select>

                    <label style="color:dimgray" class="form-label" for="">Monto Máximo a transferir: <span id="info_monto_maximo"></span></label><br>
                    <label style="color:dimgray" class="form-label" for="">Máximo de transferencias por día para esta cuenta: <span id="info_max_transferencias"></span></label><br>

                    <!-- Campos ocultos -->
                    <input type="hidden" name="monto_maximo" id="monto_maximo" value="">
                    <input type="hidden" name="cant_maxima_dia" id="cant_maxima_dia" value="">

                    <label class="form-label" for="cantida_transferir">Cantidad a Transferir</label>
                    <input class="form-input" type="number" name="cantida_transferir" id="cantida_transferir"> 
                    
                    <input type="hidden" name="formulario_enviado" value="1">
                    <button class="form-button" type="submit" onclick="validar3(event)">Realizar Transferencia</button>
                </form>
                <?php
                } else {
                    // Mostrar un mensaje si la cuenta no existe
                    echo '<p>Tu usuario no tiene ninguna cuenta monetaria asociada, por favor, crea tu cuenta monetaria abocándote con un cajero para poder realizar transferencias a cuentas de terceros.<br><br><br><br><br><br><br><br><br><br><br><br><br></p>';
                }
                ?>
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
        function actualizarInfoCuenta() { // Para mostrar la informacion de la cuenta de tercero, maximo a transferir y maximo transferencias al dia
            var selectedCuenta = document.getElementById("cuenta_transferir").value;

            // Aquí puedes hacer una llamada AJAX para obtener la información de la cuenta
            // Supongamos que la información está disponible en una variable llamada cuentasInfo

            // Ejemplo de cómo obtener la información y actualizar los elementos span
            var cuentaInfo = cuentasInfo[selectedCuenta]; // Suponiendo que cuentasInfo es un objeto con la información de cada cuenta
            if (cuentaInfo) {
                document.getElementById("info_monto_maximo").innerText = cuentaInfo.monto_maximo;
                document.getElementById("info_max_transferencias").innerText = cuentaInfo.cant_maxima_dia;

                // Obtener y almacenar el límite de transferencias diarias
                var limiteTransferenciasDiarias = cuentaInfo.cant_maxima_dia;
                document.getElementById("info_max_transferencias").innerText = limiteTransferenciasDiarias;

                // Almacenar el límite de transferencias diarias en el campo oculto
                document.getElementById("cant_maxima_dia").value = cuentaInfo.cant_maxima_dia;
                document.getElementById("monto_maximo").value = cuentaInfo.monto_maximo;
                
            }
        }
    </script>

    <?php // Esto es para mandar un JSON y para que sea consumido por medio de javascript para mostrar info de monto maximo y maximas transaccioens por dia
    $cuentasInfo = array(); // Aquí almacenarás la información de cada cuenta

    // Obtener información de cada cuenta y almacenarla en $cuentasInfo
    $queryCuentas = 'SELECT no_cuenta, monto_maximo, cant_maxima_dia FROM cuentas_terceros';
    $resultCuentas = $conn->query($queryCuentas);

    while ($rowCuenta = $resultCuentas->fetch_assoc()) {
        $cuentasInfo[$rowCuenta['no_cuenta']] = array(
            'monto_maximo' => $rowCuenta['monto_maximo'],
            'cant_maxima_dia' => $rowCuenta['cant_maxima_dia']
        );
    }

    echo '<script>';
    echo 'var cuentasInfo = ' . json_encode($cuentasInfo) . ';'; // Convertir a JSON para que JavaScript pueda usarlo
    echo '</script>';
    ?>  
</body>
</html>