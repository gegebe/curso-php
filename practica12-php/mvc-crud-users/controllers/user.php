<?php

    //CONSTANTES
    require_once('config.php');
    //MODELO
    require_once('models/user.php');

    $userDB = new UsuariosDB();
    

    if($_POST){
        if(isset($_POST['action']) && !empty($_POST['action'])){
            if($_POST['action'] == 'REG_USUARIOS'){

                foreach($_POST as $key=>$value){
                    if($key != 'action'){
                        //Evita que lleguen valores HTML / inyectados
                        $datos[$key] = htmlspecialchars($value);
                    }
                                   
                }
                
                /* Almacenar los datos del usuario mediante la función AddUsuarioDB, si estos no existen en la BD */
                $res = $userDB->AddUsuariosDB($datos);
                    if($res == 1){
                        $msn = '<div class="alert alert-success">Datos guardados correctamente</div>';
                    } else {
                        $msn = '<div class="alert alert-danger">Error al guardar los datos</div>';
                    }
            }

            if($_POST['action'] == 'LOGIN_USER'){

                foreach($_POST as $key=>$value){
                    if($key != 'action'){
                        $datos[$key] = htmlspecialchars($value);
                    }
                    
                }

                //Almacena los datos del $_POST
                $dtUsers = $userDB->consultarUsuariosNombre($datos);

                if($dtUsers === -1){

                    $msn = '<div class="alert alert-danger">El usuario no existe en la base de datos</div>';
                    
                } else {
                    // Si devuelve 1, pasa por el else
                    // Comprueba si es 1
                    if($dtUsers['estado'] == 1){
                        
                        /*Comparamos el pass encriptando al "vuelo" y comparado con el hash de la BD,
                        si coincide dejamos pasar*/
                        if(md5($datos['pass']) == $dtUsers['pass']){
                            //Variable de entorno, propia de PHP
                            $_SESSION['user'] = $dtUsers['email'];
                            $_SESSION['nombre'] = $dtUsers['nombre'];

                        } else {
                            $msn = '<div class="alert alert-danger">Contraseña del usuario incorrecta</div>';
                        }

                    } else {
                        $msn = '<div class="alert alert-danger">El usuario no tiene permisos</div>';
                    }
                }

            }
        }
    }


    class Usuarios {

        //1. propiedad
        private $formreg;
        private $formlogin;

        public function __construct(){
        //3. llena la propiedad de valor setFormReg()
            $this->setFormReg();
            $this->setFormLogin();
        }

        private function setFormReg(){
        //2. valor de la propiedad
            $this->formreg = '
            <form id="registro" class="form-control" method="POST" action="index.php" enctype="multipart/form-data">
                <h3>Formulario de acceso</h3>
                <ul>
                    <li>
                        <label for="nombre">Nombre</label>
                        <input id="nombre" name="nombre" type="text" class="form-control" placeholder="Usuario" required>
                    </li>
                    <li>
                        <label for="pass">Password</label>
                        <input name="pass" id="pass1" type="password" class="form-control" placeholder="Password" required>
                    </li>
                    <li>
                        <label for="pass">Repetir password</label>
                        <input name="pass" id="pass2" type="password" class="form-control" placeholder="Repetir password" required>
                    </li>
                    <li>
                        <label for="email">Email</label>
                        <input name="email" id="email1" type="mail" class="form-control" placeholder="Email" required>
                    </li>
                    <li>
                        <label for="email2">Repetir email</label>
                        <input name="email2" id="email2" type="mail" class="form-control" placeholder="Repetir password" required>
                    </li>
                    <li>
                        <label for="foto">Foto</label>
                        <input name="foto" id="foto" type="file" class="form-control">
                    </li>

                    <li>
                        <input type="hidden" name="conectado" value="0">
                    </li>
                    <li>
                        <input type="hidden" name="estado" value="0">
                    </li>
                    <li>
                        <input type="hidden" name="action" value="REG_USUARIOS">
                    </li>

                    <li>
                        <ul class="d-flex">
                            <li>
                                <button class="btn btn-success" type="submit">LOGIN</button>
                            </li>
                            <li>
                                <button class="btn btn-danger" type="reset">RESET</button>
                            </li>
                        </ul>
                    </li>
                </ul>
            </form>
            ';
        }

        public function getFormReg(){
        //4. Devuelve la propuedad donde es llamado
            return $this->formreg;
        }

        private function setFormLogin(){
            $this->formlogin = '
                <form class="form-control" method="POST" action="index.php">
                <h3>Formulario de acceso</h3>
                <ul>
                    <li>
                        <label for="user-access">
                        <input name="user" id="user-access" type="email" class="form-control" placeholder="Usuario" required>
                    </li>
                    <li>
                        <label for="pass">
                        <input name="pass" id="pass" type="password" class="form-control" placeholder="Password" required>
                    </li>
                    <li>
                        <input name="action" type="hidden" value="LOGIN_USER">
                    </li>
                    <li>
                        <ul class="d-flex">
                            <li>
                                <button class="btn btn-success" type="submit">LOGIN</button>
                            </li>
                            <li>
                                <button class="btn btn-danger" type="reset">RESET</button>
                            </li>
                        </ul>
                    </li>
                </ul>
            </form>';
        }

        public function getFormLogin(){
            return $this->formlogin;
        }


    }

?>