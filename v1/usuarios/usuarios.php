<?php
require_once '../../Config.inc.php';
require_once '../../core/Funciones.php';
require_once '../models/UsuarioModel.php';

header('Content-type: application/json; charset=utf-8');
//CORS
header("Access-Control-Allow-Origin: *");
//para usar verbos HTTP
header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE, OPTIONS");

if (!empty($_REQUEST['accion'])) {
    
    switch ($_REQUEST['accion']){
        case "add": // los datos deben ser enviados mediante POST
            if (!empty($_POST)) {
                $objUsuario = new UsuarioModel();
                Funciones::filtraGET_POST($_POST);
                $objUsuario->setName(trim($_POST['name']));
                $objUsuario->setPassword(trim($_POST['password']));
                $objUsuario->setFullname(trim($_POST['fullname']));
                $objUsuario->setEmail(trim($_POST['email']));
                $objUsuario->setLevel(trim($_POST['level']));
                //die(var_dump($_POST));
                // retorna un arr con el estado y el id_cancion
                $salida = $objUsuario->registrarUsuario();
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
        case "login": //
            if (!empty($_POST)) {
                $objUsuario = new UsuarioModel();
                Funciones::filtraGET_POST($_POST);
                $objUsuario->setName(trim($_POST['name']));
                $objUsuario->setPassword(trim($_POST['password']));
                //die(var_dump($_POST));
                // retorna un arr con el estado y el id_cancion
                $salida = $objUsuario->loginUsuario();
                
                if (count($salida) > 0) {
                    $estado = 'success';
                }else {
                    $estado = 'empty';
                }
                $return = [
                    "type" => $estado,
                    "message" => $salida[0]
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
            $objUsuario = new UsuarioModel();
            $return = [
                "type" => "empty",
                "message" => "Método sin implementar"
            ];
            echo json_encode($return);
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
                "message" => "Método sin implementar"
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