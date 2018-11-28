<?php

namespace Multiplechoice;


class pregunta{

    protected $descipciones;
    protected $ocultartodasAnteriores ;
    protected $ocultarNingunatodasAnteriores;
    protected $respuesta_incorrectas = [];
    protected $respuestas_correcta = [];


    public function __construct($yaml){
        $this->descipciones = $yaml["descripcion"];
        $this->respuesta_incorrectas = $yaml["respuestas_incorrectas"];
        $this->respuestas_correcta =  $yaml["respuestas_correctas"];
        if(array_key_exists("ocultar_opcion_todas_las_anteriores",$yaml)){
            $this->ocultartodasAnteriores = true;
        }
        if(array_key_exists("ocultas_opcion_ninguna_de_las_anteriores",$yaml)){
            $this->ocultarNingunatodasAnteriores = true;
        }
    }

    public function opciones(){
       
        if ($this->respuesta_incorrectas = []){
            $this->respuesta_incorrectas = $this->respuestas_correcta;
            $this->respuestas_correcta = [];
            if(!($this->ocultarNingunatodasAnteriores)){
                array_push($this->respuesta_incorrectas,'Ninguna de las anteriores');            
            }
            if(!($this->ocultartodasAnteriores)){
                $this->respuestas_correcta = 'Todas de las anteriores';           
            }
            $this->preguntasExamen = array_merge($this->respuestas_correcta,$this->respuesta_incorrectas);
            
        }
        elseif ($this->respuestas_correcta = []){
            
            if(!($this->ocultarNingunatodasAnteriores)){
                $this->respuestas_correcta = 'Ninguna de las anteriores';            
            }
            if(!($this->ocultartodasAnteriores)){
                array_push($this->respuesta_incorrectas,'Todas de las anteriores');            
            }
            $this->preguntasExamen = array_merge($this->respuestas_correcta,$this->respuesta_incorrectas);

        }
        return $this->preguntasExamen;
    }
    public function getCorrectas() {
		$letras = [];
		$i = 0;
		foreach ($this->respuestas_correcta as $correctas ) {
            $letras[$i] = $this->abc[array_search($correctas[$i], $this->preguntasExamen[i])];
            $i++;
		}
		return $letras;
	}

    public function mostrarDesc($numero){
        return $this->descipciones;
    }
}