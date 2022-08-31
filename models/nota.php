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
        $this->descripcion=$descripcion;
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
        $sql="INSERT INTO notas values(null,{$this->getUsuario_id()},'{$this->getTitulo()}',null,'pendiente',curdate(),curtime());";
        $save=$this->db->query($sql);
        if ($save) {
            return true;
        }else {
            return false;
        }
    }

    public function getAll(){
        $sql="SELECT * FROM notas where usuario_id={$this->getUsuario_id()} AND fecha='{$this->getFecha()}'; ";
        $notas=$this->db->query($sql);
        if ($notas) {
            return $notas;
        }else {
            return false;
        }
    }
    public function checkNote(){
        $sql="UPDATE notas SET estado='{$this->getEstado()}' where id={$this->getId()}";
        $save=$this->db->query($sql);

        if ($save) {
            return true;
        }else {
            return false;
        }
    }
    
}
?>