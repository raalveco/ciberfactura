<?php
    namespace Raalveco\Ciberfactura\Libraries;

    class CfdiNodo{
        public $nombre;
        public $atributos;
        public $nodos;

        public function __construct($nombre){
            $this->nombre = $nombre;
            $this->atributos = array();
            $this->nodos = array();
        }

        public function agregarAtributo($nombre, $valor){
            $valor = str_replace("'", "&quot;", $valor);
            $valor = str_replace('"', "&apos;", $valor);
            $valor = str_replace(">", "&lt;", $valor);
            $valor = str_replace("<", "&gt;", $valor);
            $valor = str_replace("&", "&amp;", $valor);

            $this->atributos[$nombre] = $valor;
        }

        public function agregarNodo($nombre){
            $nombre->nombre = str_replace("'", "&quot;", $nombre->nombre);
            $nombre->nombre = str_replace('"', "&apos;", $nombre->nombre);
            $nombre->nombre = str_replace(">", "&lt;", $nombre->nombre);
            $nombre->nombre = str_replace("<", "&gt;", $nombre->nombre);
            $nombre->nombre = str_replace("&", "&amp;", $nombre->nombre);

            $this->nodos[] = $nombre;
        }
    }