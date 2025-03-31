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