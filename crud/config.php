<?php
$host = 'localhost';
$db = 'crud_example';
$user = 'root';
$pass = ''; // por defecto, no hay contraseña en XAMPP

// Crear conexión
$conn = new mysqli($host, $user, $pass, $db);

// Verificar conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
