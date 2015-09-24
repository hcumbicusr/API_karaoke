<?php

class GeneralModel {
    private $id;
    private $param1;
    private $param2;
    private $param3;
    private $param4;
    private $param5;
    
    public function getId() {
        return $this->id;
    }

    public function getParam1() {
        return $this->param1;
    }

    public function getParam2() {
        return $this->param2;
    }

    public function getParam3() {
        return $this->param3;
    }

    public function getParam4() {
        return $this->param4;
    }

    public function getParam5() {
        return $this->param5;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setParam1($param1) {
        $this->param1 = $param1;
    }

    public function setParam2($param2) {
        $this->param2 = $param2;
    }

    public function setParam3($param3) {
        $this->param3 = $param3;
    }

    public function setParam4($param4) {
        $this->param4 = $param4;
    }

    public function setParam5($param5) {
        $this->param5 = $param5;
    }
    
    /**
     * conneccion a la base de datos
     */
    public function testConnect() {
        $objDB = new Class_Db();
        $con = $objDB->selectManager()->connect();
        //$browser = Funciones::DatosBrowser();
        $query = "SELECT * FROM settings";
        $result = $objDB->selectManager()->select($con, $query);
        return $result;
    }

    function __construct() {
        
    }

    function __destruct() {
        unset($this);
    }
    
}