<?php

namespace Multiplechoice;

use Symfony\Component\Yaml\Yaml;
require_once  './vendor/autoload.php';
$loader = new \Twig_Loader_Filesystem('./templates');
$twig = new \Twig_Environment($loader);

//Cantidad de test a crear
$test = readline("Ingrese la cantidad de temas a crear: ");
$test = intval($test);

//Pido la cantidad de preguntas para la evaluación
$cant = readline("Ingrese la cantidad de preguntas para la evaluacion: ");
$cant = intval($cant);

//Creo el examen
$exam = new Multiplechoice($cant, $test);