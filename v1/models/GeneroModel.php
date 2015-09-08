<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GeneroModel
 *
 * @author Admin
 */
class GeneroModel {
    private $id_musicgenre;
    private $name;
    
    public function getId_musicgenre() {
        return $this->id_musicgenre;
    }

    public function getName() {
        return $this->name;
    }

    public function setId_musicgenre($id_musicgenre) {
        $this->id_musicgenre = $id_musicgenre;
    }

    public function setName($name) {
        $this->name = $name;
    }
    
    //-------------------------------------------------------
    /**
     * Lista todos los generos
     */
    public function listarGeneros() {
        $objDB = new Class_Db();
        $con = $objDB->selectManager()->connect();
        //$browser = Funciones::DatosBrowser();
        $procedure = "sp_combo_genero";
        $result = $objDB->selectManager()->spSelect($con, $procedure);
        return $result;
    }


    
    function __construct() {
        
    }
    
    function __destruct() {
        unset($this);
    }
}
