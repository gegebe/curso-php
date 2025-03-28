<html lang="es">
<head>
    <title>Ejercicio 10 - PHP</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer">
</head>
<body>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">

            <a class="navbar-brand" href="#">Navbar</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!--ELEMENTOS DE NAV - INICIO-->
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <!--PRIMER ITEM-->
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <!--SEGUNDO ITEM-->
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <!--TERCER ITEM-->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Dropdown
                        </a>
                            <!--DESPLEGABLE - INICIO-->
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                            <!--DESPLEGABLE - FIN-->
                        </li>
                    <!--CUARTO ITEM-->    
                    <li class="nav-item">
                        <a class="nav-link disabled" aria-disabled="true">Disabled</a>
                    </li>
                </ul>
                <!--ELEMENTOS DE NAV - FIN-->

                <!--BUSCADOR INICIO-->
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
                <!--BUSCADOR FIN-->
            </div>
        </div>
    </nav>

    <?php

        $menu = new Menu('principal');
        echo $menu->getMenu();

    ?>

    <!--bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <!--propio-->
    <script src="js/script.js"></script>

</body>
</html>
<?php

    //1. Crear class llamada menu
    //2. Qué el menú de bootstrap sea pintado por PHP de forma dinámica
    //3. El menú será un objeto
    //4. Los ítems de menú están contenidos en el objeto
    class Menu {
        private $nombre;
        private $items = [
            ['Home','http://curso.test/curso_php/practica10.php'], 
            ['Link','https://'],       
            ['Action','https://']
        ];
        private $lista;
        private $menu;
        private $form;

        public function __construct($nombre){
            $this->nombre = $nombre;
            $this->setLista();
            $this->setForm();
            $this->setMenu();
            //// Al invocarlo en el construct, pinta lo contenido en $menu
        }

        private function setMenu(){
            //Crear menú
            //// El setMenu, "llena" la propiedad private $menu.
            $this->menu = '<nav id="'.$this->nombre.'" class="navbar navbar-expand-lg bg-body-tertiary">';
            $this->menu .= '<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                           </button>';

            $this->menu .= '<div class="collapse navbar-collapse" id="navbarSupportedContent">
                            </div>';

            $this->menu .= $this->form;
            $this->menu .= '</nav>';
        }

        public function setLista(){
            $this->lista = '<ul class="navbar-nav me-auto mb-2 mb-lg-0">';

                foreach($this->items as $item){
                    $this->lista .= '<li class="nav-item">
                                        <a class="nav-link active" aria-current="page" href="'.$item[1].'">'.$item[0].'</a>
                                    </li>';
                }

            $this->lista .= '</ul>';
        }

        public function getMenu(){
            //Mostrar menú
            echo $this->menu;

        }

        private function setForm(){
            $this->form = '<form class="d-flex" role="search">
                                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                                <button class="btn btn-outline-success" type="submit">Search</button>
                           </form>';
        }
    }


?>