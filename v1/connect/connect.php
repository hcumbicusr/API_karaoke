<?php
require_once '../../Config.inc.php';
require_once '../../core/Funciones.php';
require_once '../models/GeneralModel.php';

header('Content-type: application/json; charset=utf-8');
//CORS
header("Access-Control-Allow-Origin: *");
//para usar verbos HTTP
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");

//die(var_dump($_SERVER));

if (!empty($_POST)) {

    // Decodificando formato Json
    //$request = json_decode(file_get_contents("php://input"), true);
    
    switch ($_POST['accion']){
        case "connect": // los datos deben ser enviados mediante GET
            $obj = new GeneralModel();
            $result = $obj->testConnect();
            $val = "";
            if(!empty($result)) {
                $val = "SUCCESS";
            }else{
                $val = "UNSUCCESS";
            }
            $return = [
                "type" => "connect",
                "message" => $val
            ];
            echo json_encode($return);
            break;
        
        default:
            // json .. accion no encontrada
            $response = [
                "type" => "error",
                "message" => null//"No se ha podido realizar la acción solicitada."
            ];
            echo json_encode($response);
            break;
    }
    
}else {
    // no se ha enviado una accion
    $response = [
        "type" => "error",
        "message" => "Solicitud incorrecta"
    ];
    echo json_encode($response);
    exit();
}