<?php
include 'es_admin.php';

require_once "../../sql/conexion.php";

$id = isset($_POST['id_viaje']) ? (int)$_POST['id_viaje'] : 0;

if ($id > 0) {
    $stmt = $conn->prepare("DELETE FROM viaje WHERE id_viaje = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

header("Location: crud_viajes.php");
exit;
