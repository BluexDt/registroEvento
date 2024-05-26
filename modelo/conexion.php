<?php
// Datos de conexión
$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'evento_ti'; 

// Conexión
$conexion = new mysqli($servername, $username, $password, $database);

// Comprobar conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}
?>
