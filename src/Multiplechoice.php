<?php

namespace Multiplechoice;

use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Yaml\Parser;

class Multiplechoice{
    private $pregun;
    private $cant;
    private $preguntasExamen;

    public function __construct($cant) {   
        $this->cant = $cant;
        $this->pregun = Yaml::parseFile('/Preguntas/preguntas.yml');
    }

    public function CrearTema($pregunta){
        
    }

    public function obtenerpreguntas($numero){
        return $this->preguntasExamen[$numero];
    }

    public function opciones($pregunta){
        
    }


}