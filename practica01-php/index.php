<?php

/*Declarar constantes*/
define('pi', 3.14); //El nombre de la variable constante, entre comillas.
// echo pi;

/*Definir variables*/ 
$casa = 'roja';
echo $casa;

// echo pi. '<br>';//Concatena el valor de pi con html
// echo $casa;

echo '<div>'.$casa.'</div>';

/*Definir matrices*/
$coches = ["Ford", "Nissan"];
$coches2 = array(["Seat"]);

// echo $coches[1];

//Diferencia coon JS

$cochesNominal = [
                "marca"=>"Ford",
                "modelo"=>["model1"=>"x25", 
                            "model2"=>
                            ["x26",
                            "x26a"]
                            ]
                ];

// echo $cochesNominal["marca"];

// echo $coches[1];

echo $cochesNominal["modelo"]["model2"][1]; 

?>

<div>
    <?php echo $casa ?>
</div>