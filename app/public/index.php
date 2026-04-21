<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Project/PHP/PHPProject.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Horizonte Azul</title>
        <?php include '../assets/css_index.php' ?>
    </head>
    <body>
        <!-- Header -->
        <?php include '../vistas/header.php' ?>

        <!-- Menú -->
        <?php include '../vistas/menu.php' ?>

        <!-- CONTENIDO -->
        <main>
            <section class="about">
                <div class="texto">
                    <h2>¿Por qué elegirnos?</h2>
                    <p>
                        En Horizonte Azul creemos que viajar no es solo desplazarse, 
                        sino vivir experiencias que se quedan para siempre. Somos una 
                        empresa especializada en la organización de viajes diseñados 
                        con mimo, pensados para quienes buscan descubrir el mundo con 
                        tranquilidad, seguridad y un toque especial.

                        <br>

                        Acompañamos a nuestros viajeros en cada etapa del viaje: desde 
                        la planificación inicial hasta el regreso a casa, cuidando cada 
                        detalle para que solo tengas que preocuparte de disfrutar. 
                        Apostamos por destinos únicos, grupos bien organizados y un 
                        estilo de viaje cercano, humano y auténtico.

                        <br>

                        Nuestro objetivo es claro: abrirte nuevos horizontes, crear 
                        recuerdos inolvidables y convertir cada viaje en una experiencia 
                        que merezca ser contada.
                    </p>
                </div>

                <div class="imagen">
                    <img src="../assets/imagenes/imagen_descripcion.png" alt="Viajar con Horizonte Azul">
                </div>
            </section>

            <section>
                <?php include '../vistas/viajes_destacados.php' ?>
            </section>
        </main>

        <!-- FOOTER -->
        <?php include '../vistas/footer.php' ?>
    </body>
</html>
