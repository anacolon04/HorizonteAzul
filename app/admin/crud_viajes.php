<?php include 'es_admin.php' ?>

<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <?php include '../assets/css_crud.php' ?>
    </head>
    <body>
        <!-- Header -->
        <?php include '../vistas/header.php' ?>

        <!-- Menú -->
        <?php include '../vistas/menu.php' ?>

        <div style="text-align: center; margin: 30px 0;">
            <a href="insertar_viaje.php" class="btn btn-success btn-lg">
                Crear nuevo viaje
            </a>
        </div>


        <!-- Tabla -->
        <section>
            <?php include 'listado_viajes.php' ?>
        </section>

        <!-- FOOTER -->
        <?php include '../vistas/footer.php' ?>
    </body>
</html>