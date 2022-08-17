<?php
class UsuarioController {
    public function index(){
        echo 'index controlador usuario';
    }

    public function register(){
        require_once 'views/usuario/register.phtml';
    }

    public function create(){
        
    }
    
}
?>