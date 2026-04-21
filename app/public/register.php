<?php
require_once "../../sql/conexion.php";

$username = $password = $confirm_password = $email = "";
$username_err = $password_err = $confirm_password_err = $email_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validar username
    if (empty(trim($_POST["username"]))) {
        $username_err = "Por favor, introduce un nombre de usuario.";
    } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))) {
        $username_err = "El nombre solo puede contener letras, números y guiones bajos.";
    } else {
        $username = trim($_POST["username"]);
        $stmt = $conn->prepare("SELECT id FROM usuario WHERE nombre = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        if ($stmt->get_result()->num_rows > 0) {
            $username_err = "Este nombre de usuario ya está en uso.";
        }
        $stmt->close();
    }

    // Validar email
    if (empty(trim($_POST["email"]))) {
        $email_err = "Por favor, introduce un email.";
    } elseif (!filter_var(trim($_POST["email"]), FILTER_VALIDATE_EMAIL)) {
        $email_err = "El formato del email no es válido.";
    } else {
        $email = trim($_POST["email"]);
        $stmt = $conn->prepare("SELECT id FROM usuario WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        if ($stmt->get_result()->num_rows > 0) {
            $email_err = "Este email ya está registrado.";
        }
        $stmt->close();
    }

    // Validar password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Por favor, introduce una contraseña.";
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $password_err = "La contraseña debe tener al menos 6 caracteres.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validar confirmar password
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Por favor, confirma la contraseña.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "Las contraseñas no coinciden.";
        }
    }

    // Insertar si no hay errores
    if (empty($username_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err)) {
        $stmt = $conn->prepare("INSERT INTO usuario (nombre, email, password) VALUES (?, ?, ?)");
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bind_param("sss", $username, $email, $hash);
        if ($stmt->execute()) {
            header("location: login.php");
            exit;
        } else {
            echo "Error al registrar. Inténtalo más tarde.";
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Sign Up</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <?php include '../assets/css_formulario.php' ?>
    </head>
    <body>
        <!-- Header -->
        <?php include '../vistas/header.php' ?>
        <div class="main-content">
            <div class="wrapper">
                <h2>Regístrate</h2>
                <p>Por favor rellena el formulario para crear una cuenta.</p>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group">
                        <label>Nombre de usuario</label>
                        <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                        <span class="invalid-feedback"><?php echo $username_err; ?></span>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" 
                               class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" 
                               value="<?php echo $email; ?>">
                        <span class="invalid-feedback"><?php echo $email_err; ?></span>
                    </div>

                    <div class="form-group">
                        <label>Contraseña</label>
                        <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                        <span class="invalid-feedback"><?php echo $password_err; ?></span>
                    </div>
                    <div class="form-group">
                        <label>Confirmar contraseña</label>
                        <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                        <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Regístrate">
                        <input type="reset" class="btn btn-secondary ml-2" value="Borrar todo">
                    </div>
                    <p>Ya tienes una cuenta? <a href="login.php">Accede aquí</a></p>
                </form>
            </div>
        </div>

        <!-- FOOTER -->
        <?php include '../vistas/footer.php' ?>b
    </body>
</html>