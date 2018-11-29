<?php
namespace MultipleChoice;

use Symfony\Component\Yaml\Yaml;
use PHPUnit\Framework\TestCase;

class PreguntasTest extends TestCase {
    public function testdescripcion(){
		$yaml = Yaml::parseFile('tests/yamltest.yml');
		$yaml = $yaml['preguntas'];
		$pregunta = new pregunta($yaml[0]);
		$this->assertEquals($pregunta->mostrarDesc(), "El término pixel hace referencia a");
    }
}