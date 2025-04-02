<?php 

    //3. El index.php llama al controller,
    //en la versión con datos estáticos
    require_once('controller.php');

?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Ejercicio 12 PHP</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--bootstrap-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <!--font awesome-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer">
        <!--datatables-->
        <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css">

    </head>
    <body>

    <?php

        ////////////////////////
        //// Vista Modelo Vista
        //// Tipo de modelo que no hace del Controlador
        //// * No hace uso del controller.php
        ////////////////////////

        // // 2. Crea un nuevo objeto, a partir de la clase ConectorDB
        // $con = new ConectorDB;

        // echo '<pre>';
        // // 3. Llama a la función pública conectar() del objeto
        // // Objeto $con ejecuta función conectar()
        // echo print_r($con->conectar());
        // echo '</pre>';
        

        // $con = new ConectorDB;

        // echo '<pre>';
        // // 3. Llama a la función pública getCon() del objeto
        // // Objeto $con ejecuta función getCon()
        // echo var_dump($con->getCon());
        // //echo print_r($con->getCon());
        // echo '</pre>';

        $con = new ConectorDB;
        // Consulta SQL almacenada en variable
        $sql = "SELECT * FROM `app_tareas`";/*SELECCIONA TODO DE LA TABLA tareas*/

        // 3. Llama a la función pública ConsultarDB() del objeto
        $datosObtenidos = $con->ConsultarDB($sql);
        
        echo '<pre>';
        echo print_r($datosObtenidos);
        echo '</pre>';
    ?>

    </body>
</html>