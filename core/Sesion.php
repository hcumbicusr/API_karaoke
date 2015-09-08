<?php
/**
 * Description of Sesion
 *
 * @author hcumbicusr
 */

class Sesion {
    protected $param;
    
    public function getParam() {
        return $this->param;
    }

    public function setParam($param) {
        $this->param = $param;
    }

    public function inicioSesion()
    {        
        //se agregan los campos de la tabla como variables de la aplicacion
        //ejm. $this->getParam()[0]['usuario'] sera igual a  => $usuario
        extract($this->getParam()[0]); 
        
        //die(var_dump($config));
        
        $_SESSION['session_time'] = time();        
        $_SESSION['id_usuario'] = $id_usuario;
        $_SESSION['id_persona'] = $id_persona;
        $_SESSION['usuario'] = $usuario;
        $_SESSION['apenom'] = Funciones::convertirEspecialesHtml($ap_paterno)." ".Funciones::convertirEspecialesHtml($ap_materno).", ".Funciones::convertirEspecialesHtml($nombre);        
        $_SESSION['doc_identidad'] = $doc_identidad;
        $_SESSION['sessionID_BD'] = $token_validacion; // el token de la session de la BD
        $_SESSION['email'] = $email;
        
        
        // ----- aui se debe consultar por las funciones del usuario
        $objDB = new Class_Db();
        $con = $objDB->selectManager()->connect();
        $funciones = $objDB->selectManager()->spSelect($con, "sp_funciones_x_usuario", $id_usuario);
        
        // de la BD
        
        if (!empty($funciones))
        {
            $_SESSION['funciones'] = $funciones;
            // saber si una de sus funciones es de PERSONERO de MESA
//            for ($i = 0; $i < count(count($funciones)); $i++) {
//                
//            }
            
        }
                
        if (empty($_SESSION['usuario']))
        {
            return false;
        }
        else
        {
            return true;
        }
        
    }
    
    public function cerrarSesion ()
    {
        session_start();
        $_SESSION = array();
        session_destroy();
        return true;
    }
    
    function __construct($param=array()) {
        $this->param = $param;
    }
    function __destruct() {
        unset($this);
    }
}
