<?php
class Usuario{
    private $id;
    private $nombre;
    private $apellidos;
    private $email;
    private $pass;
    private $image;
    private $db;

    public function __construct(){
        $this->db=Database::connect();
    }

    public function getId(){
        return $this->id;
    }
    public function setId($id){
        $this->id=$id;
    }

    public function getNombre(){
        return $this->nombre;
    }
    public function setNombre($nombre){
        $this->nombre=$this->db->real_escape_string($nombre);
    }

    public function getApellidos(){
        return $this->apellidos;
    }
    public function setApellidos($apellidos){
        $this->apellidos=$this->db->real_escape_string($apellidos);
    }

    public function getEmail(){
        return $this->email;
    }
    public function setEmail($email){
        $this->email=$email;
    }

    public function getPass(){
        return $this->pass;
    }
    public function setPass($pass){
        $this->pass=$pass;  
    }

    public function getImage(){
        return $this->image;
    }
    public function setImage($image){
        $this->image=$image;
    }

    public function create(){
        $sql="INSERT INTO usuarios values(null,'{$this->getNombre()}','{$this->getApellidos()}','{$this->getEmail()}','{$this->getPass()}',null);";
        $save=$this->db->query($sql);
        if ($save) {
            return true;
        }else {
            return false;
        }
    }

    public function getUser(){
        $sql="SELECT * FROM usuarios where email='{$this->getEmail()}' LIMIT 1;";
        $login=$this->db->query($sql);
        if ($login) {
            return $login->fetch_object();
        }else {
            return false;
        }
    }

    public function update(){
        $sql="UPDATE usuarios SET nombre='{$this->getNombre()}', apellidos='{$this->getApellidos()}', pass='{$this->getPass()}' where id={$this->getId()}";
        $save=$this->db->query($sql);

        if ($save) {
            return true;
        }else {
            return false;
        }
    }



}
?>