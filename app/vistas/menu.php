<nav class="menu">
    <ul>
        <li><a href="../public/index.php">Home</a></li>
        <li><a href="../public/ofertas.php">Ver ofertas</a></li>
        <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin'): ?>
            <li><a href="../admin/crud_viajes.php">CRUD Viajes</a></li>
            <li><a href="../admin/crud_usuarios.php">CRUD Usuarios</a></li>
        <?php endif; ?>
        <?php if (isset($_SESSION['id'])) { ?>
            <li><a href="../public/cerrar_sesion.php" class="nav-link-logout"><i class="fas fa-sign-out-alt"></i>Cerrar sesión</a></li>
        <?php } else { ?>
            <li><a href="login.php">Mi Perfil</a></li>
        <?php } ?>



    </ul>
</nav>