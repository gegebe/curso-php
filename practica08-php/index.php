<?php

    $datos = ['red','blue','green'];

?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Ejercicio 08 PHP</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <form method="get">
            <select name="colores">
                <!--name="" es necesario para recoger el valor de value o interno de option por get-->
                <option>Escoge un color</option>
                <?php 

                    foreach($datos as $item){
                        
                        echo '<option value="'.$item.'">'.$item.'</option>';
                        echo var_dump($datos);//debuggear
                    }
                    /* Se podría pasar un valor distinto al value="" con,
                    por ejemplo, un número $i y incrementarlo */

                    
                ?>
            </select>
            <button type="submit">Enviar</button>
        </form>
        <?php
            // for($i=0;$i < count($datos); $i++){
            //     switch($datos[$i]){
            //         case 'red':
            //             echo '<div style="background-color:'.$datos[$i].'">'.$datos[$i].'</div>';
            //             break;

            //         case 'blue':
            //             echo '<div style="background-color:'.$datos[$i].'">'.$datos[$i].'</div>';
            //             break;

            //         case 'green':
            //             echo '<div style="background-color:'.$datos[$i].'">'.$datos[$i].'</div>';
            //             break;

            //         default:
            //             $color = 'orange';
            //             echo '<div style="background-color:'.$color.'>'.$color.'</div>';
            //             break;
            //     }
            // }


            /* Con el siguiente if($_GET){} solo devuelve el color obtenido por GET al enviar el form*/

            // if($_GET){
            //     if(
            //         isset($_GET['colores']) 
            //         && 
            //         !empty($_GET['colores'])){

            //         switch($_GET['colores']){
            //             case 'red':
            //                 echo '<div style="background-color:'.$_GET['colores'].'">'.$_GET['colores'].'</div>';
            //                 break;
        
            //             case 'blue':
            //                 echo '<div style="background-color:'.$_GET['colores'].'">'.$_GET['colores'].'</div>';
            //                 break;
        
            //             case 'green':
            //                 echo '<div style="background-color:'.$_GET['colores'].'">'.$_GET['colores'].'</div>';
            //                 break;
        
            //             default:
            //                 $color = 'orange';
            //                 echo '<div style="background-color:'.$color.'>'.$color.'</div>';
            //                 break;
            //         }
            //     }  
            // }
            

            //CON FUNCIÓN PARA VERIFICAR EL ESTADO

            if($_GET){
                //Rcibe todos los $_GET, no solo el de los colores
                if(
                    isset($_GET['colores']) 
                    && 
                    !empty($_GET['colores'])){
                        $color = $_GET['colores'];

                        $verificar = false;
                        $verificar = verificarEstado($_GET['colores']);

                        if($verificar){
                            switch($color){
                                case 'red':
                                    echo '<div style="background-color:'.$color.'">'.$color.'</div>';
                                    break;
                
                                case 'blue':
                                    echo '<div style="background-color:'.$color.'">'.$color.'</div>';
                                    break;
                
                                case 'green':
                                    echo '<div style="background-color:'.$color.'">'.$color.'</div>';
                                    break;
                
                                default:
                                    $colorAlt = 'orange';
                                    echo '<div style="background-color:'.$colorAlt.'>'.$colorAlt.'</div>';
                                    break;
                            }
                        }

                    }  
                }

            

                function verificarEstado($color){
                    return true;
                }
        ?>
    </body>
</html>