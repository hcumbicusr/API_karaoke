<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MesaModel
 *
 * @author Admin
 */
class MesaModel {
    private $id_table;
    private $number;
    private $date_register;
    private $state;
    private $token;
    
    public function getToken() {
        return $this->token;
    }

    public function setToken($token) {
        $this->token = $token;
    }

        
    public function getId_table() {
        return $this->id_table;
    }

    public function getNumber() {
        return $this->number;
    }

    public function getDate_register() {
        return $this->date_register;
    }

    public function getState() {
        return $this->state;
    }

    public function setId_table($id_table) {
        $this->id_table = $id_table;
    }

    public function setNumber($number) {
        $this->number = $number;
    }

    public function setDate_register($date_register) {
        $this->date_register = $date_register;
    }

    public function setState($state) {
        $this->state = $state;
    }
    //----------------------------------------------------------------
    /**
     * Lista todas las mesas activas
     */
    public function listarMesas() {
        $objDB = new Class_Db();
        $con = $objDB->selectManager()->connect();
        //$browser = Funciones::DatosBrowser();
        $procedure = "sp_listar_mesas";
        $result = $objDB->selectManager()->spSelect($con, $procedure);
        return $result;
    }
    
    /**
     * Registra una mesa
     */
    public function registrarMesa() {
        $objDB = new Class_Db();
        $con = $objDB->selectManager()->connect();
        //$browser = Funciones::DatosBrowser();
        $procedure = "sp_registrar_mesa";
        $input = "'".$this->getNumber()."',"."'".$this->getToken()."'";
        $result = $objDB->selectManager()->spInsert($con, $procedure,$input);
        return $result;
    }
    /**
     * Select mesa actual activa
     */
    public function selectUltimaMesa() {
        $objDB = new Class_Db();
        $con = $objDB->selectManager()->connect();
        //$browser = Funciones::DatosBrowser();
        $query = "select number from table_business where stat = 2 order by id_table desc limit 1";
        $result = $objDB->selectManager()->select($con, $query);
        return $result;
    }
    /**
     * Eliminar una mesa
     */
    public function eliminarMesa() {
        $objDB = new Class_Db();
        $con = $objDB->selectManager()->connect();
        //$browser = Funciones::DatosBrowser();
        $procedure = "sp_eliminar_mesa";
        $input = "'".$this->getId_table()."'";
        $result = $objDB->selectManager()->spInsert($con, $procedure,$input);
        return $result;
    }


    
    function __construct() {
        
    }
    
    function __destruct() {
        unset($this);
    }
    
}
