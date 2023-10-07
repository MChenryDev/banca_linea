<?php 
session_start();
date_default_timezone_set('America/Mexico_City');
$fecha_actual = date('d/m/Y');
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
    <title>Monitor Transferencias</title>
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
                    Gestionar Cajeros
                </a>
                <!-- <a href="#"> -->
                <!-- <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chart-bar" width="32" height="32" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                  <path d="M3 12m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v6a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                  <path d="M9 8m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v10a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                  <path d="M15 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v14a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                  <path d="M4 20l14 0" />
                </svg>
                    Monitor de Transferencias
                </a> -->
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
                <div class="bloque">
                    <h3>Monitor Transferencias | Fecha: <?php echo $fecha_actual; ?></h3>
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chart-bar" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M3 12m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v6a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                        <path d="M9 8m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v10a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                        <path d="M15 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v14a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                        <path d="M4 20l14 0" />
                    </svg>
                </div>
                
                <canvas id="grafica"></canvas>
                <canvas id="grafica2"></canvas>
            </div>
            
        </section>
    </div>
    <footer class="footer">
        <p>Todos los derechos reservados. Banco Max</p>
    </footer>
<script src="../js/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    
// Funciones Graficos para monitor de transferencias:
function generarDatos() {
  // Datos ficticios
  var transacciones = [10, 20, 15, 25]; // Cantidad de transacciones realizadas en el día
  var usuarios = [5, 10, 8, 12];       // Cantidad de usuarios que han realizado transacciones
  var montos = [500, 800, 600, 900];   // Monto acumulado de transacciones en el día

  return {
      transacciones: transacciones,
      usuarios: usuarios,
      montos: montos
  };
}

function crearGrafica() {
    // Llamada AJAX para obtener los datos desde PHP
    fetch('obtenerTransacciones.php')
        .then(response => response.json())
        .then(data => {
            var ctx = document.getElementById('grafica').getContext('2d');
            var chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: data.horas,
                    datasets: [
                        {
                            label: 'Cantidad de transacciones',
                            data: data.transacciones,
                            backgroundColor: 'rgba(54, 162, 235, 0.6)'
                        },
                        {
                            label: 'Monto acumulado',
                            data: data.montos,
                            backgroundColor: 'rgba(255, 99, 132, 0.6)'
                        }
                    ]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        })
        .catch(error => console.error('Error al obtener datos:', error));

        fetch('obtenerUsuarios.php')
        .then(response => response.json())
        .then(data => {
            var ctx = document.getElementById('grafica2').getContext('2d');
            var chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: data.horas,
                    datasets: [
                        {
                            label: 'Cantidad de Usuarios que han realizado transacciones por hora',
                            data: data.usuarios,
                            backgroundColor: 'rgba(54, 162, 235, 0.6)'
                        }
                    ]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        })
        .catch(error => console.error('Error al obtener datos:', error));
}
window.onload = crearGrafica;





</script>
    
</body>
</html>