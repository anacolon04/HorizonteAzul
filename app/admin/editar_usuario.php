<?php
include 'es_admin.php';

require_once "../../sql/conexion.php";

$err = "";
//si no encuentra el id coge el 0 y se queda en la pagina del crud
$id = isset($_GET["id"]) ? (int) $_GET["id"] : 0;
if ($id <= 0) {
    header("Location: crud_usuarios.php");
    exit;
}

// Cargar usuario
$stmt = $conn->prepare("SELECT id, nombre, email, password, rol FROM usuario WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$user) {
    header("Location: crud_usuarios.php");
    exit;
}

// Actualizar
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = trim($_POST["nombre"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $password = trim($_POST["password"] ?? "");
    $rol = $_POST["rol"] ?? "";

    if ($nombre === "" || $email === "" || $password === "" || $rol === "") {
        $err = "Todos los campos son obligatorios.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $err = "El email no es válido.";
    } else {
        $stmt = $conn->prepare("UPDATE usuario SET nombre = ?, email = ?, password = ?, rol = ? WHERE id = ?");
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bind_param("ssssi", $nombre, $email, $hash, $rol, $id);
        if ($stmt->execute()) {
            $stmt->close();
            header("Location: crud_usuarios.php");
            exit;
        } else {
            $err = "Error al actualizar el usuario.";
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Editar usuario</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <?php include '../assets/css_formulario.php' ?>
    </head>
    <body>

        <?php include '../vistas/header.php' ?>

        <div class="main-content">
            <div class="wrapper">
                <h2>Editar usuario</h2>

                <?php if (!empty($err)): ?>
                    <div class="alert alert-danger"><?php echo htmlspecialchars($err); ?></div>
                <?php endif; ?>

                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?id=" . (int) $user["id"]; ?>" method="post">
                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" name="nombre" class="form-control" required
                               value="<?php echo htmlspecialchars($user["nombre"]); ?>">
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required
                               value="<?php echo htmlspecialchars($user["email"]); ?>">
                    </div>

                    <div class="form-group">
                        <label>Contraseña</label>
                        <input type="password" name="password" class="form-control" required
                               placeholder="Nueva contraseña">
                    </div>

                    <div class="form-group">
                        <label>Rol</label>
                        <select name="rol" class="form-control" required>
                            <option value="">Selecciona...</option>
                            <option value="admin" <?php echo ($user["rol"] === "admin") ? "selected" : ""; ?>>admin</option>
                            <option value="user"  <?php echo ($user["rol"] === "user") ? "selected" : ""; ?>>user</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Guardar cambios">
                        <a href="crud_usuarios.php" class="btn btn-link">Volver</a>
                    </div>
                </form>
            </div>
        </div>

        <?php include '../vistas/footer.php' ?>
    </body>
</html>
