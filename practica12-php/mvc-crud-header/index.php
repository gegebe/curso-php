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
        <style>
            ul {
                padding:0;
            }
            ul li {
                list-style-type: none;
            }
        </style>  

    </head>
    <body>

    <section class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>Tareas pendientes</h2>
                <div id="salida">
                    <?php
                    if(isset($_GET['msn']) AND !empty($_GET['msn'])){
                        //echo '<p class="alert alert-success">'.$msn.'</div>';
                        echo $_GET($msn);
                    }
                    ?>
                </div>
                
                <!--Veremos la tabla o el formulario-->
                <!--INICIO PHP-->
                <?php
                
                if($_GET){
                    if(isset($_GET['views']) && !empty($_GET['views'])){
                        /* INICIO PHP FORM AddTareas */
                        if($_GET['views'] == 'addTareas'){
                            // Solo vemos ESTE form cuando el GET es == a addTareas
                            echo '<form  class="form" method="post" action="controller.php">';
                            echo '<ul>';

                            echo '<li>';
                            echo '<label class="mt-2" for="nombre">Nombre de la tarea:</label>';
                            echo '<input id="nombre" class="form-control" type="text" name="nombre" required>';
                            echo '</li>';

                            echo '<li>';
                            echo '<label class="mt-2" for="tiempo">Final de la tarea:</label>';
                            echo '<input id="tiempo" class="form-control" type="date" name="tiempo" required>';
                            echo '</li>';

                            echo '<li>';
                            echo '<label class="mt-2" for="estado">Estado:</label>';
                            echo '<input id="estado" class="form-control" type="number" name="estado" required>';
                            echo '</li>';

                            echo '<li>';
                            // Sirve para conocer que acción estamos realizando
                            echo '<input value="ADD_TAREAS" type="hidden" name="action">';
                            echo '</li>';

                            echo '<li class="d-flex gap-2">';
                            echo '<button class="btn btn-success mt-2 mr-2" type="submit">Guardar</button>';
                            echo '<button class="btn btn-info mt-2" type="reset">Borrar</button>';
                            echo '<a class="btn btn-danger mt-2" href="index.php">Volver</a>';
                            echo '</li>';

                            echo '</ul>';
                            echo '</form>';
                        }
                        /* INICIO PHP FORM updateTareas */
                        if($_GET['views'] == 'updateTareas'){
                            if(isset($tarea) AND !empty($tarea)){
                                echo '<form  class="form" method="post" action="controller.php">';
                                echo '<ul>';

                                echo '<li>';
                                echo '<label class="mt-2" for="nombre">Nombre de la tarea:</label>';
                                echo '<input id="nombre" class="form-control" type="text" name="nombre" value="'.$tarea['nombre'].'" required>';
                                echo '</li>';

                                echo '<li>';
                                echo '<label class="mt-2" for="tiempo">Final de la tarea:</label>';
                                echo '<input id="tiempo" class="form-control" type="date" name="tiempo" value="'.$tarea['tiempo'].' required>';
                                echo '</li>';

                                echo '<li>';
                                echo '<label class="mt-2" for="estado">Estado:</label>';
                                echo '<input id="estado" class="form-control" type="number" name="estado" value="'.$tarea['estado'].' required>';
                                echo '</li>';

                                echo '<li>';
                                // Sirve para conocer que acción estamos realizando
                                echo '<input value="UPDATE_TAREAS" type="hidden" name="action">';
                                echo '</li>';

                                echo '<li>';
                                // Sirve para conocer que acción estamos realizando
                                echo '<input value="'.base64_decode($_GET['id']).'" type="hidden" name="rowid">';
                                echo '</li>';

                                echo '<li class="d-flex gap-2">';
                                echo '<button class="btn btn-success mt-2 mr-2" type="submit">Guardar</button>';
                                echo '<button class="btn btn-info mt-2" type="reset">Borrar</button>';
                                echo '<a class="btn btn-danger mt-2" href="index.php">Volver</a>';
                                echo '</li>';

                                echo '</ul>';
                                echo '</form>';
                            }
                        }
                        /* INICIO PHP TABLA Tareas */
                        if($_GET['views'] == 'Tareas'){
                            
                ?>
                <!--CIERRE PRIMER PHP-->

                        <!--INICIO VISTA DEL INICIO DE TABLA EN HTML-->
                            <a href="index.php?views=addTareas" class="btn btn-primary">Nueva tarea</a>
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
                        <!--FIN VISTA DEL INICIO DE TABLA EN HTML-->
                        <?php
                        /* INICIO DE PHP FILAS TABLA */

                        if(isset($tareas) AND !empty($tareas)){
                            // Recorre el ARRAY recibida
                            for($i = 0; $i < count($tareas); $i++){
                                echo '<tr>';
                                    echo '<td>'.$tareas[$i]['id'].'</td>';
                                    echo '<td>'.$tareas[$i]['nombre'].'</td>';
                                    echo '<td>'.$tareas[$i]['tiempo'].'</td>';
                                    echo '<td>'.$tareas[$i]['estado'].'</td>';
                                    /* base64 permite codificar / encriptar */
                                    echo '<td><a href="index.php?views=updateTareas&id=' .base64_encode($tareas[$i]['id']). '" class="btn btn-success"><span class="fa-solid fa-pen-to-square"></span></a></td>';
                                    echo '<td><a href="index.php?action=deleteTareas&id=' .base64_encode($tareas[$i]['id']). '" class="btn btn-danger"><span class="fa-solid fa-trash"></span></a></td>';
                                echo '</tr>';
                            }
                            
                        }
                        /* FIN DE PHP FILAS TABLA */
                        ?>
                    <!--INICIO VISTA DEL FINAL TBODY y TFOOT DE TABLA EN HTML-->
                    </tbody>
                    <tfoot>

                    </tfoot>
                </table>
                    <!--FINAL VISTA DEL FINAL TBODY y TFOOT DE TABLA EN HTML-->
                <?php
                    /*INICIO PHP ??? */
                        }
                    }
                    
                } else {

                }

                ?>

                <a href="index.php?views=addTareas" class="btn btn-primary">Nueva tarea</a>
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
                            for($i = 0; $i < count($tareas); $i++){
                                echo '<tr>';
                                    echo '<td>'.$tareas[$i]['id'].'</td>';
                                    echo '<td>'.$tareas[$i]['nombre'].'</td>';
                                    echo '<td>'.$tareas[$i]['tiempo'].'</td>';
                                    echo '<td>'.$tareas[$i]['estado'].'</td>';
                                    /* base64 permite codificar / encriptar */
                                    echo '<td><a href="index.php?views=updateTareas&id=' . base64_encode($tareas[$i]['id']) . '" class="btn btn-success"><span class="fa-solid fa-pen-to-square"></span></a></td>';
                                    echo '<td><a href="index.php?action=deleteTareas&id=' .base64_encode($tareas[$i]['id']). '" class="btn btn-danger"><span class="fa-solid fa-trash"></span></a></td>';
                                echo '</tr>';
                            }

                        ?>
                    </tbody>
                    <tfoot>

                    </tfoot>
                </table>
                <?php
               }
                ?>
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