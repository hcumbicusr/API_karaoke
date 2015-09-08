<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CancionModel
 *
 * @author Admin
 */
class CancionModel {
    //put your code here
    private $id_music;
    private $id_musicgenre;
    private $id_typemusic;
    private $name;
    private $artist;
    private $album;
    private $description;
    private $year_album;
    private $ruta;
    private $likes;
    private $date_register;
    private $state;
    
    public function getRuta() {
        return $this->ruta;
    }

    public function setRuta($ruta) {
        $this->ruta = $ruta;
    }

        public function getId_music() {
        return $this->id_music;
    }

    public function getId_musicgenre() {
        return $this->id_musicgenre;
    }

    public function getId_typemusic() {
        return $this->id_typemusic;
    }

    public function getName() {
        return $this->name;
    }

    public function getArtist() {
        return $this->artist;
    }

    public function getAlbum() {
        return $this->album;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getYear_album() {
        return $this->year_album;
    }

    public function getLikes() {
        return $this->likes;
    }

    public function getDate_register() {
        return $this->date_register;
    }

    public function getState() {
        return $this->state;
    }

    public function setId_music($id_music) {
        $this->id_music = $id_music;
    }

    public function setId_musicgenre($id_musicgenre) {
        $this->id_musicgenre = $id_musicgenre;
    }

    public function setId_typemusic($id_typemusic) {
        $this->id_typemusic = $id_typemusic;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setArtist($artist) {
        $this->artist = $artist;
    }

    public function setAlbum($album) {
        $this->album = $album;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setYear_album($year_album) {
        $this->year_album = $year_album;
    }

    public function setLikes($likes) {
        $this->likes = $likes;
    }

    public function setDate_register($date_register) {
        $this->date_register = $date_register;
    }

    public function setState($state) {
        $this->state = $state;
    }

    //-------------------------------------------------------
    /**
     * Lista todas las canciones sin excepcion // del tipo 1 - karaoke
     */
    public function listarCancionesTipo() {
        $objDB = new Class_Db();
        $con = $objDB->selectManager()->connect();
        //$browser = Funciones::DatosBrowser();
        $procedure = "sp_listar_canciones_tipo";
        $input = "'".$this->getId_typemusic()."'";
        $result = $objDB->selectManager()->spSelect($con, $procedure,$input);
        return $result;
    }
    /**
     * Lista todas las canciones sin excepcion // del filtra por ID_GENERO
     */
    public function listarCancionesGenero() {
        $objDB = new Class_Db();
        $con = $objDB->selectManager()->connect();
        //$browser = Funciones::DatosBrowser();
        $procedure = "sp_listar_canciones_genero";
        $input = "'".$this->getId_musicgenre()."'";
        $result = $objDB->selectManager()->spSelect($con, $procedure,$input);
        return $result;
    }
    /**
     * Lista todas las canciones sin excepcion // del filtra por nombre de cancion
     */
    public function listarCancionesNombre() {
        $objDB = new Class_Db();
        $con = $objDB->selectManager()->connect();
        //$browser = Funciones::DatosBrowser();
        $procedure = "sp_listar_canciones_nombre";
        $input = "'".$this->getName()."'";
        $result = $objDB->selectManager()->spSelect($con, $procedure,$input);
        return $result;
    }
    /**
     * Lista todas las canciones sin excepcion // del filtra por nombre de artista
     */
    public function listarCancionesArtista() {
        $objDB = new Class_Db();
        $con = $objDB->selectManager()->connect();
        //$browser = Funciones::DatosBrowser();
        $procedure = "sp_listar_canciones_artista";
        $input = "'".$this->getArtist()."'";
        $result = $objDB->selectManager()->spSelect($con, $procedure,$input);
        return $result;
    }
    /**
     * Lista todas las canciones sin excepcion // del filtra por nombre de album
     */
    public function listarCancionesAlbum() {
        $objDB = new Class_Db();
        $con = $objDB->selectManager()->connect();
        //$browser = Funciones::DatosBrowser();
        $procedure = "sp_listar_canciones_album";
        $input = "'".$this->getAlbum()."'";
        $result = $objDB->selectManager()->spSelect($con, $procedure,$input);
        return $result;
    }
    
    /**
     * Registra una cacion
     */
    public function registrarCancion() {
        $objDB = new Class_Db();
        $con = $objDB->selectManager()->connect();
        //$browser = Funciones::DatosBrowser();
        $procedure = "sp_registrar_cancion";
        $input = "'".$this->getId_musicgenre()."',"
                ."'".$this->getId_typemusic()."',"
                ."'".$this->getName()."',"
                ."'".$this->getArtist()."',"
                ."'".$this->getAlbum()."',"
                ."'".$this->getDescription()."',"
                ."'".$this->getYear_album()."',"
                ."'".$this->getRuta()."'";
        $result = $objDB->selectManager()->spInsert($con, $procedure,$input);
        return $result;
    }
    /**
     * Edita una cancion // ID_CANCION
     */
    public function editarCancion() {
        $objDB = new Class_Db();
        $con = $objDB->selectManager()->connect();
        //$browser = Funciones::DatosBrowser();
        $procedure = "sp_editar_cancion";
        $input = "'".$this->getId_music()."',"
                ."'".$this->getId_musicgenre()."',"
                ."'".$this->getId_typemusic()."',"
                ."'".$this->getName()."',"
                ."'".$this->getArtist()."',"
                ."'".$this->getAlbum()."',"
                ."'".$this->getDescription()."',"
                ."'".$this->getYear_album()."',"
                ."'".$this->getRuta()."'";
        $result = $objDB->selectManager()->spInsert($con, $procedure,$input);
        return $result;
    }
    /**
     * Eliminar una cancion // ID_CANCION
     */
    public function eliminarCancion() {
        $objDB = new Class_Db();
        $con = $objDB->selectManager()->connect();
        //$browser = Funciones::DatosBrowser();
        $procedure = "sp_eliminar_cancion";
        $input = "'".$this->getId_music()."'";
        $result = $objDB->selectManager()->spInsert($con, $procedure,$input);
        return $result;
    }
    
    function __construct() {
        
    }

    function __destruct() {
        unset($this);
    }
}
