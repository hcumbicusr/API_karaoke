<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserModel
 *
 * @author Admin
 */
class UsuarioModel {
    private $id_user;
    private $name;
    private $password;
    private $fullname;
    private $email;
    private $level;
    private $state;
    private $date_register;
    
    public function getId_user() {
        return $this->id_user;
    }

    public function getName() {
        return $this->name;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getFullname() {
        return $this->fullname;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getLevel() {
        return $this->level;
    }

    public function getState() {
        return $this->state;
    }

    public function getDate_register() {
        return $this->date_register;
    }

    public function setId_user($id_user) {
        $this->id_user = $id_user;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setFullname($fullname) {
        $this->fullname = $fullname;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setLevel($level) {
        $this->level = $level;
    }

    public function setState($state) {
        $this->state = $state;
    }

    public function setDate_register($date_register) {
        $this->date_register = $date_register;
    }

    //-------------------------------------------------------------------------
    /**
     * Registra un usuario
     */
    public function registrarUsuario() {
        $objDB = new Class_Db();
        $con = $objDB->selectManager()->connect();
        //$browser = Funciones::DatosBrowser();
        $procedure = "sp_registrar_usuario";
        $input = "'".$this->getName()."',"
                ."'".md5($this->getPassword())."',"
                ."'".$this->getFullname()."',"
                ."'".$this->getEmail()."',"
                ."'".$this->getLevel()."'";
        $result = $objDB->selectManager()->spInsert($con, $procedure,$input);
        return $result;
    }
    /**
     * Login
     * @return array Array con los datos del usuario logueado o NULL
     */
    public function loginUsuario() {
        $objDB = new Class_Db();
        $con = $objDB->selectManager()->connect();
        //$browser = Funciones::DatosBrowser();
        $procedure = "sp_login_usuario";
        $input = "'".$this->getName()."',"
                ."'".md5($this->getPassword())."'";
        $result = $objDB->selectManager()->spSelect($con, $procedure,$input);
        return $result;
    }

    function __construct() {
        
    }
    function __destruct() {
        unset($this);
    }

}
