<?php

require_once '../Config.inc.php';
require_once '../core/Funciones.php';

header('Content-type: application/json; charset=utf-8');

$objDB = new Class_Db();
// codigo de modelo
$con = $objDB->selectManager()->connect();
$query = "SELECT ".$_POST['campo']." FROM ".$_POST['tabla']." g order by ".$_POST['campo'];
$result = $objDB->selectManager()->select($con, $query);

if (!empty($result))
{
    $length = count($result);
    $n = 0;
    $arreglo = '[';
    foreach ($result as $key => $value) {
        foreach ($value as $clave => $valor) {
            $arreglo .='"'.$valor.'"';
        }
        $n++;
        if ($n < $length) $arreglo .=',';
    }
}

$arreglo .= ']';
$arr = array(
    "type" => "success",
    "message" => $arreglo
);
echo json_encode($arr);
exit();