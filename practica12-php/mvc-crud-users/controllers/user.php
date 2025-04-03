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

        if(isset($_GET['views']) AND !empty($_GET['views'])){

            if($_GET['views'] == 'edituser'){

                if(isset($_GET['action']) AND !empty($_GET['action'])){
                    
                    if($_GET['action'] == 'edituser'){
                        $rowid = base64_decode($_GET['id']);
                        $usuarios->consultarUserId($rowid);
                    }

                }

            }

        }

        if(isset($_GET['action']) && !empty($_GET['action'])){
            if($_GET['action'] == 'CERRAR_SESSION'){
                $usuarios->cerrarSession();
            }

        }
    }

     
    


    class Usuarios{

        private $formreg;
        private $formregedit;
        private $formlogin;
        private $userDB;
        private $table;

        public function __construct(){
            $this->userDB = new UsuariosDB();
            $this->setFormReg();
            $this->setFormLogin();
            $this->setTable();
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

        public function cerrarSession(){
            session_destroy();//Vaciar los datos
            unset($_SESSION);//Vacia 
            return;
        }

        private function setFormReg(){
            $this->formreg = '
                <form id="FormReg" class="form-control" method="POST" action="index.php" enctype="multipart/form-data">
                    <h3>Formulario de registro:</h3>
                    <input id ="user" name="nombre" type="text" class="form-control" placeholder="Usuario:" minlength="3" maxlength="10" required>
                    <input id="pass1" type="password" class="form-control" placeholder="Password:" required>
                    <input id="pass2" name="pass" type="password" class="form-control" placeholder="Repetir password:" required>
                    <input id="mail1" type="email"  class="form-control" placeholder="E-mail:" required>
                    <input id="mail2" name="email" type="mail"  class="form-control" placeholder="repetir E-mail:" required>
                    <input type="file" name="foto" class="form-control" placeholder="Subir una foto:">
                    <input id="conectado" type="hidden" name="conectado" value="0">
                    <input id="estado" type="hidden" name="estado" value="0">
                    <input type="hidden" name="action" value="REG_USUARIOS">
                    <input class="btn btn-success" type="submit" value="REGISTRO">
                    <input class="btn btn-danger" type="reset" value="RESET">
                </form>   
            ';
        }

        public function getFormReg(){            
            return $this->formreg;
        }

        private function setFormRegEdit(){
            $this->formregedit = '
                <form id="FormReg" class="form-control" method="POST" action="index.php" enctype="multipart/form-data">
                    <h3>Formulario de registro:</h3>
                    <input id ="user" name="nombre" type="text" class="form-control" placeholder="Usuario:" minlength="3" maxlength="10" required>
                    <input id="pass1" type="password" class="form-control" placeholder="Password:" required>
                    <input id="pass2" name="pass" type="password" class="form-control" placeholder="Repetir password:" required>
                    <input id="mail1" type="email"  class="form-control" placeholder="E-mail:" required>
                    <input id="mail2" name="email" type="mail"  class="form-control" placeholder="repetir E-mail:" required>
                    <input type="file" name="foto" class="form-control" placeholder="Subir una foto:">
                    <input id="conectado" type="hidden" name="conectado" value="0">
                    <input id="estado" type="hidden" name="estado" value="0">
                    <input type="hidden" name="action" value="REG_USUARIOS">
                    <input class="btn btn-success" type="submit" value="REGISTRO">
                    <input class="btn btn-danger" type="reset" value="RESET">
                </form>   
            ';
        }

        public function getFormRegEdit(){
            return $this->formregedit;
        }


        private function setFormLogin(){
            $this->formlogin = '
                <form class="form-control" method="POST" action="index.php">
                    <h3>Formulario de acceso:</h3>
                    <input name="user" type="email" class="form-control" placeholder="Usuario:" required>
                    <input name="pass" type="password" class="form-control" placeholder="Password:" required>
                    <input type="hidden" name="action" value="LOGIN_USER">
                    <input class="btn btn-success" type="submit" value="LOGIN">
                    <input class="btn btn-danger" type="reset" value="RESET">
                </form>           
            ';
        }

        public function getFormLogin(){            
            return $this->formlogin;
        }

        private function setTable(){
            $this->table = '
            <table class="table table-striped table-dark table-hover">
                <thead>
                    <tr>
                        <th>rowid</th>
                        <th>nombre</th>
                        <th>e-mail</th>
                        <th>conectado</th>
                        <th>estado</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>';

                //Conectar a BD
                $dtUsuarios = $this->userDB->consultarUsuarios();

                foreach($dtUsuarios as $dtUsuario){
                    // $this->table.='<td>'.$dtUsuario['estado'].'</td>';
                    $this->table.='<tr>';
                    $this->table.='<td>'.$dtUsuario['rowid'].'</td>';
                    $this->table.='<td>'.$dtUsuario['nombre'].'</td>';
                    $this->table.='<td>'.$dtUsuario['email'].'</td>';
                    $this->table.='<td>'.$dtUsuario['conectado'].'</td>';
                    $this->table.='<td>
                                        <div class="btn btn-outline-secondary">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked">
                                            </div>
                                        </div>
                                    </td>';
                    $this->table.='<td>
                                        <a href="index.php?views=edituser&action=edituser&id='.base64_encode($dtUsuario['rowid']).'" class="btn btn-success"> 
                                            <span class="fa-solid fa-pen-to-square"></span>
                                        </a>
                                    </td>';
                    $this->table.='<td>
                                        <a href="" class="btn btn-danger"> 
                                            <span class="fa-solid fa-trash"></span>
                                        </a>
                                    </td>';
                    $this->table.='</tr>';
                };

               $this->table .= '
               </tbody>
                <tfoot>
                    <tr>
                        <td class="" colspan="7">
                            Total de usuarios:
                        </td>
                    </tr>
                </tfoot>
            </table>';
        }

        public function getTable(){
            return $this->table;
            
        }

        public function consultarUserId($rowid){
            $dtUser = $this->userDB->consultarUserIdDB($rowid);
        }
    }