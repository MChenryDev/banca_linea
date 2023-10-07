<?php

session_start();

session_destroy();
session_unset();

unset($_SESSION["nameUser"]);
//$_SESSION = [];

echo "La sesión ha sido destruida.";

header("Location: index.php");  // Redirigir a la página de inicio de sesión u otra página apropiada

exit();
?>