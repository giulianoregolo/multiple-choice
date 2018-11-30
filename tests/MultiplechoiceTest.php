<?php
namespace MultipleChoice;

use PHPUnit\Framework\TestCase;

class MultiplechoiceTest extends TestCase {

    /**
     * Comprueba que la función obtenercantpreguntas devuelve la cantidad de preguntas del multiple choice
     */
    public function testcantdepreguntas(){
        $prueba = new Multiplechoice(12,1);
        $this->assertEquals($prueba->obtenercantpreguntas(),12);
    }

    /**
     * Comprueba que el array devuelto por la función obtener yaml tiene una cantidad de preguntas igual a la cantidad de preguntas del multiple choice
     */
    public function testRecortarYAML(){
        $prueba = new Multiplechoice(12,1);
        $cant = count($prueba->obteneryaml());
        $this->assertEquals($cant,12);
    }

}
