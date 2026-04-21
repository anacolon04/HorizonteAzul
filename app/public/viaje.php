<?php
require_once "../../sql/conexion.php";

$id = isset($_GET["id"]) ? (int) $_GET["id"] : 0;
if ($id <= 0) {
    die("Viaje no válido.");
}

$sql = "SELECT id_viaje, titulo, fecha_inicio, fecha_fin, precio, tipo_viaje, plazas, imagen, descripcion
        FROM viaje
        WHERE id_viaje = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$res = $stmt->get_result();

if ($res->num_rows === 0) {
    die("Viaje no encontrado.");
}
$fila = $res->fetch_assoc();

$titulo = htmlspecialchars($fila["titulo"]);
$tipo = htmlspecialchars($fila["tipo_viaje"] ?? "");
$plazas = (int) ($fila["plazas"] ?? 0);
$precio = number_format((float) $fila["precio"], 2, ",", ".");
$inicio = date("d/m/Y", strtotime($fila["fecha_inicio"]));
$fin = date("d/m/Y", strtotime($fila["fecha_fin"]));

$imagen = !empty($fila["imagen"]) ? "../assets/imagenes/" . htmlspecialchars($fila["imagen"]) : "img/default.jpg";

$descripcion = isset($fila["descripcion"]) ? trim($fila["descripcion"]) : "";
$descripcion = htmlspecialchars($descripcion);
?>
<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $titulo; ?></title>
        <?php include '../assets/css_viaje.php' ?>
    </head>

    <body>

        <!-- Header -->
        <?php include '../vistas/header.php' ?>

        <!-- Menú -->
        <?php include '../vistas/menu.php' ?>

        <div class="wrap">
            <a class="btn" href="index.php">← Volver</a>

            <h1><?php echo $titulo; ?></h1>

            <div class="img" style="background-image:url('<?php echo $imagen; ?>')"></div>

            <div class="box">
                <div class="meta">
                    <div><b>Fechas:</b> <?php echo $inicio; ?> – <?php echo $fin; ?></div>
                    <div><b>Precio:</b> <?php echo $precio; ?> €</div>
                    <?php if ($tipo !== ""): ?>
                        <div><b>Tipo:</b> <?php echo $tipo; ?></div>
                    <?php endif; ?>
                    <?php if ($plazas > 0): ?>
                        <div><b>Plazas:</b> <?php echo $plazas; ?></div>
                    <?php endif; ?>
                </div>

                <?php if ($descripcion !== ""): ?>
                    <p><?php echo nl2br($descripcion); ?></p>
                <?php endif; ?>

                <a class="btn primary" href="#">Reservar</a>
            </div>
        </div>

        <!-- FOOTER -->
        <?php include '../vistas/footer.php' ?>
    </body>
</html>
