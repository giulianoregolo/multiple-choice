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
    protected $preguntasExamen = [];
    protected $cantTemas;
    protected $abc = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N'];

    public function __construct($cant,$test) {   
        $this->cant = $cant;
        $this->preguntas = Yaml::parseFile('../ejemplo/preguntas.yml');
        $this->preguntas = $this->preguntas['preguntas'];
        $this->cantTemas = $test;
        $contador = 0;
        foreach($this->preguntas as $pregunta){
            if($contador > $this->cant ){ 
                $this->descipciones[$contador] = $pregunta[descripcion];
                $this->respuesta_incorrectas[$contador] = $pregunta[respuestas_incorrectas];
                $this->respuestas_correcta[$contador] = $pregunta[respuestas_correctas];
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

    
    public function opciones(){
        for($numero = 0;$numero < $this->cant;$numero++){ 
            if ($this->respuesta_incorrectas[$numero] = []){
                $this->respuesta_incorrectas[$numero] = $this->respuesta_correctas[$numero];
                $this->respuesta_correctas[$numero] = [];
                if(!($this->ocultarNingunatodasAnteriores[$numero])){
                    array_push($this->respuesta_incorrectas[$numero],'Ninguna de las anteriores');            
                }
                if(!($this->ocultartodasAnteriores[$numero])){
                    array_push($this->respuesta_correctas[$numero],'Todas de las anteriores');            
                }
                shuffle($this->respuestas_correcta[$numero]);
                shuffle($this->respuesta_incorrectas[$numero]);
                $this->preguntasExamen[$numero] = array_merge($this->respuestas_correcta[$numero],$this->respuesta_incorrectas[$numero]);
            
            }
            elseif ($this->respuesta_correctas[$numero] = []){
                
                if(!($this->ocultarNingunatodasAnteriores[$numero])){
                    array_push($this->respuesta_correctas[$numero],'Ninguna de las anteriores');            
                }
                if(!($this->ocultartodasAnteriores[$numero])){
                    array_push($this->respuesta_incorrectas[$numero],'Todas de las anteriores');            
                }

                shuffle($this->respuestas_correcta[$numero]);
                shuffle($this->respuesta_incorrectas[$numero]);
                $this->preguntasExamen[$numero] = array_merge($this->respuestas_correcta[$numero],$this->respuesta_incorrectas[$numero]);

            }
        }
        return $this->preguntasExamen;
    }
    
	public function crearEvaluacion($tema){
		$loader = new Twig_Loader_Filesystem('../templates');
		$twig = new Twig_Environment($loader);
		$templateAlumn = $twig->load('../templates/alumno.html');
		//Render del HTML con las variables
		file_put_contents('evaluacionTema'.$tema.'.html', $templateAlumn->render(array('preguntas' => $this->preguntasExamen, 'tema' => $tema)));
    }
    
    public function mostrarDesc($numero){
        return $this->descipciones[$numero];
    }

}