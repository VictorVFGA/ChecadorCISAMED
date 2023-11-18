<?php
$servername = "db";
$username = "victor";
$password = "pass123";
$dbname = "checador";

// Conexión a la base de datos
$conexion = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conexion->connect_error) {
    die("La conexión falló: " . $conexion->connect_error);
}
?>
