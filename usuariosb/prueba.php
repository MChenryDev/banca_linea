<!DOCTYPE html>
<html>
<head>
    <title>Estado de Cuenta</title>
</head>
<body>
    <h1>Estado de Cuenta</h1>
    
    <h2>Saldo actual: $1000.00</h2>

    <h3>Transacciones Recientes:</h3>
    <ul>
        <li>Fecha: 2023-09-30 | Descripción: Pago de factura de luz | Monto: $50.00</li>
        <li>Fecha: 2023-09-29 | Descripción: Depósito de salario | Monto: $1000.00</li>
        <!-- ... Otras transacciones ... -->
    </ul>

    <label for="startDate">Desde:</label>
    <input type="date" id="startDate">
    <label for="endDate">Hasta:</label>
    <input type="date" id="endDate">
    <button onclick="filtrarPorFecha()">Filtrar</button>

    <script>
        function filtrarPorFecha() {
            var startDate = document.getElementById("startDate").value;
            var endDate = document.getElementById("endDate").value;

            // Lógica para filtrar transacciones por fecha y actualizar la presentación
            // ...

            // Ejemplo de actualización de datos
            document.querySelector('ul').innerHTML = '<li>Fecha: 2023-09-29 | Descripción: Depósito de salario | Monto: $1000.00</li>';
        }
    </script>
</body>
</html>