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
            
            if($_POST['action'] == 'UPDATE_USUARIO'){
                $msn = $usuarios->updateUsuario($_POST);                 
            }   
        }       
    }

    if($_GET){
        if(isset($_GET['action']) && !empty($_GET['action'])){
            if($_GET['action'] == 'CERRAR_SESSION'){
                $usuarios->cerrarSession();
            }
        }

        if($_GET['action'] == 'borrarusuario'){
            $rowid = base64_decode($_GET['id']);
            $usuarios->DeleteUsuario($rowid);
        }
    }


    class Usuarios{

        private $formreg;
        private $formregedit;
        private $formlogin;
        private $userDB;
        private $table;
        private $dtUser;

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

        public function updateUsuario($postData){
            if (isset($postData['action']) AND $postData['action'] !== 'UPDATE_USUARIO') {
                return;
            }

            // Sanitizamos los datos
            $datos = [];
            foreach ($postData as $key => $value) {
                if ($key !== 'action') {
                    $datos[$key] = htmlspecialchars(trim($value));
                }
            }

            // Actualizamos la base de datos
            $res = $this->userDB->UpdateUsariosDB($datos);

            return ($res == 1) 
                ?  '<div class="alert alert-success">Datos actualizados correctamente</div>'
                :  '<div class="alert alert-danger">Error al actualizar los datos</div>';
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

        public function DeleteUsuario($rowid){
            $res = $this->userDB->DeleteUserDB($rowid);
            return ($res == 1) 
            ?  '<div class="alert alert-success">Dato borrado correctamente</div>'
            :  '<div class="alert alert-danger">Error al borrar datos</div>';
        }

        private function setFormReg(){
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
            return $this->formreg;
        }

        private function setFormRegEdit(){
            $this->formregedit = '
            <form id="FormReg" class="form-control" method="POST" action="index.php" enctype="multipart/form-data">
                <h3>Formulario de actualización</h3>
                <ul>
                    <li>
                        <label for="nombre">Nombre</label>
                        <input id="nombre" name="nombre" type="text" class="form-control" placeholder="Usuario" value="'.$this->dtUser['nombre'].'" required>
                    </li>
                    <li>
                        <label for="pass">Password</label>
                        <input name="pass" id="pass1" type="password" class="form-control" placeholder="Password" value="">
                    </li>
                    <li>
                        <label for="pass">Repetir password</label>
                        <input name="pass" id="pass2" type="password" class="form-control" placeholder="Repetir password" value="">
                    </li>
                    <li>
                        <label for="email">Email</label>
                        <input name="email" id="email1" type="mail" class="form-control" placeholder="Email" value="'.$this->dtUser['email'].'" required>
                    </li>
                    <li>
                        <label for="email2">Repetir email</label>
                        <input name="email2" id="email2" type="mail" class="form-control" placeholder="Repetir email" value="'.$this->dtUser['email'].'" required>
                    </li>
                    <li>
                        <label for="foto">Foto</label>
                        <input name="foto" id="foto" type="file" class="form-control" value="'.$this->dtUser['foto'].'">
                    </li>

                    <li>
                        <input type="hidden" name="conectado" value="0">
                    </li>
                    <li>
                        <input type="hidden" name="estado" value="'.$this->dtUser['estado'].'">
                    </li>
                    <li>
                        <input type="hidden" name="action" value="UPDATE_USUARIO">
                    </li>
                    <li>
                        <input type="hidden" name="rowid" value="'.$this->dtUser['rowid'].'">
                    </li>

                    <li>
                        <ul class="d-flex">
                            <li>
                                <button class="btn btn-success" type="submit">ACTUALIZAR</button>
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

        public function getFormRegEdit(){
            if(isset($_GET['views']) AND !empty($_GET['views'])){

                if($_GET['views'] == 'edituser'){
    
                    if(isset($_GET['action']) AND !empty($_GET['action'])){
                        
                        if($_GET['action'] == 'edituser'){
                            $rowid = base64_decode($_GET['id']);
                            $this->dtUser = $this->userDB->consultarUserIdDB($rowid);
                        }
    
                    }
    
                }
    
            }

            $this->setFormRegEdit();
            return $this->formregedit;
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
                                        <a href="index.php?action=borrarusuario&id='.base64_encode($dtUsuario['rowid']).'" class="btn btn-danger"> 
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

    }