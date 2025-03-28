<?php 

////////////////
// CONECTOR
////////////////

// Servidor de mySQL
$host = 'localhost';

// Usuario
$user = 'root';

// Password
$pass = '';

// Nombre BBDD
$db = 'myapp';

// Puerto de comunicación de BD a mySQL
$port = '3306';

// Conector a la BD
$con = $mysqli_connect($host, $user, $pass, $db, $port);


?>