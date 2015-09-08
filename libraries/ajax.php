<?php
require_once '../Config.inc.php';
require_once '../core/Funciones.php';
header('Content-type: application/json; charset=utf-8');
//session_start();
switch ($_POST['event']) {
    case 'comprobante':
        
        if ($_POST['comprobante'] == 'boelta') {
            $_SESSION['comprobante'] = 'boleta';
        }else {
            $_SESSION['comprobante'] = $_POST['comprobante'];
        }
        echo json_encode(["comprobante" => $_SESSION['comprobante']]);
        break;
    case 'email_cliente': 
        $objDB = new Class_Db();
        $con = $objDB->selectManager()->connect();
        $procedure = "sp_busca_email";
        $input = "'".$_POST['email']."'";
        $persona = $objDB->selectManager()->spSelect($con, $procedure, $input);
        if (!empty($persona)){
            
            echo json_encode(["type" => "success", "persona" => $persona]);
        }  else {
            echo json_encode(["type" => "empty", "persona" => $persona]);
        }
        
        break;
        
   case 'combo': 
        $objDB = new Class_Db();
        $con = $objDB->selectManager()->connect();
        $query = "SELECT id_".$_POST['table']." as id,nombre FROM ".$_POST['table']." where id_".$_POST['padre']." = ".$_POST['input'];
        $tabla = $objDB->selectManager()->select($con, $query);
        $html = Funciones::armarCombo($tabla);
        if (!empty($tabla)){
            echo json_encode(["type" => "success", "html" => $html]);
        }  else {
            echo json_encode(["type" => "empty", "html" => null]);
        }
        
        break;
    case 'cbo_tipo': 
        $objDB = new Class_Db();
        $con = $objDB->selectManager()->connect();
        $procedure = "sp_combo_tipo";
        $input = $_POST['categoria'];
        $tabla = $objDB->selectManager()->spSelect($con, $procedure, $input);
        $html = Funciones::armarCombo($tabla);
        if (!empty($tabla)){
            echo json_encode(["type" => "success", "html" => $html]);
        }  else {
            echo json_encode(["type" => "empty", "html" => null]);
        }
        break;
    case 'renueva_token': $_SESSION['sessionID'] = null;
        break;

    default:
        break;
}