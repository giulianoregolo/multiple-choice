<?php

namespace Multiplechoice;

use Twig_Environment;
use Twig_Loader_Filesystem;
use Symfony\Component\Yaml\Yaml;
require_once __DIR__.'/../vendor/autoload.php';

//Cantidad de test a crear
$test = readline("Ingrese la cantidad de temas a crear: ");
$test = intval($test);

//Pido la cantidad de preguntas para la evaluación
$cant = readline("Ingrese la cantidad de preguntas para la evaluacion: ");
$cant = intval($cant);
if ($cant > count($yaml)) {$cant = count($yaml);}

//Creo el examen
$exam = new Multiplechoice($cant, $test);