<?php
require_once '../../Config.inc.php';
require_once '../../core/Funciones.php';
require_once '../models/PedidoModel.php';

header('Content-type: application/json; charset=utf-8');
//CORS
header("Access-Control-Allow-Origin: *");
//para usar verbos HTTP
header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE, OPTIONS");

if (!empty($_REQUEST['accion'])) {
    
    switch ($_REQUEST['accion']){
        case "add": // los datos deben ser enviados mediante POST
            if (!empty($_POST)) {
                $objPedido = new PedidoModel();
                Funciones::filtraGET_POST($_POST);
                $objPedido->setId_table($_POST['id_table']);
                $objPedido->setId_music($_POST['id_music']);
                // retorna un arr con el estado y el id_pedido
                $salida = $objPedido->registrarPedido();
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
            $objPedido = new PedidoModel();
            if (!empty($_GET['detalle'])) { // id del pedido
                Funciones::filtraGET_POST($_GET);
                switch ($_GET['detalle']) {
                    case 'id': 
                        if (!empty($_GET['param'])) {
                            $objPedido->setId_order($_GET['param']);
                            echo json_encode($objPedido->detallePedido());
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
                    case 'estado': //die(var_dump($_GET));
                        if (!empty($_GET['param'])) {
                            $estado = $_GET['param'];
                            if ($estado == "p") {
                                $estado = 0;
                            }else {
                                $estado = 1;
                            }
                            $objPedido->setState($estado);
                            echo json_encode($objPedido->listarPedidosEstado());
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
                    case 'f_hoy': 
                        echo json_encode($objPedido->listarPedidosHoy());
                        break;
                    case 'fechas': //die(var_dump($_GET));
                        if (empty($_GET['f_desde']) || empty($_GET['f_hasta'])) {
                            $response = [
                                "type" => "notice",
                                "message" => "No se han enviado los parámetros requeridos"
                            ];
                            echo json_encode($response);
                            exit();
                        }else {
                            //die(var_dump($_GET));
                            $objPedido->setF_desde($_GET['f_desde']);
                            $objPedido->setF_hasta($_GET['f_hasta']);
                            echo json_encode($objPedido->listarPedidosFechas());
                            exit();
                        }
                        break;
                    case 'mesa': //die(var_dump($_GET));
                        if (!empty($_GET['param'])) {
                            $mesa = $_GET['param'];
                            $objPedido->setId_table($mesa);
                            echo json_encode($objPedido->listarPedidosMesa());
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
                        echo json_encode($objPedido->listarPedidos());
                        break;
                }
                
            }else { // muestra todos los datos ordenados por fecha de pedido desc
                echo json_encode($objPedido->listarPedidos());
                exit();
            }
            break;
        case "edit":
            if (!empty($_POST)) {
                $objPedido = new PedidoModel();
                Funciones::filtraGET_POST($_POST);
                $objPedido->setId_order($_POST['id_order']);
                $objPedido->setId_table($_POST['id_table']);
                $objPedido->setId_music($_POST['id_music']);
                // retorna OK
                $salida = $objPedido->modificarPedido();
                $message = null;
                if ($salida == 'OK') {
                    $salida = 'success';
                    $message = 'El pedido ha sido modificado.';
                }else {
                    $salida = 'error';
                    $message = 'Ocurrió un error.';
                }
                $return = [
                    "type" => $salida,
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
        case "del":
            if (!empty($_POST)) {
                $objPedido = new PedidoModel();
                Funciones::filtraGET_POST($_POST);
                $objPedido->setId_order($_POST['id_order']);
                // retorna OK
                $salida = $objPedido->eliminarPedido();
                $message = null;
                if ($salida == 'OK') {
                    $salida = 'success';
                    $message = 'El pedido ha sido eliminado.';
                }else {
                    $salida = 'error';
                    $message = 'Ocurrió un error.';
                }
                $return = [
                    "type" => $salida,
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

        case "playlist":
            if (!empty($_POST)) {
                $objPedido = new PedidoModel();
                Funciones::filtraGET_POST($_POST);
                $objPedido->setId_order($_POST['id_order']);
                // retorna OK
                $salida = $objPedido->playlistPedido();
                $message = null;
                if ($salida == 'OK') {
                    $salida = 'success';
                    $message = 'El pedido ha cambiado de estado.';
                }else {
                    $salida = 'error';
                    $message = 'Ocurrió un error.';
                }
                $return = [
                    "type" => $salida,
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