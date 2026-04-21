<?php
include 'es_admin.php';

require_once "../../sql/conexion.php";

$err = "";
//si no encuentra el id coge el 0 y se queda en la pagina del crud
$id = isset($_GET["id"]) ? (int) $_GET["id"] : 0;
if ($id <= 0) {
    header("Location: crud_viajes.php");
    exit;
}

// Cargar viaje actual
$stmt = $conn->prepare("SELECT id_viaje, titulo, descripcion, fecha_inicio, fecha_fin, precio, destacado, tipo_viaje, plazas, imagen
        FROM viaje WHERE id_viaje = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$viaje = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$viaje) {
    header("Location: crud_viajes.php");
    exit;
}

// Si se envía el formulario -> actualizar (SIN imagen)
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $titulo = trim($_POST["titulo"] ?? "");
    $descripcion = trim($_POST["descripcion"] ?? "");
    $fecha_inicio = $_POST["fecha_inicio"] ?? "";
    $fecha_fin = $_POST["fecha_fin"] ?? "";
    $precio = $_POST["precio"] ?? "";
    $destacado = $_POST["destacado"] ?? "";
    $tipo_viaje = trim($_POST["tipo_viaje"] ?? "");
    $plazas = $_POST["plazas"] ?? "";

    // Todos obligatorios
    if ($titulo === "" || $descripcion === "" || $fecha_inicio === "" || $fecha_fin === "" ||
            $precio === "" || $destacado === "" || $tipo_viaje === "" || $plazas === "") {
        $err = "Todos los campos son obligatorios.";
    } else {

        $stmt = $conn->prepare("UPDATE viaje
                  SET titulo = ?, descripcion = ?, fecha_inicio = ?, fecha_fin = ?, precio = ?, destacado = ?, tipo_viaje = ?, plazas = ?
                  WHERE id_viaje = ?");

        $destacado_int = (int) $destacado;
        $plazas_int = (int) $plazas;
        $precio_float = (float) $precio;

        $stmt->bind_param(
            "ssssdisii",
            $titulo,
            $descripcion,
            $fecha_inicio,
            $fecha_fin,
            $precio_float,
            $destacado_int,
            $tipo_viaje,
            $plazas_int,
            $id
        );
            
        if ($stmt->execute()) {
            $stmt->close();
            header("Location: crud_viajes.php");
            exit;
        } else {
            $err = "Error al actualizar el viaje.";
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Editar viaje</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <?php include '../assets/css_formulario.php' ?>
    </head>
    <body>

        <!-- Header -->
        <?php include '../vistas/header.php' ?>

        <div class="main-content">
            <div class="wrapper">
                <h2>Editar viaje</h2>

                <?php if (!empty($err)): ?>
                    <div class="alert alert-danger"><?php echo htmlspecialchars($err); ?></div>
                <?php endif; ?>

                <!-- Info no editable -->
                <div class="alert alert-light border">
                    <strong>ID:</strong> <?php echo (int) $viaje["id_viaje"]; ?><br>
                    <strong>Imagen:</strong> <?php echo htmlspecialchars($viaje["imagen"]); ?>
                </div>

                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?id=" . (int) $viaje["id_viaje"]; ?>" method="post">

                    <div class="form-group">
                        <label>Título</label>
                        <input type="text" name="titulo" class="form-control" required
                               value="<?php echo htmlspecialchars($viaje["titulo"]); ?>">
                    </div>

                    <div class="form-group">
                        <label>Descripción</label>
                        <textarea name="descripcion" class="form-control" rows="4" required><?php
                            echo htmlspecialchars($viaje["descripcion"]);
                            ?></textarea>
                    </div>

                    <div class="form-group">
                        <label>Fecha inicio</label>
                        <input type="date" name="fecha_inicio" class="form-control" required
                               value="<?php echo htmlspecialchars($viaje["fecha_inicio"]); ?>">
                    </div>

                    <div class="form-group">
                        <label>Fecha fin</label>
                        <input type="date" name="fecha_fin" class="form-control" required
                               value="<?php echo htmlspecialchars($viaje["fecha_fin"]); ?>">
                    </div>

                    <div class="form-group">
                        <label>Precio (€)</label>
                        <input type="number" step="0.01" name="precio" class="form-control" required
                               value="<?php echo htmlspecialchars($viaje["precio"]); ?>">
                    </div>

                    <div class="form-group">
                        <label>Destacado</label>
                        <select name="destacado" class="form-control" required>
                            <option value="">Selecciona...</option>
                            <option value="1" <?php echo ((int) $viaje["destacado"] === 1) ? "selected" : ""; ?>>Sí</option>
                            <option value="0" <?php echo ((int) $viaje["destacado"] === 0) ? "selected" : ""; ?>>No</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Tipo de viaje</label>
                        <input type="text" name="tipo_viaje" class="form-control" required
                               value="<?php echo htmlspecialchars($viaje["tipo_viaje"]); ?>">
                    </div>

                    <div class="form-group">
                        <label>Plazas</label>
                        <input type="number" name="plazas" class="form-control" required
                               value="<?php echo htmlspecialchars($viaje["plazas"]); ?>">
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Guardar cambios">
                        <a href="crud_viajes.php" class="btn btn-link">Volver</a>
                    </div>

                </form>
            </div>
        </div>

        <!-- Footer -->
        <?php include '../vistas/footer.php' ?>

    </body>
</html>
