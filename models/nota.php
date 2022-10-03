<?php
class Nota{
    private $id;
    private $usuario_id;
    private $titulo;
    private $descripcion;
    private $estado;
    private $fecha;
    private $hora;
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

    public function getUsuario_id(){
        return $this->usuario_id;
    }
    public function setUsuario_id($usuario_id){
        $this->usuario_id=$usuario_id;
    }

    public function getTitulo(){
        return $this->titulo;
    }
    public function setTitulo($titulo){
        $this->titulo=$this->db->real_escape_string($titulo);
    }

    public function getDescripcion(){
        return $this->descripcion;
    }
    public function setDescripcion($descripcion){
        $this->descripcion=$this->db->real_escape_string($descripcion);
    }

    public function getEstado(){
        return $this->estado;
    }
    public function setEstado($estado){
        $this->estado=$estado;  
    }

    public function getFecha(){
        return $this->fecha;
    }
    public function setFecha($fecha){
        $this->fecha=$fecha;
    }

    public function getHora(){
        return $this->hora;
    }
    public function setHora($hora){
        $this->hora=$hora;
    }

    public function create(){
        $sql="INSERT INTO notas values(null,{$this->getUsuario_id()},'{$this->getTitulo()}',null,'pending',curdate(),curtime());";
        $save=$this->db->query($sql);
        if ($save) {
            return true;
        }else {
            return false;
        }
    }

    public function update(){
        $sql="UPDATE notas SET titulo='{$this->getTitulo()}', descripcion='{$this->getDescripcion()}', estado='{$this->getEstado()}', fecha='{$this->getFecha()}' 
        where id={$this->getId()} AND usuario_id={$this->getUsuario_id()} ; ";
        $update=$this->db->query($sql);
        
        if ($update) {
            return true;
        }else {
            return false;
        }
    }

    public function delete(){
        $sql="delete * FROM notas where id={$this->getId()} AND usuario_id={$this->getUsuario_id()} ;";
        $nota=$this->db->query($sql);
        if ($nota) {
            return $nota;
        }else {
            return false;
        }
    }

    public function getAll(){
        $sql="SELECT * FROM notas WHERE usuario_id={$this->getUsuario_id()} ORDER BY id desc";
        $notas=$this->db->query($sql);
        if ($notas) {
            return $notas;
        }else {
            return false;
        }
    }

    public function getPending(){
        $sql="SELECT * FROM notas where usuario_id={$this->getUsuario_id()} AND fecha='{$this->getFecha()}' AND estado='pending'; ";
        $notas=$this->db->query($sql);
        if ($notas) {
            return $notas;
        }else {
            return false;
        }
    }

    public function getForId(){
        $sql="SELECT * FROM notas where id={$this->getId()};";
        $notas=$this->db->query($sql);
        if ($notas) {
            return $notas->fetch_object();
        }else {
            return false;
        }
    }

    public function checkNote(){
        $sql="UPDATE notas SET estado='{$this->getEstado()}' where id={$this->getId()} AND usuario_id={$this->getUsuario_id()}";
        $save=$this->db->query($sql);

        if ($save) {
            return true;
        }else {
            return false;
        }
    }
    
    public function checkAllNotes(){
        $sql="UPDATE notas SET estado='{$this->getEstado()}' where fecha='{$this->getFecha()}' AND usuario_id={$this->getUsuario_id()}";
        $save=$this->db->query($sql);

        if ($save) {
            return true;
        }else {
            return false;
        }
    }
}
?>