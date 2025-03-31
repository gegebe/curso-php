<?php

    //CONSTANTES
    require_once('config.php');
    //MODELO
    require_once('models/user.php');

    if($_POST){
        if(isset($_POST['action']) && !empty($_POST['action'])){
            if($_POST['action'] == 'REG_USUARIOS'){

                foreach($_POST as $key=>$value){
                    if($key != 'action'){
                        $datos[$key] = $value;
                    }
                                   
                }
                
                //Datos que llegan del $_POST
                echo print_r($_POST);
                echo '<br>';
                //Datos que llegan filtrados por el foreach, descartando la key con valor action
                echo print_r($datos);
            }
        }
    }

?>