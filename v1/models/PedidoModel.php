<?php

class PedidoModel
{
    private $id_order;
    private $id_table;
    private $id_music;
    private $date_order;
    private $date_attention;
    private $state;
    private $f_desde;
    private $f_hasta;
    
    public function getF_desde() {
        return $this->f_desde;
    }

    public function getF_hasta() {
        return $this->f_hasta;
    }

    public function setF_desde($f_desde) {
        $this->f_desde = $f_desde;
    }

    public function setF_hasta($f_hasta) {
        $this->f_hasta = $f_hasta;
    }

        
    public function getId_order() {
        return $this->id_order;
    }

    public function getId_table() {
        return $this->id_table;
    }

    public function getId_music() {
        return $this->id_music;
    }

    public function getDate_order() {
        return $this->date_order;
    }

    public function getDate_attention() {
        return $this->date_attention;
    }

    public function getState() {
        return $this->state;
    }

    public function setId_order($id_order) {
        $this->id_order = $id_order;
    }

    public function setId_table($id_table) {
        $this->id_table = $id_table;
    }

    public function setId_music($id_music) {
        $this->id_music = $id_music;
    }

    public function setDate_order($date_order) {
        $this->date_order = $date_order;
    }

    public function setDate_attention($date_attention) {
        $this->date_attention = $date_attention;
    }

    public function setState($state) {
        $this->state = $state;
    }

        
    //----------------------------
    /**
     * Lista todos los pedidos sin excepcion
     */
    public function listarPedidos() {
        $objDB = new Class_Db();
        $con = $objDB->selectManager()->connect();
        //$browser = Funciones::DatosBrowser();
        $procedure = "sp_listar_pedidos_sin_atender";
        $result = $objDB->selectManager()->spSelect($con, $procedure);
        return $result;
    }
    /**
     * Lista todos los pedidos sin excepcion del DIA
     */
    public function listarPedidosHoy() {
        $objDB = new Class_Db();
        $con = $objDB->selectManager()->connect();
        //$browser = Funciones::DatosBrowser();
        $procedure = "sp_listar_pedidos_hoy";
        $result = $objDB->selectManager()->spSelect($con, $procedure);
        return $result;
    }
    /**
     * Lista todos los pedidos sin excepcion entre dos fechas
     */
    public function listarPedidosFechas() {
        $objDB = new Class_Db();
        $con = $objDB->selectManager()->connect();
        //$browser = Funciones::DatosBrowser();
        $procedure = "sp_listar_pedidos_fechas";
        $input = "'".$this->getF_desde()."','".$this->getF_hasta()."'";
        $result = $objDB->selectManager()->spSelect($con, $procedure,$input);
        return $result;
    }
    /**
     * Lista todos los pedidos segun estado // atendido, sin atender
     */
    public function listarPedidosEstado() {
        $objDB = new Class_Db();
        $con = $objDB->selectManager()->connect();
        //$browser = Funciones::DatosBrowser();
        $procedure = "sp_listar_pedidos_estado";
        $input = "'".$this->getState()."'";
        $result = $objDB->selectManager()->spSelect($con, $procedure,$input);
        return $result;
    }
    /**
     * Lista el detalle de un pedido// id_pedido
     */
    public function detallePedido() {
        $objDB = new Class_Db();
        $con = $objDB->selectManager()->connect();
        //$browser = Funciones::DatosBrowser();
        $procedure = "sp_detalle_pedido";
        $input = "'".$this->getId_order()."'";
        $result = $objDB->selectManager()->spSelect($con, $procedure,$input);
        //die(var_dump($result));
        return $result;
    }
     /**
     * Lista todos los pedidos de la mesa ingresada
     */
    public function listarPedidosMesa() {
        $objDB = new Class_Db();
        $con = $objDB->selectManager()->connect();
        //$browser = Funciones::DatosBrowser();
        $procedure = "sp_listar_mis_pedidos";
        $input = "'".$this->getId_table()."'";
        $result = $objDB->selectManager()->spSelect($con, $procedure,$input);
        return $result;
    }
    /**
     * Registra un nuevo pedido
     * @return array [Estado,Id_pedido]
     */
     function registrarPedido()
    {
        $val = false;
        $objDB = new Class_Db();
        $con = $objDB->selectManager()->connect();
        //$browser = Funciones::DatosBrowser();
        $procedure = "sp_registrar_pedido";
        
        $input ="'".$this->getId_table()."',"
                ."'".$this->getId_music()."'";
        // retorna [estado,id_pedido]
        $result = $objDB->selectManager()->spInsert($con, $procedure, $input);
        
        return $result;
    }
    /**
     * Edita la cancion del pedido
     * @return array [Estado,Id_pedido]
     */
     function modificarPedido()
    {
        $val = false;
        $objDB = new Class_Db();
        $con = $objDB->selectManager()->connect();
        //$browser = Funciones::DatosBrowser();
        $procedure = "sp_modificar_pedido";
        
        $input ="'".$this->getId_order()."',"
                ."'".$this->getId_table()."',"
                ."'".$this->getId_music()."'";
        // retorna [estado]
        $result = $objDB->selectManager()->spInsert($con, $procedure, $input);
        
        return $result;
    }
    /**
     * Ekimina el pedido realizado // cambia estado en la bd
     * @return estado
     */
     function eliminarPedido()
    {
        $val = false;
        $objDB = new Class_Db();
        $con = $objDB->selectManager()->connect();
        //$browser = Funciones::DatosBrowser();
        $procedure = "sp_eliminar_pedido";
        
        $input ="'".$this->getId_order()."'";
        // retorna [estado]
        $result = $objDB->selectManager()->spInsert($con, $procedure, $input);
        
        return $result;
    }
    /**
     * agrega el pedido al playlist. cambia de estado a 5
     * @return estado
     */
     function playlistPedido()
    {
        $val = false;
        $objDB = new Class_Db();
        $con = $objDB->selectManager()->connect();
        //$browser = Funciones::DatosBrowser();
        $procedure = "sp_cancion_playlist";
        
        $input ="'".$this->getId_order()."'";
        // retorna [estado]
        $result = $objDB->selectManager()->spInsert($con, $procedure, $input);
        
        return $result;
    }
    
    /**
     * cambia de estadp a  un pedido -- sp_cambiar_estado_pedido
     * @return estado
     */
     function atenderPedido()
    {
        $val = false;
        $objDB = new Class_Db();
        $con = $objDB->selectManager()->connect();
        //$browser = Funciones::DatosBrowser();
        $procedure = "sp_cambiar_estado_pedido";
        
        $input ="'".$this->getId_order()."',";
        $input .="'".$this->getState()."'";
        // retorna [estado]
        $result = $objDB->selectManager()->spInsert($con, $procedure, $input);
        
        return $result;
    }

    
    function __construct() {
        
    }

    function __destruct() {
        unset($this);
    }

}