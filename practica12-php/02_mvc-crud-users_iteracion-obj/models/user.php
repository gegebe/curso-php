<?php

    class ConectorDB {
        private $host = HOST;
        private $user = USER;
        private $pass = PASS;
        private $db = DB;
        private $port = PORT;
        private $con;
        private $res;

        private function conectarDB(){
            $this->con = mysqli_connect($this->host,
                                        $this->user,
                                        $this->pass,
                                        $this->db,
                                        $this->port);
        }

        public function consultarDB($sql){
            $this->conectarDB();
            $datos= mysqli_query($this->con, $sql);
            $this->desconectarDB();
            return $datos; 
        }

        private function desconectarDB(){
            $this->res = mysqli_close($this->con);
        }
    }

    class UsuariosDB extends ConectorDB{

        private $validar = false;

        private function Validar($datos){
            if(isset($datos['email']) && !empty($datos['email'])){
                //Consulta que comprueba si el email existe
                $sql = "SELECT `email` FROM `app_usuarios` WHERE `email` = '".$datos['email']."'; ";
                
                $res = $this->consultarDB($sql);
                $total = mysqli_num_rows($res);

                if($total == 0){
                    $this->validar = true;//No se devulve porque con $this ya está en la propiedad
                } else {
                    $this->validar = false;
                }
            }
        }

        public function consultarUsuarios(){
            $sql = "SELECT * FROM `app_usuarios`";
            $datos = $this->consultarDB($sql);
            $total = mysqli_num_rows($datos);

            if($total > 0){

                $i=0;
                //$dato obtiene clave, valor // $key => $value
                foreach($datos as $dato){
                    //De Array monodimensional a Array multidimensional
                    $dtUsuarios[$i] = $dato;
                    $i++;
                }

                //Devuelve Array con todas las filas, cada fila es una Array cos sus datos.
                return $dtUsuarios;

            } else {
                return -1;
            }

        }

        public function consultarUserIdDB($rowid){
            $sql = "SELECT * FROM `app_usuarios` WHERE `rowid` = $rowid";
            $datos = $this->consultarDB($sql);
            $total = mysqli_num_rows($datos);
            
            if($total > 0){
                //Si el número de registros es mayor que 0, realiza el bucle
                foreach($datos as $dato);
                //Devuelve el / los valores
                return $dato;

            } else {
                return -1;
                //Mensaje de error
            }

        }

        public function consultarUsuariosNombre($datos){
            $sql = "SELECT * FROM 
                    `app_usuarios` 
                    WHERE `email` ='".$datos['user']."';"; //Trae todo de la tabla... cuando el email coincide...
            //Pasa sql por la consulta
            $datos = $this->consultarDB($sql);
            $total = mysqli_num_rows($datos);//Cuenta el número de registros de la BD

                if($total > 0){
                    //Si el número de registros es mayor que 0, realiza el bucle
                    foreach($datos as $dato);
                    //Devuelve el / los valores
                    return $dato;
    
                } else {
                    return -1;
                    //Mensaje de error
                }
            

            }
        
        public function AddUsuariosDB($datos){

            $this->Validar($datos);
            if($this->validar){

                $sql = "INSERT INTO `app_usuarios` 
                (`nombre`, `pass`, `foto`, `email`, `conectado`, `estado`) 
                VALUES 
                ('".$datos['nombre']."', 
                '".MD5($datos['pass'])."', 
                'http://localhost:8888/curso_php/practica12-php/mvc-crud-users/foto1.jpg',
                '".$datos['email']."', 
                '0', 
                '0');";



                $res = $this->consultarDB($sql);
                return $res;
            }

        }



    }

    /*

    CREATE TABLE `appweb`.`app_usuarios` (
    `rowid` INT NOT NULL AUTO_INCREMENT , 
    `nombre` VARCHAR(100) NOT NULL , 
    `pass` VARCHAR(120) NOT NULL , 
    `foto` VARCHAR(250) NOT NULL , 
    `email` VARCHAR(150) NOT NULL , 
    `conectado` INT NOT NULL , 
    `estado` INT NOT NULL , 
    PRIMARY KEY (`rowid`)) ENGINE = InnoDB;

    
    ALTER TABLE `app_usuarios` ADD UNIQUE(`email`);


    INSERT INTO `app_usuarios` (`rowid`, `nombre`, `pass`, `foto`, `email`, `conectado`, `estado`) VALUES (NULL, 'root', MD5('1234'), 'http://localhost:8888/curso_php/practica12-php/mvc-crud-users/foto1.jpg', 'root@root.es', '0', '0'); 
    
    */

?>