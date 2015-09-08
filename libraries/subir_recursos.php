<?php

require_once '../Config.inc.php';
require_once '../core/Funciones.php';

header('Content-type: application/json; charset=utf-8');

if (!empty($_FILES)) {
    //comrpobacion que se ha subido un archivo 
    #die(var_dump($file));
    $articulo = $_GET['id'];
    //die(var_dump($_SERVER));
    $objDB = new Class_Db();
    // codigo de modelo
    $con = $objDB->selectManager()->connect();
    $query = "SELECT a.*, g.codigo,g.nombre as modelo, t.nombre as talla 
    FROM articulo a 
    inner join grupo_modelo g on g.id_g_modelo = a.id_g_modelo 
    inner join talla t on a.id_talla = t.id_talla 
    where id_articulo = $articulo";
    $result = $objDB->selectManager()->select($con, $query);

    $title = $result[0]['descripcion'];
    $talla = $result[0]['talla'];

    //function realizarCarga ($file, $id_material, $descripcion, $contenido = NULL
    $codigo = str_replace(" ", "_", $result[0]['codigo']);
    $ruta = "upload/". $codigo ."/";
    $ruta_carga = "../".$ruta;
    //die(var_dump($title));
    $mensaje = [];
    $warning = array("exe","ini","lnk","vbs","vb","bat","cmd","inf","com","pif","src","msi","htaccess","");
    
    //die(var_dump(count($_FILES)));
    $n_elementos = count($_FILES);
    $contador = 0;
    
    foreach ($_FILES as $key)
    {
        if($key['error'] == UPLOAD_ERR_OK )//Si el archivo se paso correctamente Ccontinuamos 
        {
            $nombre = $key['name'];//Obtenemos el nombre original del archivo
            $temporal = $key['tmp_name']; //Obtenemos la ruta Original del archivo
            $tipo = $key["type"];
            $tamanio = $key["size"]; 
            
            $tamanio = Funciones::formatSizeUnits($tamanio);
            
            $aux = substr($nombre, -5);
            $lim_ext = strpos($aux, ".");

            $extension = substr($aux, $lim_ext+1);
            $extension = strtolower($extension);
            
            $nombreOriginal = $codigo."_".$talla."_".str_replace(" ", "_", $nombre);
            
            $destino = $ruta_carga.$nombreOriginal;	//Creamos una ruta de destino con la variable ruta y el nombre original del archivo	
            $destino_bd = $ruta.$nombreOriginal;
            $fecha = date("Y-m-d H:i:s");
            
            if (in_array($extension, $warning))
            {
                $mensaje[] = array(
                    "type" => 'ERROR',
                    "message" => $nombre.' -> No se pudo cargar el archivo, el formato no es permitido.'
                );
                //$mensaje[] = $nombreOriginal.': no se pudo subir el archivo, el formato no es permitido.'; 
            }else
            {   
                if (!is_dir($ruta_carga))
                {
                    // se crea el directorio
                    mkdir($ruta_carga);
                }
                //Movemos el archivo temporal a la ruta especific
                if ( move_uploaded_file($temporal, $destino) )
                {
                    $guarda = registrarBD($articulo, $title, $destino_bd, $extension, $tipo, $tamanio);
                    if ( $guarda == "OK")
                    {
                        $type = "SUCCESS";
                        $message = "$nombre -> Archivo guardado correctamente.";
                    }else
                    {
                        $type = "ERROR";
                        $message = $guarda;
                    }
                    
                    $mensaje[] = array(
                        "type" => $type,
                        "message" => $message
                    );
                    $contador++;
                    
                }else
                {
                    $mensaje[] = array(
                    "type" => 'ERROR',
                    "message" => $nombre.' -> No se pudo cargar el archivo.'
                );
                    //$mensaje[] = $nombreOriginal.': ERROR al intentar cargar el archivo.';
                }
            }
            
        }else
        {
            $mensaje[] = $mensaje[] = array(
                    "type" => 'ERROR',
                    "message" => 'No se encontró un archivo para cargar.'
                );
            //$mensaje[] = $nombreOriginal.': ERROR al cargar el archivo.';
        }
    }
    
    $return = array(
        "type" => "upload",
        "elementos" => $n_elementos,
        "cargados" => $contador,
        "message" => $mensaje
    );
    
    echo json_encode($return);
}   
    /*---------------------------------------------------------------------------*/
    function registrarBD($articulo,$title,$ruta,$extension,$tipo,$tamanio)
    {
        $val = false;
        $objDB = new Class_Db();
        $con = $objDB->selectManager()->connect();
        $browser = Funciones::DatosBrowser();
        $procedure = "sp_cargar_multimedia";
        
        //$input ="'".$this->getUsuario()."','".md5($this->getClave())."'";
        $input ="'".$browser[0]."',"
                ."'".$browser[1]."',"
                ."'".$browser[2]."',"
                ."'".$_SESSION['sessionID']."',"
                ."".$articulo.","
                ."'".$title."',"
                ."'".$ruta."',"
                ."'".$extension."',"
                ."'".$tipo."',"
                ."'".$tamanio."'";
        
        $result = $objDB->selectManager()->spInsert($con, $procedure, $input);
        //die(var_dump($result));
        if ($result == 'OK')
        {
            $val = "OK";
        }else
        {
            $val = $result;
        }
        return $val;
    }

    //----------------------------------------------------------
