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
                // se recibe la cantidad de mesas a agregar
                $n = trim($_POST['number']);
                $cont = 0;
                while ($n > $cont){
                    $mesaFin = $objMesa->selectUltimaMesa();
                    $objMesa->setNumber(intval($mesaFin[0]['number']) + 1);
                    //die(var_dump($objMesa->getNumber()));
                    $token = Funciones::generaTokenMesa($objMesa->getNumber());
                    //die(var_dump($token));
                    $objMesa->setToken($token);
                    // retorna un arr con el estado y el id_pedido
                    $salida = $objMesa->registrarMesa();
                    
                    list($estado,$message) = explode(",", $salida);
                    if ($estado == 'OK') {
                        $cont++;
                    }else {
                        $cont = $n; // para salir del ciclo while
                    }
                }
                
                if ($n == $cont) {
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
        
        case "login_table": //para la validacion del token con la mesa respectiva
            // retorna todos los datos de la mesa seleccionada
            if (!empty($_POST)) {
                $objMesa = new MesaModel();
                Funciones::filtraGET_POST($_POST);
                $objMesa->setToken($_POST['token']);
                // retorna OK
                $salida = $objMesa->loginMesaToken();
                
                echo json_encode($salida); // toda la fila de la table_business con el token ingresado -- NULL en caso no encontrado
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