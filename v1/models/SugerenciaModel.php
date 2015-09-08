<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SugerenciaModel
 *
 * @author Admin
 */
class SugerenciaModel {
    private $id_suggested;
    private $artist_group;
    private $name;
    private $email;
    private $date_register;
    private $state;
    
    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getId_suggested() {
        return $this->id_suggested;
    }

    public function getArtist_group() {
        return $this->artist_group;
    }

    public function getName() {
        return $this->name;
    }

    public function getDate_register() {
        return $this->date_register;
    }

    public function getState() {
        return $this->state;
    }

    public function setId_suggested($id_suggested) {
        $this->id_suggested = $id_suggested;
    }

    public function setArtist_group($artist_group) {
        $this->artist_group = $artist_group;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setDate_register($date_register) {
        $this->date_register = $date_register;
    }

    public function setState($state) {
        $this->state = $state;
    }
    
    //.------------------------------------------------------------------------------
    /**
     * Lista todas las sugerencias sin excepcion // 
     */
    public function listarSugerenciasTodas() {
        $objDB = new Class_Db();
        $con = $objDB->selectManager()->connect();
        //$browser = Funciones::DatosBrowser();
        $procedure = "sp_listar_sugerencias";
        $result = $objDB->selectManager()->spSelect($con, $procedure);
        return $result;
    }
    /**
     * Lista por esado
     */
    public function listarSugerenciasEstado() {
        $objDB = new Class_Db();
        $con = $objDB->selectManager()->connect();
        //$browser = Funciones::DatosBrowser();
        $procedure = "sp_listar_sugerencias_estado";
        $input ="'".$this->getState()."'";
        $result = $objDB->selectManager()->spSelect($con, $procedure,$input);
        return $result;
    }
    /**
     * Registra una sgerencia
     */
    public function registrarSugerencia() {
        $objDB = new Class_Db();
        $con = $objDB->selectManager()->connect();
        //$browser = Funciones::DatosBrowser();
        $procedure = "sp_registrar_sugerencia";
        $input = "'".$this->getArtist_group()."',"
                ."'".$this->getName()."',"
                ."'".$this->getEmail()."'";
        $result = $objDB->selectManager()->spInsert($con, $procedure,$input);
        return $result;
    }

    /**
     * eliminar una sgerencia // cambiar de estado
     */
    public function eliminarSugerencia() {
        $objDB = new Class_Db();
        $con = $objDB->selectManager()->connect();
        //$browser = Funciones::DatosBrowser();
        $procedure = "sp_atender_sugerencia";
        $input = "'".$this->getId_suggested()."'";
        $result = $objDB->selectManager()->spInsert($con, $procedure,$input);
        return $result;
    }


    function __construct() {
        
    }
    
    function __destruct() {
        unset($this);
    }
}
