<?php
include 'es_admin.php';

require_once "../../sql/conexion.php";

$err = "";

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
        $stmt = $conn->prepare("INSERT INTO usuario (nombre, email, password, rol) VALUES (?, ?, ?, ?)");
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bind_param("ssss", $nombre, $email, $hash, $rol);
        if ($stmt->execute()) {
            $stmt->close();
            header("Location: crud_usuarios.php");
            exit;
        } else {
            $err = "Error al insertar el usuario.";
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Crear usuario</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <?php include '../assets/css_formulario.php' ?>
    </head>
    <body>

        <?php include '../vistas/header.php' ?>

        <div class="main-content">
            <div class="wrapper">
                <h2>Crear usuario</h2>
                <p>Rellena todos los campos.</p>

                <?php if (!empty($err)): ?>
                    <div class="alert alert-danger"><?php echo htmlspecialchars($err); ?></div>
                <?php endif; ?>

                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" name="nombre" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Contraseña</label>
                        <input type="text" name="password" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Rol</label>
                        <select name="rol" class="form-control" required>
                            <option value="">Selecciona...</option>
                            <option value="admin">admin</option>
                            <option value="user">user</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Crear usuario">
                        <a href="crud_usuarios.php" class="btn btn-link">Volver</a>
                    </div>
                </form>
            </div>
        </div>

        <?php include '../vistas/footer.php' ?>
    </body>
</html>
