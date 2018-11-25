<?php

namespace Multiplechoice;

use Symfony\Component\Yaml\Yaml;
require_once  '../vendor/autoload.php';
$loader = new \Twig_Loader_Filesystem('../templates');
$twig = new \Twig_Environment($loader);

//Cantidad de test a crear
$test = readline("Ingrese la cantidad de temas a crear: ");
$test = intval($test);

//Pido la cantidad de preguntas para la evaluación
$cant = readline("Ingrese la cantidad de preguntas para la evaluacion: ");
$cant = intval($cant);

//Creo el examen
$exam = new Multiplechoice($cant, $test);
?>
<html>
    <head>
    </head>
    <body >
    <h1 class=centro>Generador de Pruebas Multiple Choice</h1>
    <div class="centrar">  
                <div class="centrar2">
                <a href="generarprueba.php" class="button button--moema button--border-thick button--size-l">Generar Pruebas</a>
                </div>
                <br>
                <h1>Tema 1</h1>
                <a href="pruebaRender.php" class="button button--moema button--border-thick button--size-s">Ver Prueba</a>
                <a href="respuestasRender.php" class="button button--moema button--border-thick button--size-s">Ver Respuestas</a>
        </div>
    </body>
</html>