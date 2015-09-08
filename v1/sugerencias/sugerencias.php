<?php
require_once '../../Config.inc.php';
require_once '../../core/Funciones.php';
require_once '../models/SugerenciaModel.php';

header('Content-type: application/json; charset=utf-8');
//CORS
header("Access-Control-Allow-Origin: *");
//para usar verbos HTTP
header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE, OPTIONS");

if (!empty($_REQUEST['accion'])) {
    
    switch ($_REQUEST['accion']){
        case "add": // los datos deben ser enviados mediante POST
            if (!empty($_POST)) {
                $objSugerencia = new SugerenciaModel();
                Funciones::filtraGET_POST($_POST);
                $objSugerencia->setArtist_group(trim($_POST['artist_group']));
                $objSugerencia->setName(trim($_POST['name']));
                $objSugerencia->setEmail(trim($_POST['email']));
                //die(var_dump($_POST));
                // retorna un arr con el estado y el id_cancion
                $salida = $objSugerencia->registrarSugerencia();
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
            $objSugerencia = new SugerenciaModel();
            if (!empty($_GET['detalle'])) { // id del pedido
                Funciones::filtraGET_POST($_GET);
                switch ($_GET['detalle']) {
                    case 'estado': 
                        if (!empty($_GET['param'])) {
                            $objSugerencia->setState($_GET['stat']);
                            echo json_encode($objSugerencia->listarSugerenciasEstado());
                            exit();
                        }else {
                            $response = [
                                "type" => "notice",
                                "message" => "No se ha enviado el parámetro requerido"
                            ];
                            echo json_encode($response);
                            exit();
                        }
                        break;
                    default: 
                        echo json_encode($objSugerencia->listarSugerenciasTodas());
                        break;
                }
                
            }else { // muestra todos las canciones
                echo json_encode($objSugerencia->listarSugerenciasTodas());
                exit();
            }
            break;
        case "edit":
            $return = [
                "type" => "empty",
                "message" => "Método sin implementar"
            ];
            echo json_encode($return);
            exit();
            break;
        case "del":
            if (!empty($_POST)) {
                $objSugerencia = new SugerenciaModel();
                Funciones::filtraGET_POST($_POST);
                $objSugerencia->setId_suggested($_POST['id_suggested']);
                // retorna OK
                $salida = $objSugerencia->eliminarSugerencia();
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