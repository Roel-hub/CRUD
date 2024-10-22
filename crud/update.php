<?php
include 'config.php';

// Verificar si se pasó un ID
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];

// Leer el elemento
$sql = "SELECT * FROM items WHERE id = $id";
$result = $conn->query($sql);
$item = $result->fetch_assoc();

// Actualizar elemento
if (isset($_POST['update'])) {
    $nombre = $_POST['nombre'];
    $edad = $_POST['edad'];
    $puesto = $_POST['puesto'];
    $categoria = $_POST['categoria'];
    $fecha_alta = $_POST['fecha_alta'];
    $fecha_baja = !empty($_POST['fecha_baja']) ? $_POST['fecha_baja'] : NULL;
    $comentarios = $_POST['comentarios'];

    $sql = "UPDATE items SET nombre='$nombre', edad=$edad, puesto='$puesto', categoria='$categoria', fecha_alta='$fecha_alta', fecha_baja='$fecha_baja', comentarios='$comentarios' WHERE id=$id";
    $conn->query($sql);
    header("Location: index.php");
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Item</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Actualizar Item</h1>
        <div class="card">
            <div class="card-body">
                <form method="POST">
                    <div class="mb-3">
                        <input type="text" name="nombre" class="form-control" value="<?php echo $item['nombre']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <input type="number" name="edad" class="form-control" value="<?php echo $item['edad']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <input type="text" name="puesto" class="form-control" value="<?php echo $item['puesto']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <input type="text" name="categoria" class="form-control" value="<?php echo $item['categoria']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="fecha_alta" class="form-label">Fecha Alta</label>
    <input type="date" name="fecha_alta" class="form-control" value="<?php echo $item['fecha_alta']; ?>" required>
</div>
<div class="mb-3">
    <label for="fecha_baja" class="form-label">Fecha Baja (Opcional)</label>
    <input type="date" name="fecha_baja" class="form-control" value="<?php echo $item['fecha_baja']; ?>">
</div>
<div class="mb-3">
    <textarea name="comentarios" class="form-control" rows="3"><?php echo $item['comentarios']; ?></textarea>
</div>
<button type="submit" name="update" class="btn btn-primary">Actualizar</button>
</form>
</div>
</div>
<a href="index.php" class="btn btn-secondary mt-3">Regresar</a>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
