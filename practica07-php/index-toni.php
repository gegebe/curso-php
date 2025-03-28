<?php

    $usuarios = [
        ['User', '1234','user@miapp.com','red'],
        ['Admin', '1234','admin@miapp.com','blue'],
        ['Pepe', '1234','pepe@miapp.com','green'],
        ['Juan', '1234','juan@miapp.com','orange'],
        ['Marta', '1234','marta@miapp.com','grey']
    ];

    $detalles = [
        'nombre' => 'Costuras',
        'num' => 2,
        'dificultad' => 10 
    ];

    /* Se recuperan los valores de la Array */

    


    //echo $detalles['nombre'];

    // foreach($detalles as $key=> $dato){
    //     echo 'la key es: ' .$key .', el valor de key: '. $dato.'<br><hr>';
    //     //echo 'también se escribe como en JS '.$detalles[$key].'<br><hr>';
    // }

    // for($i = 0; $i < count($usuarios); $i++){
    //     echo $usuarios[$i][0];
    //     echo $usuarios[$i][1];
    //     echo $usuarios[$i][2];
    //     echo $usuarios[$i][3];
    // }

    //bucle anidado
    // for($i = 0; $i < count($usuarios); $i++){
    //     for($j = 0; $j < 4; $j++){
    //         echo $usuarios[$i][$j].'<br><hr>';
    //     };
    // }

    // function recortarMail(){
    //     $mail = strpos("prueba@gmail.com","@");
    //     echo $mail;
    // }
    // recortarMail();//Devuelve 6
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Ejercicio 07 PHP</title>
        <meta charset="utf-8">
    </head>
    <body>
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Dominio</th>
                    <th>Extensión</th>
                </tr>
            </thead>
            <tbody>
                <!--Código reutilizable-->
                <?php
                try{
                    $i = 0;

                    foreach($usuarios as $items){
                        $item = separable($items, $i);
                        pintarResultado($items, $i);

                        // echo '<tr>';
                        // echo '<td>'.$item[$i]['buzon'].'</td>';
                        // echo '<td>'.$item[$i]['dominio'].'</td>';
                        // echo '<td>'.$item[$i]['extension'].'</td>';
                        // echo '</tr>';

                        $i++;
                    };

                }catch(Exception $e) {
                
                    echo var_dump($e);
                   
                };
                    

                ?>
            </tbody>
        </table>
    </body>
</html>
<?php
function separable(Array $item, int $i){

    $mail = $item[2]; //1. item (el e-mail), pasa a ser el valore de la variable $mail

    //2. Se recupera la parte del e-mail sin ARROBA NI BUZÓN
    $emailSinArroba = substr($mail, strpos($mail, '@') + 1);
    //echo $emailSinArroba;

    //3. SE RECUPERA EL VALOR DEL BUZÓN, se busca recuperar desde 0 hasta la posición que ocupa la @
    $datos[$i]['buzon'] = substr($mail, 0, strpos($mail, '@'));
    
    //4. SE EXTRAE EL DOMINIO COMENZANDO CON la parte SIN ARROBA NI BUZÓN hasta encontrar el PUNTO
    $datos[$i]['dominio'] = substr($emailSinArroba, 0, strpos($emailSinArroba, '.'));

    //5. SE EXTRAE LA EXTENSIÓN, comezando con la parte SIN ARROBA NI BUZÓN, hasta encontrar el PUNT= ??
    $datos[$i]['extension'] = substr($emailSinArroba, strpos($emailSinArroba, '.') + 1);
    
    //SE DEVUELVE LA ARRAY COMPLETA
    return $datos;
    //Al solo poder devolver una cosa, se devuelve $datos que ya tiene las 3 dentro.
}
//Mayor Abstraccción al separar en funciones que se comunicacn entre ellas
function pintarResultado(Array $item, int $i){

    echo '<tr>';
    echo '<td>'.$item[$i]['buzon'].'</td>';
    echo '<td>'.$item[$i]['dominio'].'</td>';
    echo '<td>'.$item[$i]['extension'].'</td>';
    echo '</tr>';

}

?>