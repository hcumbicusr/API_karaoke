<?php    
    require("../libraries/mailer/class.phpmailer.php");
    require("../libraries/mailer/class.smtp.php");
    
    include '../Config.inc.php';
    include '../core/Funciones.php';
    
    header('Content-type: application/json; charset=utf-8');
    
    Funciones::filtraGET_POST($_POST);
    $name       = @trim(stripslashes($_POST['name'])); 
    $email      = @trim(stripslashes($_POST['email'])); 
    $subject    = @trim(stripslashes($_POST['subject'])); 
    $message    = @trim(stripslashes($_POST['message']));
    $tipo = $_POST['tipo'];
    
    if (empty($_POST['formato']))
    {
        $formato = 'contacto';
    }else
    {
        $formato = $_POST['formato'];
    }

    $objDB= new Class_Db();
    $con = $objDB->selectManager()->connect();
    
    //Creamos la consulta de los alumnos nuevos (estaado = 0)
    //$sql="select * from datos where estado=0;";

    //Especificamos los datos y configuración del servidor
    $mail = new PHPMailer();         
    //Especificamos los datos y configuración del servidor
    $mail->IsSMTP();
    
    $mail->CharSet = 'UTF-8';
    
    //Esto es para activar el modo depuración. En entorno de pruebas lo mejor es 2, en producción siempre 0
    // 0 = off (producción)
    // 1 = client messages
    // 2 = client and server messages
    $mail->SMTPDebug  = 0;   
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = "ssl";
    $mail->Host = 'smtp.gmail.com'; // SMTP a utilizar. Por ej. smtp.elserver.com
    $mail->Username = "disclosure.vs@gmail.com"; // Correo completo a utilizar
    $mail->Password = "disclosure.vs123"; // Contraseña
    $mail->Port = 465; // Puerto a utilizar

    //Agregamos la información que el correo requiere
    //Con estas pocas líneas iniciamos una conexión con el SMTP. Lo que ahora deberíamos hacer, es configurar el mensaje a enviar, el //From, etc.
    $mail->From = "www.disclosure.com"; // Desde donde enviamos (Para mostrar)
    $mail->FromName = "www.disclosure.com << $name - $email >>";
    
    $mail->addAddress("hcumbicusr@gmail.com");
    //$mail->addCC("luigiflorez28@gmail.com");
    //$mail->addCC("pkarlaa25@gmail.com");
    //$mail->addCC("bramirezburneo@gmail.com");
            
    $mail->Subject = "$subject"; // Este es el titulo del email.
    
    $mensaje_arr = formato_email($message, $formato);
    $mensaje = $mensaje_arr['header'].$mensaje_arr['content'].$mensaje_arr['footer'];
    
    $mail->Body = ($mensaje); // Mensaje a enviar
    $mail->IsHTML(true);
    
    //Enviamos el correo electrónico

    if($mail->Send()){
        $success = true;
    }else{
        $success = false;
    }

    if($success)
    {
        $browser = Funciones::DatosBrowser();
        $procedure = "sp_reg_bandeja_entrada";
        $input = "'".$browser[0]."',"
                ."'".$browser[1]."',"
                ."'".$browser[2]."',"
                ."'".$_SESSION['sessionID']."',"
                ."'".$name."',"
                ."'".$email."',"
                ."'".$subject."',"
                ."'".htmlentities($mensaje)."','$tipo'";
        
        $result = $objDB->selectManager()->spInsert($con, $procedure, $input);
        
        $status = array(
		'type'=>'success',
		'message'=>'Gracias por escribirnos. Estaremos en contacto contigo lo mas pronto posible',
                'BD' => $result
	);
    }else
    {
        $status = array(
		'type'=>'error',
		'message'=>'Se produjo un error, no se ha podido enviar su correo. Intentelo mas tarde'
	);
    }
    
    echo json_encode($status);
    exit();
    
    //-------  formato
    function formato_email($message, $formato = 'contacto')
    {
        $header_c = "<h2>Mensaje de formulario de contacto (www.disclosure.com):</h2><br>";
        $header_c .= "<b>Mensaje:</b><br>";
        $content_c = "<p align=\"justify\">".Funciones::filtraCaracteresEspeciales($message)."</p><br><br>";
        $footer_c = "-------------------------------------------------------------------------<br>";
        $footer_c .= "Fin del mensaje";
        
        // opinion
        $header_o = "<h2>Mensaje de Opinión (www.disclosure.com):</h2><br>";
        $header_o .= "<b>Mensaje:</b><br>";
        $content_o = "<p align=\"justify\">".Funciones::filtraCaracteresEspeciales($message)."</p><br><br>";
        $footer_o = "-------------------------------------------------------------------------<br>";
        $footer_o .= "Fin del mensaje";
        
        $formato_email = 
        [
                "contacto" => 
                [
                        "header" => $header_c,
                        "content" => $content_c,
                        "footer" => $footer_c
                ],
                "opinion" => 
                [
                        "header" => $header_o,
                        "content" => $content_o,
                        "footer" => $footer_o
                ]
        ];
        return $formato_email[$formato];
    }