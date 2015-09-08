<?php
require_once '../../Config.inc.php';
require_once '../../core/Funciones.php';
require_once '../models/MesaModel.php';

header('Content-type: application/json; charset=utf-8');
//CORS
header("Access-Control-Allow-Origin: *");
//para usar verbos HTTP
header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE, OPTIONS");

if (!empty($_REQUEST['accion'])) {
    
    switch ($_REQUEST['accion']){
        case "add": // los datos deben ser enviados mediante POST
            if (!empty($_POST)) {
                $objMesa = new MesaModel();
                Funciones::filtraGET_POST($_POST);
                $objMesa->setNumber(trim($_POST['number']));
                
                $token = Funciones::generaTokenMesa(trim($_POST['number']));
                //die(var_dump($token));
                $objMesa->setToken($token);
                // retorna un arr con el estado y el id_pedido
                $salida = $objMesa->registrarMesa();
                list($estado,$message) = explode(",", $salida);
                if ($estado == 'OK') {
                    $estado = 'success';
                }else {
                    $estado = 'error';
                }
                $return = [
                    "type" => $estado,
                    "message" => $message
                ];
                echo json_encode($return);
                exit();
            }else {
                $response = [
                    "type" => "error",
                    "message" => "Los datos no han sido enviados correctamente. [Verbo HTTP]"
                ];
                echo json_encode($response);
            }
            break;
        case "list": //
            $objMesa = new MesaModel();
            echo json_encode($objMesa->listarMesas());
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
            if (!empty($_POST)) {
                $objMesa = new MesaModel();
                Funciones::filtraGET_POST($_POST);
                $objMesa->setId_table($_POST['id_table']);
                // retorna OK
                $salida = $objMesa->eliminarMesa();
                list($estado,$message) = explode(",", $salida);
                if ($estado == 'OK') {
                    $estado = 'success';
                }else {
                    $estado = 'error';
                }
                $return = [
                    "type" => $estado,
                    "message" => $message
                ];
                echo json_encode($return);
                exit();
            }else {
                $response = [
                    "type" => "error",
                    "message" => "Los datos no han sido enviados correctamente. [Verbo HTTP]"
                ];
                echo json_encode($response);
            }
            
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