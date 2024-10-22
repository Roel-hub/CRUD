<?php
include 'config.php';

// Insertar nuevo elemento
if (isset($_POST['submit'])) {
    $nombre = $_POST['nombre'];
    $edad = $_POST['edad'];
    $puesto = $_POST['puesto'];
    $categoria = $_POST['categoria'];
    $fecha_alta = $_POST['fecha_alta'];
    $fecha_baja = !empty($_POST['fecha_baja']) ? $_POST['fecha_baja'] : NULL;
    $comentarios = $_POST['comentarios'];

    $sql = "INSERT INTO items (nombre, edad, puesto, categoria, fecha_alta, fecha_baja, comentarios) 
            VALUES ('$nombre', $edad, '$puesto', '$categoria', '$fecha_alta', '$fecha_baja', '$comentarios')";
    $conn->query($sql);
}

// Leer elementos
$sql = "SELECT * FROM items";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD con Múltiples Campos</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">CRUD con Múltiples Campos</h1>

        <!-- Formulario para agregar items -->
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Agregar Nuevo Item</h5>
                <form method="POST">
                    <div class="mb-3">
                        <input type="text" name="nombre" class="form-control" placeholder="Nombre" required>
                    </div>
                    <div class="mb-3">
                        <input type="number" name="edad" class="form-control" placeholder="Edad" required>
                    </div>
                    <div class="mb-3">
                        <input type="text" name="puesto" class="form-control" placeholder="Puesto" required>
                    </div>
                    <div class="mb-3">
                        <input type="text" name="categoria" class="form-control" placeholder="Categoría" required>
                    </div>
                    <div class="mb-3">
                        <label for="fecha_alta" class="form-label">Fecha Alta</label>
                        <input type="date" name="fecha_alta" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="fecha_baja" class="form-label">Fecha Baja (Opcional)</label>
                        <input type="date" name="fecha_baja" class="form-control">
                    </div>
                    <div class="mb-3">
                        <textarea name="comentarios" class="form-control" placeholder="Comentarios" rows="3"></textarea>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Agregar</button>
                </form>
            </div>
        </div>

        <!-- Lista de Items -->
        <h2 class="mb-3">Lista de Items</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Edad</th>
                    <th scope="col">Puesto</th>
                    <th scope="col">Categoría</th>
                    <th scope="col">Fecha Alta</th>
                    <th scope="col">Fecha Baja</th>
                    <th scope="col">Comentarios</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <th scope="row"><?php echo $row['id']; ?></th>
                            <td><?php echo $row['nombre']; ?></td>
                            <td><?php echo $row['edad']; ?></td>
                            <td><?php echo $row['puesto']; ?></td>
                            <td><?php echo $row['categoria']; ?></td>
                            <td><?php echo $row['fecha_alta']; ?></td>
                            <td><?php echo $row['fecha_baja'] ?: 'N/A'; ?></td>
                            <td><?php echo $row['comentarios']; ?></td>
                            <td>
                                <a href="update.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Actualizar</a>
                                <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">Borrar</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="9" class="text-center">No hay items aún.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
