<?php

namespace Multiplechoice;

require_once  '../vendor/autoload.php';
$prueba = new Multiplechoice(12,1);
$loader = new \Twig_Loader_Filesystem('../templates');
$twig = new \Twig_Environment($loader);
echo $twig->render('alumno.html', ['preguntas' => $prueba->opciones(), 'tema' => 1] );