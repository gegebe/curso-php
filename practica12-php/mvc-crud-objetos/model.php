<?php

    class ConectorDB{
        private $host = 'localhost';
        private $user = 'root';
        private $pass = 'root';
        private $db = 'appweb';
        private $port = '3306';
        private $con;
        public $respuesta;

        private function Conectar(){
            $this->con = mysqli_connect($this->host,$this->user,$this->pass,$this->db,$this->port);
        }

        public function ConsultarDB($sql){
            $this->Conectar();
            $datos = mysqli_query($this->con, $sql);
            $this->Desconectar();
            return $datos;
        }

        private function Desconectar(){
            $this->respuesta = mysqli_close($this->con);
        }

    }

    class TareasDB extends ConectorDB{

        public function ConsultarTareasDB(){
            $sql = "SELECT * FROM `app_tareas`"; 
            $tareas = $this->ConsultarDB($sql);
            $total = mysqli_num_rows($tareas);

            if($total > 0){

                return $tareas;
            
            } else {

                return false;
            
            }
        
        }

        public function ConsultarTareasIdDB(int $rowid){
            $sql = "SELECT * FROM `app_tareas` WHERE `rowid` =".$rowid;
            $tarea = $this->ConsultarDB($sql);
            // $total = mysqli_num_rows($tarea);
            $total = mysqli_num_rows($tarea);

            if($total > 0){

                return $tarea;
            
            } else {

                return false;
            
            }

        }

        //// CRUD - (C) CREATE
        public function AddTareasDB(Array $datos){
            $sql = "INSERT INTO `app_tareas` (`rowid`, `nombre`, `tiempo`, `estado`) 
                    VALUES (null, '".$datos['nombre']."', '".$datos['tiempo']."', ".$datos['estado'].");";
            $res = $this->ConsultarDB($sql);
            return $res;

        }

        //// CRUD - (U) UPDATE
        public function UpdateTareasDB(Array $datos){
            $sql = "UPDATE `app_tareas` SET `nombre` = '".$datos['nombre']."',
                    `tiempo` = '".$datos['tiempo']."',
                    `estado` = ".$datos['estado']."
                    WHERE `app_tareas`.`rowid` = ".$datos['rowid'].";";

            try{

                $res = $this->ConsultarDB($sql);

            } catch(Exception $e){

                echo '<pre>';
                echo print_r($e);
                echo '</pre';
            }
            
            return $res;
        }

        //// CRUD - (D) DELETE
        public function DeleteTareasDB(int $rowid){
            $sql = "DELETE FROM `app_tareas` WHERE `rowid` =".$rowid;
            $res = $this->ConsultarDB($sql);
            return $res;
        }

        static public function saludar(){
            return 'hola';
        }

    }

    /* Manera de llamar a los métodos públicos */
    echo TareasDB::saludar();

?>