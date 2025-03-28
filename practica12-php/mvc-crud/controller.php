<?php

    require_once('model.php');

    // RECIBIR - ENVIAR DATOS POR GET
    if($_GET){

    }

    // RECIBIR - ENVIAR DATOS POR POST
    if($_POST){
        if(isset($_POST['action']) AND !empty($_POST['action'])){
            if($_POST['action'] == 'ADD_TAREAS'){
                //// Para ver los datos enviados por POST al controlador
                // echo print_r($_POST);
                //// Acabar programa aquí
                // exit(0);
                $datos['nombre'] = $_POST['nombre'];
                $datos['tiempo'] = $_POST['tiempo'];
                $datos['estado'] = $_POST['estado'];
                // Array con nombre como valor de índice, de manera que no sobreescribe

                //Nuevo objeto que se conecta a la BD, partiendo de la clase TareasDB que se encuentra en el modelo
                $tareasDB = new TareasDB;
                $res = $tareasDB->AddTareasDB($datos);
                if($res == 1){
                    $msn = '<p class="alert alert-success">Datos almacenados correctamente en la BD</p>';
                } else {
                    $msn = '<p class="alert alert-success">Error al almacenar los datos en la BD</p>';
                }
            }
        }
    }

    // ENVIAR ARCHIVOS POR FILES
    if($_FILES){

    }

    function buscarTareasDB(){
        $tareasDB = new TareasDB();
        $datos = $tareasDB->ConsultarTareasDB();
        if(isset($datos) and !empty($datos)){
            $i = 0;
            // $datos -> MYSQL_RESULT
            foreach($datos as $dato){
                $tareas[$i]['id'] = $dato['rowid'];
                $tareas[$i]['nombre'] = $dato['nombre'];
                $tareas[$i]['tiempo'] = $dato['tiempo'];
                $tareas[$i]['estado'] = $dato['estado'];
                $tareas[$i]['verificar'] = false;
                
                $i++;
            }  
        }
        
        return $tareas;
    }

    $tareas = buscarTareasDB();

?>