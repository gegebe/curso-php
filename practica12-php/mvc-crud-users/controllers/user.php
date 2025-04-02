<?php
    require_once('config.php');
    require_once('models/user.php');
    $usuarios = new Usuarios();
   

    if($_POST){
        if(isset($_POST['action']) && !empty($_POST['action'])){
            if($_POST['action'] == 'REG_USUARIOS'){      
                $msn = $usuarios->registrarUsuario($_POST);          
            }
            if($_POST['action'] == 'LOGIN_USER'){
                $msn = $usuarios->loginUsuarios($_POST);                 
            }             
        }       
    }

    if($_GET){
        if(isset($_GET['action']) && !empty($_POST['action'])){
            if($_GET['action'] == 'CERRAR_SESSION'){

            }
        }
    }


    class Usuarios{

        private $formreg;
        private $formlogin;
        private $userDB;

        public function __construct(){
            $this->userDB = new UsuariosDB();
            $this->setFormReg();
            $this->setFormLogin();
        }

        // Método para manejar registros
        public function registrarUsuario($postData) {
            if (!isset($postData['action']) || $postData['action'] !== 'REG_USUARIOS') {
                return;
            }

            // Sanitizamos los datos
            $datos = [];
            foreach ($postData as $key => $value) {
                if ($key !== 'action') {
                    $datos[$key] = htmlspecialchars(trim($value));
                }
            }     

            // Guardamos el usuario en la base de datos
            $res = $this->userDB->AddUsuariosDB($datos);

            return ($res == 1) 
                ?  '<div class="alert alert-success">Datos Guardados Correctamente</div>'
                :  '<div class="alert alert-danger">Datos No Guardados Correctamente</div>';
        }

        public function loginUsuarios($postData){
            if (!isset($postData['action']) || $postData['action'] !== 'LOGIN_USER') {
                return;
            }
    
            // Sanitizamos los datos
            $datos = [];
            foreach ($postData as $key => $value) {
                if ($key !== 'action') {
                    $datos[$key] = htmlspecialchars(trim($value));
                }
            }
    
            // Consultamos el usuario en la base de datos
            $dtUser = $this->userDB->ConsultarUsuariosNombre($datos);
    
            if ($dtUser === -1) {
                return '<div class="alert alert-danger">No existe el Usuario</div>';
            }
    
            if ($dtUser['estado'] == 1) {
                if (MD5($datos['pass']) == $dtUser['pass']) {
                    $_SESSION['user'] = $dtUser['email'];
                    $_SESSION['nombre'] = $dtUser['nombre'];
                    return '<div class="alert alert-success">Inicio de sesión exitoso</div>';
                } else {
                    return '<div class="alert alert-danger">Contraseña incorrecta</div>';
                }
            } else {    

                return '<div class="alert alert-danger">El Usuario no tiene permisos</div>';
            }
        }

        private function setFormReg(){
            $this->formreg = '
                <form id="FormReg" class="form-control" method="POST" action="index.php" enctype="multipart/form-data" >
                    <h3>Formulario de registro:</h3>
                    <input id ="user" name="nombre" type="text" class="form-control" placeholder="Usuario:" minlength="3" maxlength="10" required />
                    <input id="pass1" type="password" class="form-control" placeholder="Password:" required />
                    <input id="pass2" name="pass" type="password" class="form-control" placeholder="Repetir password:" required />
                    <input id="mail1" type="email"  class="form-control" placeholder="E-mail:" required />
                    <input id="mail2" name="email" type="mail"  class="form-control" placeholder="repetir E-mail:" required />
                    <input type="file" name="foto" class="form-control" placeholder="Subir una foto:" />
                    <input id="conectado" type="hidden" name="conectado" value="0" />
                    <input id="estado" type="hidden" name="estado" value="0" />
                    <input type="hidden" name="action" value="REG_USUARIOS" />
                    <input class="btn btn-success" type="submit" value="REGISTRO" />
                    <input class="btn btn-danger" type="reset" value="RESET" />
                </form>   
            ';
        }

        private function setFormLogin(){
            $this->formlogin = '
                <form class="form-control" method="POST" action="index.php">
                    <h3>Formulario de acceso:</h3>
                    <input name="user" type="email" class="form-control" placeholder="Usuario:" required />
                    <input name="pass" type="password" class="form-control" placeholder="Password:" required />
                    <input type="hidden" name="action" value="LOGIN_USER" />
                    <input class="btn btn-success" type="submit" value="LOGIN" />
                    <input class="btn btn-danger" type="reset" value="RESET" />
                </form>           
            ';
        }

        public function getFormReg(){            
            return $this->formreg;
        }

        public function getFormLogin(){            
            return $this->formlogin;
        }
    }