<?php 
session_start();
include '../config/db_connection.php';

$cuentaUser =  $_SESSION['noCuenta'];

$query = 'SELECT fecha_transaccion, id_tipo_transaccion, cuenta_destino, monto_transferido FROM bitacora_transacciones WHERE cuenta_origen = ? AND (id_tipo_transaccion = "D" OR id_tipo_transaccion = "C")';

$stmt = $conn->prepare($query);
$stmt->bind_param('i', $cuentaUser);

$stmt->execute();
$result = $stmt->get_result();

$query2 = 'SELECT monto_inicial FROM cuenta_monentaria
            WHERE no_cuenta = ?';

$stmt2 = $conn->prepare($query2);
$stmt2->bind_param('i', $cuentaUser);
$stmt2->execute();
$stmt2->bind_result($montoInicial);
$stmt2->fetch();
$stmt2->close();

?>
<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estado de Cuenta</title>
    <link rel="preload" href="../styles/normalize.css">
    <link rel="stylesheet" href="../styles/styles.css">
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
                
                <a href="index.php" onclick="logout()">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-logout" width="32" height="32" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                  <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" />
                  <path d="M9 12h12l-3 -3" />
                  <path d="M18 15l3 -3" />
                </svg>
                    Regresar
                </a>
        </nav>
        
    </div>
    <div class="container">
        <section >
            <div class="seccion">
                <div class="bloque">
                    <h3>Reporte Estado de Cuenta</h3>
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-cash-banknote" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M12 12m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                        <path d="M3 6m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v8a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z" />
                        <path d="M18 12l.01 0" />
                        <path d="M6 12l.01 0" />
                    </svg>
                </div>
                <h4>Usuario: <?php echo $_SESSION['nameUser'] ?></h4>
                <h4>Número de Cuenta: <?php echo $cuentaUser ?></h4>
                <h4>Saldo Actual: <?php echo $montoInicial ?></h4>
                <table border="1" class="estilo-tabla">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Cuenta Involucrada</th>
                            <th>Tipo Transacción</th>
                            <th>Monto</th>
                            <!-- Agrega más encabezados si es necesario -->
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>
                                        <td>" . $row["fecha_transaccion"] . "</td>
                                        <td>" . $row["cuenta_destino"] . "</td>
                                        <td>" . (($row["id_tipo_transaccion"] === 'D') ? 'Débito' : 'Crédito') . "</td>
                                        <td>" . $row["monto_transferido"] . "</td>
                                    </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='3'>No se encontro ningun movimiento.</td></tr>";
                        }
                        $conn->close();
                        ?>
                    </tbody>
                </table>
            </div>
        </section>
    </div>
    <footer class="footer">
        <p>Todos los derechos reservados. Banco Max</p>
    </footer>
    <script src="../js/script.js"></script>
</body>
</html>