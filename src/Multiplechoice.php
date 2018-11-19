<?php

namespace Multiplechoice;

use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Yaml\Parser;

class Multiplechoice{
    private $pregun;
    private $cant;
    private $preguntasExamen;

    public function __construct($cant = 12) {   
        $this->cant = $cant;
        $this->pregun = Yaml::parseFile('/Preguntas/preguntas.yml');
        $this->pregun = shuffle($this->pregun);
        while($cant>0){
            $this->preguntasExamen = $this->pregun[$this->cant];
            $cant--;
        }

    }

    public function obtenerpreguntas($numero){
        return $this->preguntasExamen[$numero];
    }

    public function opciones($pregunta){

    }


}