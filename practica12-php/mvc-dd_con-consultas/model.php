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
        private $respuesta;

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
            foreach($datos as $dato);
            return $dato;
            //4. Devuelve los datos generados en la consulta
            //return $datos;
        }

        private function Desconectar(){
            // Este $this-> asigna los datos de la respuesta,
            // a la propiedad $respuesta
            $this->respuesta = mysqli_close($this->con);
        }

    }

?>