<?php
    class Nodo{
        public $nombre;
        public $atributos;
        public $nodos;

        public function __construct($nombre){
            $this->nombre = $nombre;
            $this->atributos = array();
            $this->nodos = array();
        }

        public function agregarAtributo($nombre, $valor){
            $this->atributos[$nombre] = $valor;
        }

        public function agregarNodo($nombre){
            $this->nodos[] = $nombre;
        }
    }