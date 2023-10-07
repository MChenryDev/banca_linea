<?php
header('WWW-Authenticate: Basic realm="Mi Dominio"');
header('HTTP/1.0 401 Unauthorized');
?>