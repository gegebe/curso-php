<?php

    $usuarios = [
        ['User', '1234','user@miapp.com','red'],
        ['Admin', '1234','admin@miapp.com','blue'],
        ['Pepe', '1234','pepe@miapp.com','green'],
        ['Juan', '1234','juan@miapp.com','orange'],
        ['Marta', '1234','marta@miapp.com','grey']
    ];

    //3. Comprueba que ha sido recuperado el valor mail por GET
    if($_GET){
        //4. Comprueba que existe en la memoria RAM y que no está vacía
        if(isset($_GET['action']) && !empty($_GET['action'])){
            //5. Comprueba que el valor de action es igual al recuperado por JavaScript
            if($_GET['action'] == "AccionRecuperarMail"){
                //6. Asigna el valor de mail a la variable $mail
                $mail = $_GET['mail'];
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Ejercicio 05 PHP</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--bootstrap-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <!--font awesome-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer">
        <!--datatables-->
        <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css">

        <style>
            <?php
                for($i = 0; $i < count($usuarios); $i++){
                    echo '#mail-'.$i.'{';
                        echo 'color:'.$usuarios[$i][3].';';
                    echo '}';
                }
            ?>
        </style>
    </head>
    <body>
        <section class="container">
            <table id="tabla" class="table table-stripped table-primary table-hover">
                <thead>
                    <tr>
                        <th>Usuario</th>
                        <th>Pass</th>
                        <th>E-mail</th>
                        <th>Color</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Recorrer la Array con for() -->
                    <!-- count() cuenta el número de elementos de la Array --> 
                    <?php
                        for($i = 0; $i < count($usuarios); $i++){
                            echo '<tr>';
                                echo '<td>'.$usuarios[$i][0].'</td>';
                                echo '<td>'.$usuarios[$i][1].'</td>';
                                echo '<td id="mail-'.$i.'">'.$usuarios[$i][2].'</td>';
                                echo '<td>'.$usuarios[$i][3].'</td>';
                                
                                echo '<td><a id="user-'.$i.'" href="" class="btn btn-success" onclick="enviarMail(\''.$usuarios[$i][2].'\')">
                                <span class="fa-solid fa-envelope"></span></td>';

                                echo '<td><a id="btn-user-'.$i.'" class="btn btn-success" onclick="enviarMailServidor(\''.$usuarios[$i][2].'\')" href="index.php?action=AccionRecuperarMail&mail='.$usuarios[$i][2].'">Enviar</a></td>';
                            echo '</tr>';
                        }

                        if(isset($mail) && !empty($mail)){
                            echo '<div class="alert alert-success">'.$mail.'</div>';
                        }
                    ?>
                </tbody>
                <tfoot></tfoot>
            </table>
        </section>

         <!--bootstrap-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
        <!--jquery-->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        
        <!--datatables-->
        <script src="https://cdn.datatables.net/2.2.2/js/dataTables.min.js">
        </script>
        <!--inicialización de datatables-->
        <script>
            let tabla = new DataTable("#tabla");
            for(let i = 0; i < 5; i++){
                document.getElementById('user-'+i).addEventListener('click', ()=>{
                alert('hola');
                });
            }

            function enviarMail(mail){
                //Recupera el email y lo pasa a la propiedad href
                location.href = 'mailto:'+mail;
            }

            //1. Cuando la función es lanzada por el onclick="" presente en el html
            //2. Recupera por GET dos parametros: AccionRecuperarMail y mail, para luego hacer uso en PHP
            function enviarMailServidor(mail){
                //location.url = `"index.php?action=AccionRecuperarMail&mail=+${mail}"`;
            }

        </script>
    </body>
</html>