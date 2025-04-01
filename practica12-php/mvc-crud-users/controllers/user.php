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
                        $msn = '<div class="alert-success">Datos guardados correctamente</div>';
                    } else {
                        $msn = '<div class="alert-danger">Error al guardar los datos</div>';
                    }
            }
        }
    }


    class Usuarios {

        //1. propiedad
        private $formreg;

        public function __construct(){
        //3. llena la propiedad de valor setFormReg()
            $this->setFormReg();
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

    }

?>