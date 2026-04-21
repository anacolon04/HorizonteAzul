<section id="viajes-destacados">

  <h2>Viajes disponibles</h2>

  <div class="grid trips">

    <?php
      require_once "../../sql/conexion.php";

      $sql = "SELECT id_viaje, titulo, fecha_inicio, fecha_fin, precio, tipo_viaje, plazas, imagen
              FROM viaje";

      $result = $conn->query($sql);

      if ($result->num_rows === 0) {
        echo "<p>No hay viajes disponibles.</p>";
      }

      while ($fila = $result->fetch_assoc()) {

        $id = $fila["id_viaje"];
        $titulo = htmlspecialchars($fila["titulo"]);
        $precio = number_format($fila["precio"], 2, ",", ".");
        $tipo = htmlspecialchars($fila["tipo_viaje"] ?? "Viaje");
        $plazas = $fila["plazas"];

        $inicio = date("d/m/Y", strtotime($fila["fecha_inicio"]));
        $fin = date("d/m/Y", strtotime($fila["fecha_fin"]));

        $imagen = !empty($fila["imagen"])
                  ? "../assets/imagenes/" . $fila["imagen"]
                  : "img/default.jpg";

        echo "
        <article class='trip'>
          <div class='thumb' style=\"background-image:url('$imagen')\"></div>

          <div class='content'>

            <h3>$titulo</h3>

            <div class='meta'>
              <span>$inicio – $fin</span>
              <span>$plazas plazas</span>
              <span>$tipo</span>
            </div>

            <div class='price'>
              <strong>$precio €</strong>
              <div>
                <a class='btn' href='viaje.php?id=$id'>Ver</a>
                <a class='btn primary' href='reservar.php?id=$id'>Reservar</a>
              </div>
            </div>
          </div>
        </article>";
      }
    ?>

  </div>
</section>
