<?php
require_once '../../Config.inc.php';
require_once '../../core/Funciones.php';
require_once '../models/GeneroModel.php';

header('Content-type: application/json; charset=utf-8');
//CORS
header("Access-Control-Allow-Origin: *");
//para usar verbos HTTP
header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE, OPTIONS");

if (!empty($_REQUEST['accion'])) {
    
    switch ($_REQUEST['accion']){
        case "add": // los datos deben ser enviados mediante POST
            $return = [
                "type" => "empty",
                "message" => "Métod sin implementar"
            ];
            echo json_encode($return);
            exit();
            break;
        case "list": //
            $objGenero = new GeneroModel();
            echo json_encode($objGenero->listarGeneros());
            exit();
            
            break;
        case "edit":
            $return = [
                "type" => "empty",
                "message" => "Métod sin implementar"
            ];
            echo json_encode($return);
            exit();
            break;
        case "del":
            $return = [
                "type" => "empty",
                "message" => "Métod sin implementar"
            ];
            echo json_encode($return);
            exit();
            break;
        default:
            // json .. accion no encontrada
            $response = [
                "type" => "error",
                "message" => "No se ha podido realizar la acción solicitada."
            ];
            echo json_encode($response);
            break;
    }
    
}else {
    // no se ha enviado una accion
    $response = [
        "type" => "error",
        "message" => null
    ];
    echo json_encode($response);
    exit();
}