<?php
session_start();

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: index.php");
    exit;
}

require_once "../../sql/conexion.php";

$username = $password = "";
$username_err = $password_err = $login_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty(trim($_POST["username"]))) {
        $username_err = "Por favor, introduce tu nombre de usuario.";
    } else {
        $username = trim($_POST["username"]);
    }

    if (empty(trim($_POST["password"]))) {
        $password_err = "Por favor, introduce tu contraseña.";
    } else {
        $password = trim($_POST["password"]);
    }

    if (empty($username_err) && empty($password_err)) {
        $stmt = $conn->prepare("SELECT id, nombre, password, rol FROM usuario WHERE nombre = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            if (password_verify($password, $row["password"])) {
                $_SESSION["loggedin"] = true;
                $_SESSION["id"] = $row["id"];
                $_SESSION["username"] = $row["nombre"];
                $_SESSION["rol"] = $row["rol"];
                header("location: index.php");
                exit;
            } else {
                $login_err = "Usuario o contraseña incorrectos.";
            }
        } else {
            $login_err = "Usuario o contraseña incorrectos.";
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <?php include '../assets/css_formulario.php' ?>
    </head>
    <body>
        <!-- Header -->
        <?php include '../vistas/header.php' ?>
        
        <!-- Menú -->
        <?php include '../vistas/menu.php' ?>
        
        <div class="main-content">
            <div class="wrapper">
                <h2>Bienvenido a Horizonte azul</h2>
                <p>Accede con tu usuario.</p>

                <?php
                if (!empty($login_err)) {
                    echo '<div class="alert alert-danger">' . $login_err . '</div>';
                }
                ?>

                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group">
                        <label>Nombre de usuario</label>
                        <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                        <span class="invalid-feedback"><?php echo $username_err; ?></span>
                    </div>    
                    <div class="form-group">
                        <label>Contraseña</label>
                        <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                        <span class="invalid-feedback"><?php echo $password_err; ?></span>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Acceder">
                    </div>
                    <p>No tienes una cuenta todavía? <a href="register.php">Regístrate aquí!</a></p>
                </form>
            </div>
        </div>
        <!-- FOOTER -->
        <?php include '../vistas/footer.php' ?>
    </body>
</html>