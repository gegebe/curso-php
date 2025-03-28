<?php

    session_start();

    $usuarios = [
        'user1'=>['user'=>'admin','pass'=>'1234','edad'=>35,'color'=>'blue'],
        'user2'=>['user'=>'editor','pass'=>'1234','edad'=>28,'color'=>'red'],
        'user3'=>['user'=>'Superadmin','pass'=>'root','edad'=>35,'color'=>'green']
    ];

    $_SESSION['user'] = $usuarios['user1']['user'];
    session_destroy();
    //unset($_SESSION); //Desmonta la sesión de la memoria RAM

?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Ejercicio 04 PHP - Session</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <?php
        // echo '<pre>';
        // echo print_r($usuarios);
        // echo '</pre>';

        // echo '<pre>';
        //     var_dump($usuarios);
        // echo '</pre>';


        if(isset($_SESSION['user']) && !empty($_SESSION['user'])){

            echo 'parte privada<br>';
            echo 'Sr.'.$_SESSION['user'];

        } else {

            echo 'parte pública';

        }

        ?>
    </body>
</html>