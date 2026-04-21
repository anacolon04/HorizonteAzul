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
            <section>
                <?php include '../vistas/viajes_disponibles.php' ?>
            </section>
        </main>

        <!-- FOOTER -->
        <?php include '../vistas/footer.php' ?>
    </body>
</html>