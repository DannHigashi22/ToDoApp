<?php
require_once 'models/usuario.php';
class UsuarioController {
    public function index(){
        echo 'index controlador usuario';
    }

    public function register(){
        require_once 'views/usuario/register.phtml';
    }

    public function create(){
        if (isset($_POST)) {
            $nombre=isset($_POST['nombre'])? $_POST['nombre']:false;
            $apellidos=isset($_POST['apellidos'])? $_POST['apellidos']:false;
            $email=isset($_POST['email'])? $_POST['email']:false;
            $pass=isset($_POST['pass'])? $_POST['pass']:false;
            
            $flag=array();
            if (!$nombre || preg_match("/[0-9]/",$nombre)) {
                $flag['nombre']="Campo incorrecto, intente nuevamente";
            }
            if (!$apellidos || preg_match("/[0-9]/",$apellidos)) {
                $flag['apellidos']="Campo incorrecto, intente nuevamente";
            }
            if (!$email || !filter_var($email,FILTER_VALIDATE_EMAIL)) {
                $flag['email']="Email incorrecto, intente nuevamente";
            }
            if (!$pass || (strlen($pass)<4)) {
                $flag['pass']="Contraseña con 4 caracteres o mas";
            }

            if (count($flag)==0) {
                $newUser=new Usuario();
                $newUser->setNombre($nombre);
                $newUser->setApellidos($apellidos);
                $newUser->setEmail($email);
                //hash pass
                $passHash=password_hash($pass,PASSWORD_BCRYPT,['cost'=>4]);
                //fin de hash
                $newUser->setPass($passHash);
                $create=$newUser->create();
                if ($create) {
                    $_SESSION['register']['create']="Cuenta creada correctamente";
                }else {
                    $_SESSION['register']['create']="Fallo al crear usuario";
                }

            }else {
                $_SESSION['register']=$flag;
            }

        }

        header("location:".base_url."usuario/register");
    }
    
}
?>