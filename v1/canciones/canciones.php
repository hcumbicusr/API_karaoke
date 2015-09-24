<?php
require_once '../../Config.inc.php';
require_once '../../core/Funciones.php';
require_once '../models/CancionModel.php';

header('Content-type: application/json; charset=utf-8');
//CORS
header("Access-Control-Allow-Origin: *");
//para usar verbos HTTP
header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE, OPTIONS");

if (!empty($_REQUEST['accion'])) {
    
    switch ($_REQUEST['accion']){
        case "add": // los datos deben ser enviados mediante POST
            if (!empty($_POST)) {
                $objCancion = new CancionModel();
                Funciones::filtraGET_POST($_POST);
                $objCancion->setId_musicgenre($_POST['id_musicgenre']);
                $objCancion->setId_typemusic($_POST['id_typemusic']);
                $objCancion->setName(trim($_POST['name']));
                $objCancion->setArtist(trim($_POST['artist']));
                $objCancion->setAlbum(trim($_POST['album']));
                $objCancion->setDescription(trim($_POST['description']));
                $objCancion->setYear_album(trim($_POST['year_album']));
                $objCancion->setRuta(str_replace("\\", "/" , trim($_POST['ruta'])));
                //die(var_dump($_POST));
                // retorna un arr con el estado y el id_cancion
                $salida = $objCancion->registrarCancion();
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
            $objCancion = new CancionModel();
            if (!empty($_GET['detalle'])) { // id del pedido
                Funciones::filtraGET_POST($_GET);
                switch ($_GET['detalle']) {
                    case 'genero': 
                        if (!empty($_GET['param'])) {
                            $objCancion->setId_musicgenre($_GET['param']);
                            echo json_encode($objCancion->listarCancionesGenero());
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
                    case 'nombre': //die(var_dump($_GET));
                        if (!empty($_GET['param'])) {
                            $objCancion->setName(trim($_GET['param']));
                            echo json_encode($objCancion->listarCancionesNombre());
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
                    case 'artista': 
                        if (!empty($_GET['param'])) {
                            $objCancion->setArtist(trim($_GET['param']));
                            echo json_encode($objCancion->listarCancionesArtista());
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
                    case 'album': //die(var_dump($_GET));
                        if (!empty($_GET['param'])) {
                            $objCancion->setAlbum(trim($_GET['param']));
                            echo json_encode($objCancion->listarCancionesAlbum());
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
                        $objCancion->setId_typemusic(1);
                        $result = $objCancion->listarCancionesTipo();
                        for ($i = 0; $i < count($result); $i++) {
                            $result[$i]['year_album'] = str_replace("", "-", $result[$i]['year_album']);
                            $result[$i]['ruta'] = str_replace("", "-", $result[$i]['ruta']);
                        }
                        echo json_encode($result);
                        break;
                }
                
            }else { // muestra todos las canciones
                $objCancion->setId_typemusic(1);
                $result = $objCancion->listarCancionesTipo();
                for ($i = 0; $i < count($result); $i++) {
                    $result[$i]['year_album'] = str_replace("", "-", $result[$i]['year_album']);
                    $result[$i]['ruta'] = str_replace("", "-", $result[$i]['ruta']);
                }
                echo json_encode($result);
                exit();
            }
            break;
        case "edit":
            if (!empty($_POST)) {
                $objCancion = new CancionModel();
                Funciones::filtraGET_POST($_POST);
                $objCancion->setId_music($_POST['id_music']);
                $objCancion->setId_musicgenre($_POST['id_musicgenre']);
                $objCancion->setId_typemusic($_POST['id_typemusic']);
                $objCancion->setName(trim($_POST['name']));
                $objCancion->setArtist(trim($_POST['artist']));
                $objCancion->setAlbum(trim($_POST['album']));
                $objCancion->setDescription(trim($_POST['description']));
                $objCancion->setYear_album(trim($_POST['year_album']));
                $objCancion->setRuta(str_replace("\\", "/" , trim($_POST['ruta'])));
                //die(var_dump($_POST));
                // retorna un arr con el estado y el id_cancion
                $salida = $objCancion->editarCancion();
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
        case "del":
            if (!empty($_POST)) {
                $objCancion = new CancionModel();
                Funciones::filtraGET_POST($_POST);
                $objCancion->setId_music($_POST['id_music']);
                // retorna OK
                $salida = $objCancion->eliminarCancion();
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