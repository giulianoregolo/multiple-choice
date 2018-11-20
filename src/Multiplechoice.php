<?php

namespace Multiplechoice;

use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Yaml\Parser;

class Multiplechoice{
    private $pregun;
    private $cant;
    private $descipciones;
    private $ocultartodasAnteriores;
    private $ocultarNingunatodasAnteriores;
    private $respuesta_incorrectas;
    private $respuestas_correctas;

    public function __construct($cant) {   
        $this->cant = $cant;
        $this->pregun = Yaml::parseFile('/Preguntas/preguntas.yml');
    }

    public function Generarpregunta(){
        $contador = 0; 
        foreach($this->pregun as $pregunta){
            $descipciones[$contador] = $pregunta[descripcion];
            $this->respuesta_incorrectas[$contador] = $pregunta[respuestas_incorrectas];
            $this->respuestas_correctas[$contador] = $pregunta[respuestas_correctas];
            if (array_key_exists('ocultar_opcion_todas_las_anteriores',$preguntas)){
                $this->ocultartodasAnteriores[$contador] = true; 
            }
            else{
                $this->ocultartodasAnteriores[$contador] = false;
            }
            if(array_key_exists('ocultas_opcion_ninguna_de_las_anteriores',$pregunta)){
                $this->ocultarNingunatodasAnteriores[$contador] = true;
            }
            else{
                $this->ocultarNingunatodasAnteriores[$contador] = false;
            }
        $contador++;
        }

    }

    public function opciones($cant){
        
        if ($this->respuesta_incorrectas[$cant] = []){
            $this->respuestas_correcta[$cant+1] ='Todas son correctas'; 

        }
        if ($this->respuesta_correctas[$cant] = []){
            $this->respuest_correcta[$cant+1] ='Ninguna es correcta'; 
        }


    }

    public function CrearTema($pregunta){
        
    }

    public function obtenerpreguntas($numero){
        return $this->pregun;
    }


}