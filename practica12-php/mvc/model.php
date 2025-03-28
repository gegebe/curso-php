<?php
    //1. Datos necesarios para conectarse a la BD
    $con = mysqli_connect('localhost', 'root', 'root', 'appweb', '3306');

    echo '<pre>';
    echo print_r($con);
    echo '</pre>';

?>