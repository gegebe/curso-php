<?php


    // fichero controller.
    $datos = ['user'=>'Toni','pass'=>'abcd'];
    // if($_GET){
    //     //echo print_r($_GET);
    //     if(isset($_GET['action']) && !empty($_GET['action'] && $_POST['action'] == 'validar')){    
    //         $user = $_GET['user'];
    //         $pass = $_GET['pass'];
    //         if($user == $datos['user'] && $pass == $datos['pass']){
    //             $res = '<div class="alert alert-success"><h2>Acceso</h2></div>';
    //             header('Location:index.php?res='.$res);
    //         }
    //         else
    //         {
    //             $res = '<div class="alert alert-danger"><h2>No tiene Acceso</h2></div>';
    //             header('Location:index.php?res='.$res);
    //         } 
    //     }  
    // }
    if($_POST){
        //echo print_r($_POST);
        if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action'] == 'validar'){
            if(isset($_POST['user']) && !empty($_POST['user']) && isset($_POST['pass']) && !empty($_POST['pass'])){
                 $user = $_POST['user'];
                 $pass = $_POST['pass'];
                 $mipost = $_POST;
                 if($user == $datos['user'] && $pass == $datos['pass']){
                    // Empezar una sesión - cookie de sesión
                    session_start();
                    $_SESSION['usuario'] = $user; //Pasa esta variable al objeto $GLOBALS
                    $_SESSION['tema'] = 'white'; //Por ejemplo, el usuario siempre que acceda verá el tema en blanco
                

                    // $res = '<div class="alert alert-success"><h2>Acceso, SR. '.$mipost['user'].'</h2></div>';
                    // header('Location: index.php?res='.$res);
                }
                 else
                 {
                    // $res = '<div class="alert alert-danger"><h2>No tiene Acceso</h2></div>';
                    // header('Location: index.php?res'.$res);
                } 
            }                 
           
        } 
         
    }  

    /*
    $_GET
    $_POST -> DATOS
    $_FILES -> ARCHIVOS (IMÁGENES, ETC.)
    $GLOBALS -> Cualquier variable global va a parar a este objeto, se utiliza para coger datos de el, debuggear.
    */
?>