<?php

    require_once('model.php');

    //$tareas = [];

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