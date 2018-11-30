<?php

namespace MultipleChoice;


class pregunta{

    protected $descipciones;
    protected $ocultartodasAnteriores =false ;
    protected $ocultarNingunatodasAnteriores = false;
    protected $respuesta_incorrectas;
    protected $respuestas_correcta = [];
    protected $opcionesExamen = [];
    protected $letraCorrecta;
    protected $abc = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N'];


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
        $this->opciones();
        $this->letraCorrecta = $this->getCorrectas();

    }

    public function opciones(){

        $this->opcionesExamen = array_merge($this->respuestas_correcta,$this->respuesta_incorrectas);
        shuffle($this->opcionesExamen);
        $this->ningunaoTodasAnteriores();
    }

    public function ningunaoTodasAnteriores(){
        if(count($this->respuesta_incorrectas) == 0){
            $this->respuesta_incorrectas = $this->respuestas_correcta;
            $this->respuestas_correcta = [];
            if($this->ocultartodasAnteriores ==false){
                $this->respuestas_correcta [0]= 'Todas las anteriores';
               array_push($this->opcionesExamen,'Todas las anteriores');
            } 
            if($this->ocultarNingunatodasAnteriores==false){
                array_push($this->respuesta_incorrectas ,'Ninguna de las anteriores');
                array_push($this->opcionesExamen ,'Ninguna de las anteriores');
            }   
        }
        if(count($this->respuestas_correcta) == 0){
            if($this->ocultartodasAnteriores==false){
                array_push($this->respuesta_incorrectas,'Todas las anteriores');
                array_push($this->opcionesExamen,'Todas las anteriores');
            } 
            if($this->ocultarNingunatodasAnteriores==false){
                $this->respuestas_correcta [0] = 'Ninguna de las anteriores';
                array_push($this->opcionesExamen,'Ninguna de las anteriores');
            } 
        }
    }

    public function getCorrectas(){
        echo gettype($this->respuestas_correcta);
        echo "\n";
        $letras = $this->abc[array_search($this->respuestas_correcta[0], $this->opcionesExamen)];
        return $letras;
	}

    public function mostrarDesc(){
        return $this->descipciones;
    }

    public function optenerpreg(){
        return $this->opcionesExamen;
    }
    public function obtenerletra(){
        return $this->letraCorrecta;
    }
}

/**
 * Commit
 */