//    if ($error1 == UPLOAD_ERR_NO_FILE)
//    {        
//        $return = array(
//            "type" => "error",
//            "message" => "Ocurrió un error, no se ha encontrado elementos para cargar"
//        );
//    }
//    
//    if (($error1===UPLOAD_ERR_OK)) // si se ha ingresado un recurso multimedia
//    {
//        if (!empty($id_material))
//        {
//            $objDB = new Class_Db();
//            $con = $objDB->selectManager()->connect();
//            $fecha = date("Y-m-d H:i:s");
//            
//            $req = $objDB->selectManager()->select($con,
//                    "SELECT m.titulo, t.nombre FROM materiales m "
//                    . "INNER JOIN tipo_material t ON m.id_tipo_material = t.id "
//                    . " WHERE m.id = $id_material");
//            $tipo_material = $req[0]['nombre'];
//            $titulo = $req[0]['titulo'];
//            //die("aqui 1");
//            //trabajo los archivos  
//            $val = trabaja_files($file,$id_material,$titulo,$tipo_material,$objDB,$con, $descripcion, $contenido); 
//                if ($val)
//                {
//                    return true;
//                }else
//                {
//                    return false;
//                }
//        }
//    }else
//    {
//        return false;
//    }
//}   
////-----------------------------------------------------------------------
//function trabaja_files($file,$id_material,$titulo,$tipo_material,$objDB,$con, $descripcion, $contenido = NULL)
//{
//    global  $config;
//    //die(var_dump($config));
//    //----------------------------------------------------------------
//    //die(var_dump($file));
//    foreach ($file["error"] as $key => $error) {
//        if ($error == UPLOAD_ERR_OK) {
//            $archivo = $file["tmp_name"][$key];  
//            $tamanio = $file["size"][$key]; 
//            $tipo    = $file["type"][$key]; 
//            $nom_arch = $file["name"][$key];                    
//        }else{
//            #echo "aqui 0";
//            return false;
//        }
//    
//    //$tipo = substr($tipo, 12);
//    $inicio = strpos($tipo, "/");    
//    
//    $aux = substr($nom_arch, -6);
//    $lim_ext = strpos($aux, ".");
//    
//    #die("$nom_arch -> $aux ".var_dump($lim_ext));
//    $extension = substr($aux, $lim_ext+1);
//    $extension = strtolower($extension);    
//    
//    $warning = array("exe","ini","lnk","vbs","vb","bat","cmd","inf","com","pif","src","msi","htaccess","");    
//    
//    if( $archivo != "") {        
//        if (in_array($extension, $warning))
//        {
//            #echo "aqui 1";
//            return false;
//            
//        }else
//        {
//            $ruta = "";
//            $ruta_bd = "";
//            $tipo_m = "";
//            
//            switch ($tipo_material)
//            {
//                case 'LIBRO':
//                    $titulo = str_replace(' ', '_', trim($titulo));
//                    $tipo_m = "libros";
//                    break;
//                
//                case 'TESIS':
//                    $titulo = str_replace(' ', '_', trim($titulo));
//                    $tipo_m = "tesis";
//                    break;
//                
//                case 'REVISTA':
//                    $titulo = str_replace(' ', '_', trim($titulo));
//                    $tipo_m = "revistas";
//                    break;
//                case 'OTROS' :
//                    $titulo = str_replace(' ', '_', trim($titulo));
//                    $tipo_m = "otros";
//                    break;
//            }
//            
//            $temp = rutas($config, $tipo_m, $titulo);
//            $ruta = $temp[0];
//            $ruta_bd = $temp[1];
//                    
//           //die(var_dump($ruta));
//            if (!is_dir($ruta))
//            {
//                // se crea el directorio
//                mkdir($ruta);
//            }
//            #die(var_dump($ruta));
//            
//            $request = $objDB->selectManager()->select($con,"SELECT orden FROM recursos WHERE id_material = $id_material order by id DESC LIMIT 1");
//            $orden = $request[0]['orden'];
//            
//            if (empty($orden) || $orden == 0)
//            {
//                $orden = 1;
//            }else
//            {
//                $orden += 1;
//            }
//            
//            $nombre_arch = "$titulo"."_(".$orden.")";
//            $ruta_up = $ruta."/$nombre_arch.".strtolower($extension);
//            $ruta_bd .= "/$nombre_arch.".strtolower($extension);            
//            #$titulo .= "_(".$orden.")";
//            
//            #die(var_dump($ruta_up));                            
//            if(move_uploaded_file($archivo, $ruta_up)) {
//                $tamanio = Funciones::formatSizeUnits($tamanio);
//                $up_recurso = "INSERT INTO recursos VALUES"
//                        . "(NULL,'$nombre_arch','".  strtoupper($extension)."','$tamanio','$ruta_bd',"
//                        . "'$descripcion','$contenido',".$orden.",DEFAULT,0,DEFAULT,$id_material)";
//                                   
//                #die("indert: ".$up_recurso);
//                if ($objDB->selectManager()->insert($con,$up_recurso) ) {
//                    #echo "aqui 2";
//                    return true;
//                } else {
//                    #echo "aqui 3";
//                    return false;
//                }
//            } else { 
//                #echo "aqui 4";
//                return false;
//            }
//        }
//        }else {
//            #echo "aqui 5";
//            return false;
//        }
//    }
//    //---------------------------------------   
//    #echo "aqui 6";
//    return false;    
//}
//
//function rutas ($config,$ruta,$titulo)
//{        
//    $ruta_v[0] = $config['path']."/uploads/$ruta/$titulo";
//    $ruta_v[1] = "/uploads/$ruta/$titulo";
//    return $ruta_v;
//}