<?php
include 'es_admin.php';

require_once "../../sql/conexion.php";

$err = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $titulo       = trim($_POST["titulo"] ?? "");
    $descripcion  = trim($_POST["descripcion"] ?? "");
    $fecha_inicio = $_POST["fecha_inicio"] ?? "";
    $fecha_fin    = $_POST["fecha_fin"] ?? "";
    $precio       = $_POST["precio"] ?? "";
    $destacado    = $_POST["destacado"] ?? "";
    $tipo_viaje   = trim($_POST["tipo_viaje"] ?? "");
    $plazas       = $_POST["plazas"] ?? "";
    $imagen       = trim($_POST["imagen"] ?? "");

    // Todos obligatorios
    if ($titulo === "" || $descripcion === "" || $fecha_inicio === "" || $fecha_fin === "" ||
        $precio === "" || $destacado === "" || $tipo_viaje === "" || $plazas === "" || $imagen === "") {
        $err = "Todos los campos son obligatorios.";
    } else {

        $stmt = $conn->prepare("INSERT INTO viaje
                (titulo, descripcion, fecha_inicio, fecha_fin, precio, destacado, tipo_viaje, plazas, imagen)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

        $destacado_int = (int)$destacado;
        $plazas_int = (int)$plazas;
        $precio_float = (float)$precio;

        $stmt->bind_param(
            "ssssdisis",
            $titulo,
            $descripcion,
            $fecha_inicio,
            $fecha_fin,
            $precio_float,
            $destacado_int,
            $tipo_viaje,
            $plazas_int,
            $imagen
        );

        if ($stmt->execute()) {
            $stmt->close();
            header("Location: crud_viajes.php");
            exit;
        } else {
            $err = "Error al insertar el viaje.";
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear viaje</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <?php include '../assets/css_formulario.php' ?>
</head>
<body>

<!-- Header -->
<?php include '../vistas/header.php' ?>

<div class="main-content">
    <div class="wrapper">
        <h2>Crear nuevo viaje</h2>
        <p>Rellena todos los campos.</p>

        <?php if (!empty($err)): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($err); ?></div>
        <?php endif; ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

            <div class="form-group">
                <label>Título</label>
                <input type="text" name="titulo" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Descripción</label>
                <textarea name="descripcion" class="form-control" rows="4" required></textarea>
            </div>

            <div class="form-group">
                <label>Fecha inicio</label>
                <input type="date" name="fecha_inicio" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Fecha fin</label>
                <input type="date" name="fecha_fin" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Precio (€)</label>
                <input type="number" step="0.01" name="precio" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Destacado</label>
                <select name="destacado" class="form-control" required>
                    <option value="">Selecciona...</option>
                    <option value="1">Sí</option>
                    <option value="0">No</option>
                </select>
            </div>

            <div class="form-group">
                <label>Tipo de viaje</label>
                <input type="text" name="tipo_viaje" class="form-control" placeholder="Aventura, cultural, relax..." required>
            </div>

            <div class="form-group">
                <label>Plazas</label>
                <input type="number" name="plazas" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Imagen (nombre del archivo)</label>
                <input type="text" name="imagen" class="form-control" placeholder="ej: italia.jpg" required>
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Crear viaje">
                <a href="crud_viajes.php" class="btn btn-link">Volver</a>
            </div>

        </form>
    </div>
</div>

<!-- Footer -->
<?php include '../vistas/footer.php' ?>

</body>
</html>
