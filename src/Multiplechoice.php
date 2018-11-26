<?php

namespace Multiplechoice;

use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Yaml\Parser;
require_once  '../vendor/autoload.php';

class Multiplechoice{
    protected $preguntas = [];
    protected $cant;
    protected $descipciones = [];
    protected $ocultartodasAnteriores = [];
    protected $ocultarNingunatodasAnteriores = [];
    protected $respuesta_incorrectas = [];
    protected $respuestas_correcta = [];
    protected $respuestasExamen = [];
    protected $cantTemas;
    protected $parche = 0;
    protected $abc = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N'];

    public function __construct($cant,$test) {   
        $this->cant = $cant;
        $this->preguntas = Yaml::parseFile('../ejemplo/preguntas.yml');
        $this->preguntas = $this->preguntas['preguntas'];
        $this->cantTemas = $test;
        $contador = 0;
        $this->preguntas = array_slice($this->preguntas, 0, $cant);
        shuffle($this->preguntas);
        foreach($this->preguntas as $pregunta){
            $this->descipciones[$contador] = $pregunta['descripcion'];
            $this->respuesta_incorrectas[$contador] = $pregunta['respuestas_incorrectas'];
            $this->respuestas_correcta[$contador] = $pregunta['respuestas_correctas'];
            if (isset($preguntas['ocultar_opcion_todas_las_anteriores'])){
                $this->ocultartodasAnteriores[$contador] = true; 
            }
            else{
                $this->ocultartodasAnteriores[$contador] = false;
            }
            if(isset($pregunta['ocultas_opcion_ninguna_de_las_anteriores'])){
                $this->ocultarNingunatodasAnteriores[$contador] = true;
            }
            else{
                $this->ocultarNingunatodasAnteriores[$contador] = false;
            }
            $contador++;
            
        }
        $this->respuestasExamen = $this->opciones();
    }

    public function getCorrectas(){
		$letras = [];
		$i = 0;
		foreach ($this->respuestas_correcta as $correctas ) {
            $letras[$i] = $this->abc[array_search($correctas[$i], $this->preguntasExamen[i])];
            $i++;
		}
		return $letras;
    }
    
    public function obtenerPreguntas(){
       return $this->preguntas;
    }

    
    public function opciones(){
        for($numero = 0;$numero < $this->cant;$numero++){ 
            if (empty ($this->respuesta_incorrectas[$numero])){
                $this->respuesta_incorrectas[$numero] = $this->respuesta_correctas[$numero];
                $this->respuesta_correctas[$numero] = [];
                if(!($this->ocultarNingunatodasAnteriores[$numero])){
                    array_push($this->respuesta_incorrectas[$numero],'Ninguna de las anteriores');            
                }
                if(!($this->ocultartodasAnteriores[$numero])){
                    $this->respuesta_correctas[$numero] = 'Todas de las anteriores';            
                }
                $this->respuestasExamen[$numero] = array_merge($this->respuestas_correcta[$numero],$this->respuesta_incorrectas[$numero]);
                shuffle($this->respuestasExamen[$numero]);
            }
            elseif (empty($this->respuesta_correctas[$numero])){
                if(!($this->ocultarNingunatodasAnteriores[$numero])){
                    $this->respuesta_correctas[$numero] = 'Ninguna de las anteriores';            
                }
                if(!($this->ocultartodasAnteriores[$numero])){
                    array_push($this->respuesta_incorrectas[$numero],'Todas de las anteriores');            
                }
                $this->respuestasExamen[$numero] = array_merge($this->respuestas_correcta[$numero],$this->respuesta_incorrectas[$numero]);
                shuffle($this->respuestasExamen[$numero]);
            }
        }
        return $this->respuestasExamen;
    }

    public function getopciones(){
        $opciones = $this->respuestasExamen[parche];
        $this->parche++;
        return $opciones;
    }
    
    public function mostrarDesc(){
        $desc = $this->descipciones[parche];
        $this->parche++;
        return $desc;
    }

}