<?php

    class Tareas {
        private $form;
        private $tabla;
        private $nombre;
        private $tiempo;
        private $estado;
        private $tareas;
        public $tarea;
        private $tareasDB;
        private $views;
        public $saludo;
    }

    public function __construct(String $saludo=''){
        $this->saludo = $saludo;
        $this->tareasDB = new TareasDB;
        $this->tareas = $this->BuscarTareasDB();
        $this->setTabla();
    }

    private function setTabla(){
        
    }

    public fucntion getTabla(){

    }

    private function setForm(){

    }

    public function getForm(String $views){

    }

    private function BuscarTareasDB(){
        
    }



?>