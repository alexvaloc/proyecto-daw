<?php

//Creamos la clase para crear objetos Usuario
class Usuario {

    //Variables privadas de clase
    private $id_usuario;
    private $nombre;
    private $email;
    private $contraseña;

    //Constructor del objeto usuario
    public function __construct($id_usuario,$nombre,$email,$contraseña){

        $this-> id_usuario = $id_usuario;
        $this-> nombre = $nombre;
        $this-> email = $email;
        $this-> contraseña = $contraseña;
    }

        //Getters y setters

    public function getIdUsuario(){
        return $this->id_usuario;
    }

    public function setIdUsuario($id_usuario){
        $this->id_usuario = $id_usuario;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function setNombre($nombre){
        $this->nombre = $nombre;

    }

    public function getEmail(){
        return $this->email;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function getContraseña(){
        return $this->contraseña;
    }

    public function setContraseña($contraseña){
        $this->contraseña = $contraseña;
    }

}

