<?php

    $users = ['admin', '1234'];
    
    if($_GET){
        if(isset($_GET['action']) AND !empty($_GET['action'])){
            if($_GET['action'] == 'VALIDAR_USER'){
                //echo 'hola';//Valor de vuelta en respuesta (res)
                $user = $_GET['user'];
                $pass = $_GET['pass'];

                if($user == $users[0] AND $pass == $users[1]){
                    
                    $data['msn'] = 'Usuario autorizado';
                    $data['estado'] = 1;
                    //Esta función genera un objeto JSON (string)
                    echo $respuesta = json_encode($data);                

                } else {
                    
                    $data['msn'] = "Usuario no autorizado";
                    $data['estado'] = -1;
                    echo $respuesta = json_encode($data);

                }
            }
        }
    }


?>