<?php 

    require_once('controller.php');

?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Ejercicio 12 PHP Práctica</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--font awesome-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer">
        <!--datatables-->
        <link href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css"  rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link href="" rel="stylesheet" type="text/css">
        <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
        <script src="https://code.jquery.com/ui/1.14.1/jquery-ui.js"></script> 
        <script src="https://cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>  

    </head>
    <body>

    <section class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>Tareas pendientes</h2>
                <a href="" class="btn btn-primary">Nueva tarea</a>
                <table id="tabla-tareas" class="table table-stripped table-hover table-primary">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tareas</th>
                            <th>Tiempo</th>
                            <th>Estado</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        if(isset($tareas) AND !empty($tareas)){
                            //echo print_r($tareas);
                            foreach($tareas as $tarea){
                                echo '<tr>';
                                echo '<td>'.$tarea['id'].'</td>';
                                echo '<td>'.$tarea['nombre'].'</td>';
                                echo '<td>'.$tarea['tiempo'].'</td>';
                                echo '<td>'.$tarea['estado'].'</td>';
                                echo '<td><a class="btn btn-success"><span class="fa-solid fa-pen-to-square"></a></td>';
                                echo '<td><a class="btn btn-danger"><span class="fa-solid fa-trash"></a></td>';
                                echo '</td>';
                            }
                        }

                        ?>
                    </tbody>
                    <tfoot>

                    </tfoot>
                </table>
                <form>

                </form>
            </div>
        </div>
    </section>

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

        <script>
            let table = new DataTable('#tabla-tareas');
        </script>
    </body>
</html>