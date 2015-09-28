<script>
    //window.location.href = "./v1";
</script>
<html>
    <head>
        <title>Prueba</title>
    </head>
    <body>
        
        <form action="v1/pedidos/pedidos.php"method="post" >
            <input id="table" name="table" value="">
            <input id="music" name="music" value="">
        </form> <br>
        <form >
            <a id="btn_enviar" >Enviar</a>
        </form>
        
        ------------
        <form action="v1/connect/connect.php" method="post" >
            <input id="accion" name="accion" value="connect">
            <input type="submit"  value="TEST">
        </form> <br>
        <form >
            <a id="btn_enviar" >Enviar</a>
        </form>
        <br>
        ---------------
        <br>
        <form  action="v1/mesas/mesas.php" method="post" >
            <input name="accion" value="login_table" placeholder="accion" >
            <input name="token" value="2M98" placeholder="token de mesa" >
            <input type="submit" id="btn_enviar" value="Buscar mesa" >
        </form>
        
        <input id="btn_lista" type="button" value="enviar">
        <script src="js/jquery.js"></script>
        <script src="js/app.js"></script>
    </body>
</html>
<?php
include './Config.inc.php';

function generaTokenMesa()
    {
        $objDB = new Class_Db();
        $con = $objDB->selectManager()->connect();
        $query = "select number from table_business where stat = 2";
        $result = $objDB->selectManager()->select($con, $query);
        $cad = "";
        for($i=0;$i< count($result);$i++) {
        $cad .= "UPDATE table_business set token = '".$result[$i]['number']."M". rand(0,9). rand(0,9)."' where  number = '".$result[$i]['number']."';";
        }
        return $cad;
    }
//die (var_dump(generaTokenMesa()));
?>