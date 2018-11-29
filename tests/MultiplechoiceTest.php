<?php
namespace Multiplechocie;

use PHPUnit\Framework\TestCase;

class MultiplechoiceTest extends TestCase {
    public function testcantdepreguntas(){
        $prueba = new Multiplechocie(12,1);
        $this->assertEquals($prueba->obtenercantpreguntas(),12);
    }
    public function testRecortarYAML(){
        $prueba = new Multiplechoice(12,1);
        $cant = count($prueba->obteneryaml());
        $this->assertEquals($cant,12);
    }

}
