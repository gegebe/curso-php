<?php

    ////////////////
    // Datos estáticos
    ////////////////

    //1. Datos necesarios para conectarse a la BD
    // $con = mysqli_connect('localhost', 'root', 'root', 'appweb', '3306');
    
    // echo '<pre>';
    // echo print_r($con);
    // echo '</pre>';

    ////////////////
    // Datos con variables
    ////////////////
    // $host = 'localhost';
    // $user = 'root';
    // $pass = 'root';
    // $db = 'appweb';
    // $port = '3306';

    // $con = mysqli_connect($host,$user,$pass,$db,$port);

    // echo '<pre>';
    // echo print_r($con);
    // echo '</pre>';

    ////////////////
    // Datos en una class
    ////////////////

    // class ConectorDB{
    //     private $host = 'localhost';
    //     private $user = 'root';
    //     private $pass = 'root';
    //     private $db = 'appweb';
    //     private $port = '3306';

    //     public function conectar(){
    //         $con = mysqli_connect($this->host,$this->user,$this->pass,$this->db,$this->port);

    //         return $con;
    //     }
    // }

    // ////////////////
    // // Datos en una class - Conexión privada
    // ////////////////

    // class ConectorDB{
    //     private $host = 'localhost';
    //     private $user = 'root';
    //     private $pass = 'root';
    //     private $db = 'appweb';
    //     private $port = '3306';
    //     private $con; //Datos dinámicos
    //     private $respuesta;

    //     private function Conectar(){
    //         // Este this-> asigna los datos a la propiedad $con,
    //         // de manera dinámica
    //         $this->con = mysqli_connect($this->host,$this->user,$this->pass,$this->db,$this->port);
    //     }

    //     private function Desconectar(){
    //         // Este $this-> asigna los datos de la respuesta,
    //         // a la propiedad $respuesta
    //         $this->respuesta = mysqli_close($this->con);
    //     }

    //     public function getCon(){
    //         $this->Conectar();
    //         $this->Desconectar();
    //         return $this->respuesta;
    //     }
    // }

    ////////////////
    // Datos en una class - Conexión privada con consultas
    ////////////////

    class ConectorDB{
        private $host = 'localhost';
        private $user = 'root';
        private $pass = 'root';
        private $db = 'appweb';
        private $port = '3306';
        private $con; //Datos dinámicos
        public $respuesta;

        private function Conectar(){
            // Este this-> asigna los datos a la propiedad $con,
            // de manera dinámica
            $this->con = mysqli_connect($this->host,$this->user,$this->pass,$this->db,$this->port);
        }

        public function ConsultarDB($sql){
            //1. Al llamar ConsultarDB, primero Conecta a la BD
            $this->Conectar();
            
            //2. Consultas SQL almacenadas en la variable $sql
            $datos = mysqli_query($this->con, $sql);
            
            //3. Ejecuta la función Desconectar()
            $this->Desconectar();
            
            //* Es posible devolver los datos como una Array
            // foreach($datos as $dato);
            // return $dato;
            //4. Devuelve los datos generados en la consulta
            return $datos;
        }

        private function Desconectar(){
            // Este $this-> asigna los datos de la respuesta,
            // a la propiedad $respuesta
            $this->respuesta = mysqli_close($this->con);
        }

    }

    //Herencia en PHP
    class TareasDB extends ConectorDB{
        // private function Desconectar(){
        //     //Polimorfismo, podría anular algunas de las propiedades heredadas
        //     $this->respuesta = 100;
        // }

        //// CRUD - (R) READ
        public function ConsultarTareasDB(){
            $sql = "SELECT * FROM `app_tareas`"; //Esta expresión selecciona toda la tabla
            $tareas = $this->ConsultarDB($sql);//Recibimos mysqli_result
            // echo print_r($tareas);
            // exit(0);//Deja de ejecutar el resto a partir de esta línea

            $total = mysqli_num_rows($tareas);//Cuenta el número de filas

            if($total > 0){

                return $tareas;
                //Si hay más de 0 líneas, devuelve $tareas
            
            } else {

                return false;
            
            }

            
        }

        //// CRUD - (C) CREATE
        // Tipar el tipo de datos que va a procesar
        public function AddTareasDB(Array $datos){
            //// Orden SQL para escribir nuevos datos en la tabla tareas
            //// INSERT INTO - Escribe en la tabla tareas
            //// VALUES() - Especificamos los valores que entran, siendo null el primero de ellos porque es
            //// Auto Incremental
            $sql = "INSERT INTO `app_tareas` (`rowid`, `nombre`, `tiempo`, `estado`) 
                    VALUES (null, '".$datos['nombre']."', '".$datos['tiempo']."', ".$datos['estado'].");";

            // //// Canalizar los errores
            // try{
            //     $res = $this->ConsultarDB($sql);
            // } catch(Exception $e) {
            //     echo '<pre>';
            //     echo print_r($e);
            //     echo '</pre>';
            // };
            
            //// Ejecuta la función ConcultarDB()
            $res = $this->ConsultarDB($sql);
            //// Devuelve el valor al controlador
            return $res;

        }

        //// CRUD - (U) UPDATE
        public function UpdateTareasDB(){
            
        }

        //// CRUD - (D) DELETE
        public function DeleteTareasDB(){
            
        }

    }

?>