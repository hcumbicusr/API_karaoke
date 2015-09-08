<?php
require '../Config.inc.php';
require '../core/Funciones.php';

header('Content-type: application/json; charset=utf-8');

$info = [
    "name" => $config['nameApp'],
    "url" => $_SERVER['HTTP_HOST'].$_SERVER["REQUEST_URI"],
    "version" => "v1",
    "creacion" => "2015-08-19 03:14 a.m.",
    "autor" => $config['emailDeveloper']
];

echo json_encode($info);
exit();