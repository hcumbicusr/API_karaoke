<?php
/**
 * Este archivo contiene las variables de configuracion de la aplicacion
 * @author Henry Cumbicus <hcumbicusr@gmail.com>
 * @package 
 * @subpackage 
*/
header('Content-Type: text/html; charset=UTF-8');

/**
 * @var charset
 */
$config['charset']= 'UTF-8';
/**
 * @var language
 */
$config['lang']= 'es-ES';

/**
 * @var entorno : D-> Desarrollo; P-> Produccion
 */
$config['entorno']= 'D';

if ($config['entorno'] == 'D')
{
    ini_set("display_errors", true);
    error_reporting(E_ALL);
}elseif($config['entorno'] == 'P')
{
    ini_set("display_errors", false);
    error_reporting(0);
}

//Configuracion de la fecha segun la region
date_default_timezone_set('America/Lima');
setlocale(LC_ALL,"es_ES");

/**
*@var name
*/
$config['titleApp']="API Karaoke";
/**
*@var version
*/
$config['version']="v1";
/**
*@var name
*/
$config['nameApp']="API_karaoke";
/**
 * @var email
 */
$config['emailDeveloper']="hcumbicusr@gmail.com";
/**
 * @var host ruta completa
 */
$config['host']=$_SERVER['HTTP_HOST'];
/**
 * @var path ruta raiz directorio
 */
$config['path']=$_SERVER["DOCUMENT_ROOT"]."/".$config['nameApp'];

if ($config['entorno'] == 'D')
{
    /**
    * @var accessBD
    */
   $config['accessBD'] = array(
       "host" => "localhost",
       "db" => "bd_karaoke",
       "user" => "root",
       "pass" => ""
   );
   
}elseif($config['entorno'] == 'P')
{
    /**
    * @var accessBD
    */
   $config['accessBD'] = array(
       "host" => "localhost",
       "db" => "diverc0l_bd_tienda",
       "user" => "diverc0l_admin",
       "pass" => "@hcumbicusr123"
   );
   
}

/**
 * @var management
 */
$config['managerDataBase']="mysqli";
/**
 * @var  array typeUsers
 */
$config['userType']= array (
    "GOD" => "SA",
    "ADMIN" => "ADMINISTRADOR",
    "USU1" => "USUARIO NIVEL 1"
);

/**
 * @var sessionTime in seg
 */
$config['sessionTime']= 2400;
 
/**
 * @var array vars
 */
$config['vars']= array (
    "IGV" => 0.18
);

/**
 *  se crea una sesion temporal para almacenar un token del usuario actual, cuando carga la pagina
 * 
 */
session_start();
if (empty($_SESSION['sessionID']))
{
    $_SESSION['sessionID'] = generaToken();
}

function generaToken($longitud = 6)
{
    $str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
    $cad = "";
    for($i=0;$i<$longitud;$i++) {
    $cad .= substr($str,rand(0,62),1);
    }
    return $cad.md5(time());
}
/**
 * Requiere del archivo db.php para funcionar
 */

require_once 'core/db.php';
/**
 * Requiere del archivo config.php para funcionar
 */
require_once 'core/config.php';
