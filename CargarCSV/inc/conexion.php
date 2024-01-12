<?php
$host = "127.0.0.1"; // el nombre del servidor donde se encuentra la base de datos
$user = "root"; // el nombre de usuario para acceder a la base de datos
$password = "lamp"; // la contraseña para acceder a la base de datos
$dbname = "pruebas"; // el nombre de la base de datos

// crear una conexión
$conexion = mysqli_connect($host, $user, $password, $dbname);

// verificar si la conexión se ha establecido correctamente
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}
?>
