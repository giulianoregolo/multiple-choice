<?php

namespace Multiplechoice;

use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Yaml\Parser;
require_once  './vendor/autoload.php';

class MultipleChoice{
    protected $preguntas = [];
    protected $cant;
    protected $cantTemas;
    protected $yaml;
    protected $parche = 0;

    public function __construct($cant,$test) {   
        $this->cant = $cant;
        $this->yaml = Yaml::parseFile('./ejemplo/preguntas.yml');
        $this->yaml = $this->yaml['preguntas'];
        $this->cantTemas = $test;
        $contador = 0;
        //shuffle($this->yaml);
        $this->yaml = array_slice($this->yaml, 0, $cant);
        foreach($this->yaml as $pregunta){
            $this->preguntas[$contador] = new pregunta($pregunta);
            $contador++;
        }
        $this->crearEvaluacion($test);

    }

    public function obtenercantpreguntas(){
        return $this->cant;
    }

    public function obteneryaml(){
        return $this->yaml;
    }
    
	public function crearEvaluacion($tema){
		$loader = new \Twig_Loader_Filesystem('./templates');
		$twig = new \Twig_Environment($loader);
        $templateAlumn = $twig->load('alumno.html');
        $templateAlumn2 = $twig->load('respuestas.html');
        file_put_contents('./evaluaciones/evaluacionTema'.$tema.'.html', $templateAlumn->render(array('preguntas' => $this->preguntas, 'tema' => $tema)));
        file_put_contents('./evaluaciones/respusetasTema'.$tema.'.html', $templateAlumn2->render(array('preguntas' => $this->preguntas, 'tema' => $tema)));
    }
    
}