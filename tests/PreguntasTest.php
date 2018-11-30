<?php
namespace MultipleChoice;

use Symfony\Component\Yaml\Yaml;
use PHPUnit\Framework\TestCase;

class PreguntasTest extends TestCase {

		/**
		 * Comprueba que la funcion mostrarDesc devuelve la descripción de una pregunta
		 */
    public function testdescripcion(){
			$yaml = Yaml::parseFile('tests/yamltest.yml');
			$yaml = $yaml['preguntas'];
			$pregunta = new pregunta($yaml[0]);
			$this->assertEquals($pregunta->mostrarDesc(), "El término pixel hace referencia a");
		}
		
		/**
		 * Comprueba que la funcion obtenerPreg devuelve todas las posibles respuestas de una pregunta
		 */
		public function testobtenerpreg () {
			$yaml = Yaml::parseFile( 'tests/yamltest.yml' );
			$yaml = $yaml['preguntas'];
			$pregunta = new pregunta( $yaml[0] );
			$this->assertTrue(in_array( "La unidad mínima de información de una imagen.", $pregunta->optenerpreg() ) );
			$this->assertTrue(in_array( "La longitud de la diagonal de una imagen en pulgadas.", $pregunta->optenerpreg() ) );
			$this->assertTrue(in_array( "La cantidad de puntos por pulgada.", $pregunta->optenerpreg() ) );
			$this->assertTrue(in_array( "La cantidad de colores de un punto.", $pregunta->optenerpreg() ) );
		}
}