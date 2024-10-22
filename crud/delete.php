<?php
include 'config.php';

// Verificar si se pasó un ID
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];

// Borrar elemento
$sql = "DELETE FROM items WHERE id=$id";
$conn->query($sql);
header("Location: index.php");

$conn->close();
?>
