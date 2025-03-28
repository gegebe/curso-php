<?php
    $datos = ['user'=>'Admin','pass'=>'1234'];
    if($_POST){
        if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action'] == 'validar'){
                if(isset($_POST['user']) && !empty($_POST['user']) 
                    && isset($_POST['pass']) && !empty($_POST['pass'])){
                        $user = $_POST['user'];
                        $pass = $_POST['pass'];
                        $misDatos = $_POST;
                        
                        if($user == $datos['user'] && $pass == $datos['pass']){
                            echo '<div class="alert alert-succes"><h2>Acceso '.$misDatos['user'].'</h2></div>';
                        } else {
                            echo '<div class="alert alert-danger"><h2>No tienes acceso</h2></div>';
                        }
                    }
                }
            }
?>