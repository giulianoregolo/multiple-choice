<?php
namespace Multiplechoice;
use Symfony\Component\Yaml\Yaml;
class Multiplechoice {
    protected $preguntas;
    
	public function __construct(){
        $pregs_text = Yaml::parseFile('./preguntas.yml');;
        $pregs = $pregs_text['preguntas'];
        shuffle($pregs);
        for($i = 0; $i < 10; $i++){
            $this->preguntas[$i] = new Preguntas($pregs[$i], $i+1);
        }
    }
    public function numeroPreguntas(){
        return count($this->preguntas);
    }
    public function getPreguntas(){
        return $this->preguntas;
    }
}