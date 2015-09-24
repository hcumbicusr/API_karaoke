<?php

require_once 'interface.php';

class Class_Mysqli implements interfaceDb{
    
    public function connect(){
        global $config;
        
        $con = new mysqli(
                $config['accessBD']['host'], 
                $config['accessBD']['user'], 
                $config['accessBD']['pass'], 
                $config['accessBD']['db']);
        
        if ($con->connect_errno) {
            if($config['entorno'] == 'D'){
                echo "Fallo de la conexion a MySQL: (" . $con->connect_error . ") ";
                die();
            }
        }else{
            $con->query("SET NAMES 'utf8'");
        }
        
        //die(var_dump($con));
        return $con;    
    }
    
    public function select($con,$query){
        //die(var_dump($query));
        $consult = $con->query($query);  
        $data = NULL;
        if ($consult != NULL)
        {
            while($row = mysqli_fetch_assoc($consult))
            {
                $data[] = $row;
            }
        }
        return $data;
    }        
    
    public function insert($con,$query) {
        $result = false;   
        //die(var_dump($query));
        if (!($stmt = $con->prepare($query)))
        {            
            //echo "Fallo en la preparacion sentencia : ( ".$con->errno." ) ".$con->error;
            return false;
        }
        else
        {
            if (!$stmt->execute())
            {
                //echo "Fallo en la ejecucion : ( ".$con->errno." ) ".$con->error;     
                return false;
            }
            else
            {
                $result = true;
            }
        }                
        return $result;        
    }
    public function update($con,$query) {
        $result = false;
        if (!($stmt = $con->prepare($query)))
        {
            //echo "Fallo en la preparacion sentencia : ( ".$con->errno." ) ".$con->error;
            return false;
        }
        else
        {
            if (!$stmt->execute())
            {
                //echo "Fallo en la ejecucion : ( ".$con->errno." ) ".$con->error;                
                return false;
            }
            else
            {
                $result = true;
            }
        }        
        $stmt->close();       
        return $result;
    }
    public function delete($con,$query) {
        $result = false;
        if (!($stmt = $con->prepare($query)))
        {
            //echo "Fallo en la preparacion sentencia : ( ".$con->errno." ) ".$con->error;
            return false;
        }
        else
        {
            if (!$stmt->execute())
            {
               // echo "Fallo en la ejecucion : ( ".$con->errno." ) ".$con->error;                
                return false;
            }
            else
            {
                $result = true;
            }
        }        
        $stmt->close();        
        return $result;
    }
    
    public function spInsert($con, $procedure, $input, $output = true) {                        
        $data = ""; //Salida
        $ret = false; //verifica si se ejecutó correctamente el sp
        
        if($output) // si el sp tiene un parametro de salida
        {
            //die(var_dump("CALL $procedure($input,@salida); SELECT @salida;"));
            $consult = $con->multi_query("CALL $procedure($input,@salida); SELECT @salida;");          
            //die(var_dump($consult));

            if ($consult) {
                do{
                    if ($result = $con->store_result()) {                         
                        while ($row = $result->fetch_row())
                        {                        
                            foreach ($row as $cell) {
                                $data = $cell;#mensaje de salida del procedure                            
                            }
                        }                    
                        $result->close();                    
                        if ($con->more_results()) {
                            $data .= " \t";
                        }else
                        {                        
                            return $data;//return
                        }
                    }
                }while($con->next_result());
            }
            
        }else
        {
            //die(var_dump("CALL $procedure($input)"));
            if(!$con->multi_query("CALL $procedure($input)"))
            {
                //echo "Falla en CALL: (" . $con->errno . ") " . $con->error;
                    $ret = false;
                }else
                {
                    $ret = true;
                }
                return $ret;
            }
    }
    
//    public function spInsert($con,$procedure,$input)
//    {
//        //die(var_dump("CALL $procedure($input)"));
//        $ret = false;
//        if(!$con->multi_query("CALL $procedure($input)"))
//        {
//            //echo "Falla en CALL: (" . $con->errno . ") " . $con->error;
//            $ret = false;
//        }else
//        {
//            $ret = true;
//        }
//        return $ret;
//    }
    
    public function spSelect($con, $procedure, $input = NULL) {   
        if (empty($input))
        {
            $sp = "CALL $procedure()";
        }            
        else
        {
            $sp = "CALL $procedure($input)";
        }
        
        //die(var_dump($sp));
        
        $consult = $con->query($sp);
        
        if ( !($consult) ) 
        {
            //echo "Fallo en la llamada: (" . $con->errno . ") " . $con->error;
            return false;
        }
        $data = NULL;        
        //die(var_dump($consult));
        if ($consult != NULL) {
            //$i=0;
            while ($row = mysqli_fetch_assoc($consult))
            {
                $data[] = $row;                    
                //$i++;
            }
        }        
        return $data;
    }
}