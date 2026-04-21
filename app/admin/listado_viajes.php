
<?php
include 'es_admin.php';

include("../../sql/conexion.php");

$sql = "SELECT * FROM viaje";
$resultado = $conn->query($sql);
?>

<table>
    <tr>
        <th>Título</th>
        <th>Descripción</th>
        <th>Fecha inicio</th>
        <th>Fecha fin</th>
        <th>Precio (€)</th>
        <th>Tipo</th>
        <th>Plazas</th>
        <th>Destacado</th>
        <th>Imagen</th>
        <th>Acciones</th>
    </tr>

    <?php
    if ($resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($fila["titulo"]) . "</td>";
            echo "<td>" . htmlspecialchars($fila["descripcion"]) . "</td>";
            echo "<td>" . htmlspecialchars($fila["fecha_inicio"]) . "</td>";
            echo "<td>" . htmlspecialchars($fila["fecha_fin"]) . "</td>";
            echo "<td>" . htmlspecialchars($fila["precio"]) . "</td>";
            echo "<td>" . htmlspecialchars($fila["tipo_viaje"]) . "</td>";
            echo "<td>" . (int)$fila["plazas"] . "</td>";
            echo "<td>" . ($fila["destacado"] ? "⭐ Sí" : "No") . "</td>";
            echo "<td><img src='../assets/imagenes/" . htmlspecialchars($fila["imagen"]) . "'></td>";
            echo "<td>
                    <a class='editar' href='editar_viaje.php?id={$fila['id_viaje']}'>Editar</a>
                    <form action='borrar_viaje.php' method='POST' style='display:inline;'>
                        <input type='hidden' name='id_viaje' value='{$fila['id_viaje']}'>
                        <button class='borrar' type='submit' onclick='return confirm(\"¿Seguro que deseas borrar este viaje?\")'>Borrar</button>
                    </form>
                  </td>";

            echo "</tr>";
            
        }
    } else {
        echo "<tr><td colspan='8'>No hay viajes disponibles</td></tr>";
    }
    ?>

</table>
