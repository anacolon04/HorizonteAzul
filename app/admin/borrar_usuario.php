<?php
include 'es_admin.php';

require_once "../../sql/conexion.php";

$id = isset($_POST["id"]) ? (int)$_POST["id"] : 0;

if ($id > 0) {
    $stmt = $conn->prepare("DELETE FROM usuario WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

header("Location: crud_usuarios.php");
exit;