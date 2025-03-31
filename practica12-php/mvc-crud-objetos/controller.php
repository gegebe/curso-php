<?php

    require_once('libreria.php');
    require_once('model.php');

    // RECIBIR - ENVIAR DATOS POR GET
    if($_GET){
        if(isset($_GET['views']) AND !empty($_GET['views'])){
            if($_GET['views'] == 'updateTareas'){
                // Decodifica la ID previamente codificada
                $rowid = base64_decode($_GET['id']);

                $tareasDB = new TareasDB();
                $datos = $tareasDB->ConsultarTareasIdDB($rowid);
                //Pasamos de mysqli_result a Array
                foreach($datos as $dato);
                $tarea = $dato;
            }
        }

        if(isset($_GET['action']) AND !empty($_GET['action'])){
            if($_GET['action'] == 'deleteTareas'){
                $rowid = base64_decode($_GET['id']);
                $tareasDB = new TareasDB();
                $res = $tareasDB->DeleteTareasDB($rowid);
                if($res == 1){
                    $msn = '<p class="alert alert-success">Dato borrado de la BD</p>';
                    header('location:index.php?views=Tareas&msn='.$msn);

                } else {
                    $msn = '<p class="alert alert-success">Error al borrar datos en la BD</p>';
                    header('location:index.php?views=Tareas&msn='.$msn);
                }
            }
        }
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
                    header('location:index.php?views=Tareas&msn='.$msn);
                } else {
                    $msn = '<p class="alert alert-success">Error al almacenar los datos en la BD</p>';
                    header('location:index.php?views=Tareas&msn='.$msn);
                }
            }

            if($_POST['action'] == 'UPDATE_TAREAS'){
                $datos['nombre'] = $_POST['nombre'];
                $datos['tiempo'] = $_POST['tiempo'];
                $datos['estado'] = $_POST['estado'];
                $datos['rowid'] = $_POST['rowid'];
                $tareasDB = new TareasDB;
                $res = $tareasDB->UpdateTareasDB($datos);
                if($res == 1){
                    $msn = '<p class="alert alert-success">Datos almacenados correctamente en la BD</p>';
                    header('location:index.php?views=Tareas&msn='.$msn);
                } else {
                    $msn = '<p class="alert alert-success">Error al almacenar los datos en la BD</p>';
                    header('location:index.php?views=Tareas&msn='.$msn);
                }
            }
        }
    }

    // ENVIAR ARCHIVOS POR FILES
    if($_FILES){

    }

    class Tareas {
        private $form;
        private $tabla;
        private $nombre;
        private $tiempo;
        private $estado;
        private $tareas;

        public function __construct(){
            
        }

        private function setTabla($tareas){
            $this->tabla=`
            <table id="tabla-tareas" class="">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Tiempo</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                `;
                    <?php
                    if(isset($tareas) && !empty($tareas)){
                        for($i=0; $i <td count($tareas); $i++){
                            $this->tabla .= '<tr>';
                            $this->tabla .= '<td>';
                            $this->tabla .= '</td>';
                            $this->tabla .= '</td>';
                        }

                    };
                    ?>
                `
                </tbody>
            </table>`
            ;
        }

        private function getTabla(){

        }
    }

    private function buscarTareasDB(){
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