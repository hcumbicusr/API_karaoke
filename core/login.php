<?php

require_once '../Config.inc.php';
require_once '../core/Funciones.php';
require_once '../core/Sesion.php';
require_once '../app/models/UsuarioModel.php';

header('Content-type: application/json; charset=utf-8');

global $config;
//session_start();
if (!empty($_SESSION))
{
    if (empty($_POST))
    {
        // no se han enviado los datos por POST
        $return = array(
            "type" => "error",
            "message" => "No se han enviado los datos correctamente"
        );
        // return JSON
        echo json_encode($return);
        exit();
    }else
    {
        switch ($_POST['event']){
            case "login":
                //die(var_dump($_POST));
                $objUsuario = new UsuarioModel();
                Funciones::filtraGET_POST($_POST['username']);
                Funciones::filtraGET_POST($_POST['password']);

                $objUsuario->setNombre($_POST['username']);
                $objUsuario->setClave($_POST['password']);    
                //die(var_dump($_POST));
                //die(var_dump($objUsuario->getNombre()));
                if ($objUsuario->inicioSesion())
                {
                    $_SESSION['loginType'] = $_POST['loginType'];
                    // session iniciada
                    $return = array(
                        "type" => "success",
                        "message" => "Bienvenido al sistema"
                    );
                    // return JSON
                    echo json_encode($return);
                    exit();
                }else
                {
                    // no se ah podido iniciar sesion
                    $return = array(
                        "type" => "error",
                        "message" => "Usuario o Clave incorrectos"
                    );
                    // return JSON
                    echo json_encode($return);
                    exit();
                }
                break;
            case "logout":
                $objUsuario = new UsuarioModel();
                if ($objUsuario->cerrarSesion())
                {
                    // no se ah podido iniciar sesion
                    $return = array(
                        "type" => "success",
                        "message" => "La sesión se ha finalizado correctamente"
                    );
                    // return JSON
                    echo json_encode($return);
                    exit();
                }else
                {
                    // no se ah podido iniciar sesion
                    $return = array(
                        "type" => "error",
                        "message" => "No se ha podido finalizar la sesión, refresque la ventana y vuelva a intentarlo"
                    );
                    // return JSON
                    echo json_encode($return);
                    exit();
                }
                break;
        }
        
    }
}