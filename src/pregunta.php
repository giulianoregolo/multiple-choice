<?php

namespace Multiplechoice;


class pregunta{

    protected $descipciones;
    protected $ocultartodasAnteriores ;
    protected $ocultarNingunatodasAnteriores;
    protected $respuesta_incorrectas = [];
    protected $respuestas_correcta = [];
    protected $opcionesExamen = [];


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
            $this->opcionesExamen = array_merge($this->respuestas_correcta,$this->respuesta_incorrectas);
            shuffle($this->opcionesExamen);
        return $this->opcionesExamen;
    }
    public function getCorrectas() {
		$letras = [];
		$i = 0;
		foreach ($this->respuestas_correcta as $correctas ) {
            $letras[$i] = $this->abc[array_search($correctas[$i], $this->opcionesExamen[i])];
            $i++;
		}
		return $letras;
	}

    public function mostrarDesc(){
        return $this->descipciones;
    }
}