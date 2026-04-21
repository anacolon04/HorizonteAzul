<?php
include 'es_admin.php';

require_once "../../sql/conexion.php";

$resultado = $conn->query("SELECT id, nombre, email, rol FROM usuario ORDER BY id ASC");
?>

<h2>Listado de usuarios</h2>

<table>
    <tr>
        <th>Id</th>
        <th>Nombre</th>
        <th>Email</th>
        <th>Rol</th>
        <th>Acciones</th>
    </tr>

    <?php if ($resultado && $resultado->num_rows > 0): ?>
        <?php while ($fila = $resultado->fetch_assoc()): ?>
            <tr>
                <td><?php echo (int) $fila['id']; ?></td>
                <td><?php echo htmlspecialchars($fila['nombre']); ?></td>
                <td><?php echo htmlspecialchars($fila['email']); ?></td>
                <td><?php echo htmlspecialchars($fila['rol']); ?></td>
                <td>
                    <a class="editar"
                       href="editar_usuario.php?id=<?php echo (int) $fila['id']; ?>">
                        Editar
                    </a>

                    <form action="borrar_usuario.php" method="POST" style="display:inline;">
                        <input type="hidden" name="id" value="<?php echo (int) $fila['id']; ?>">
                        <button class="borrar"
                                type="submit"
                                onclick="return confirm('¿Seguro que deseas borrar este usuario?');">
                            Borrar
                        </button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
    <?php else: ?>
        <tr>
            <td colspan="5">No hay usuarios</td>
        </tr>
    <?php endif; ?>

</table>
