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
        $this->titulo=$titulo;
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

    
}
?>