<?php

    ////////
    //// Encpsulamiento
    ////////
    /* Meter el código dentro de una estructura, 
    el funcionamiento tiene lugar fuera de esta estructura.
    Hay elementos que pueden ser públicos, se pueden utilizar desde fuera del objeto.
    Los elementos privados, no pueden ser llamados desde fuera del objeto. */

    ////////
    //// Abstracción
    ////////

    ////////
    //// Polimorfismo
    ////////

    ////////
    //// Herencia
    ////////

    class Persona {

        public $nombre = 'Gerard';
        public $edad = 42;
        public $color;

        public function __construct($nombre="", $edad=""){
            $this->color = 'red';
            //Pasan los valores por los parámetros que acepta el objeto
            //El constructor asignará esos valores
            $this->nombre = $nombre;
            $this->edad = $edad;
        }

        public function saludar(){
            echo 'Hola soy '.$this->nombre.' y el color es '.$this->color;
        }
        
    }


    $usuarios = [
        ['User', '1234','user@miapp.com','red'],
        ['Admin', '1234','admin@miapp.com','blue'],
        ['Pepe', '1234','pepe@miapp.com','green'],
        ['Juan', '1234','juan@miapp.com','orange'],
        ['Marta', '1234','marta@miapp.com','grey']
    ];

    $i=1;
    foreach($usuarios as $usuario){
        //Nombre de la variable dinámico, en función de las vueltas del foreach
        ${'persona'.$i} = new Persona($usuario[0],$usuario[1]);
        $i++;
    }

    
        // Escribe los nombres generados por el foreach de manera dinámica
        echo $persona1->nombre.'<br>';
        echo $persona2->nombre.'<br>';

        //Llamarlos a todos mediante un bucle while()
        $j=1;
        while($j < 6){
            echo ${'persona'.$j}->nombre.'<br>';
            $j++;
        }

    

    // $persona1 = new Persona();

    // echo $persona1->nombre.'<br>'; 
    // //echo $persona1->edad.'<br>';
    // //Da error si llamamos a propiedades privadas
    // echo $persona1->color.'<br>';

    // //Manera de pintar el valor de la propiedad nombre

    // $persona1->saludar();

    // $persona2 = new Persona('Maria','32');
    // echo $persona2->nombre.'<br>';


?>