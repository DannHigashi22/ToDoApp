<?php
require_once 'models/usuario.php';
class UsuarioController {

    public function index(){
        require_once 'views/usuario/index.phtml';
    }
    public function myAccount(){
        Utils::isLogin();
        require_once 'views/usuario/myaccount.phtml';    
    }

    public function enter(){
        require_once 'views/usuario/user.phtml';
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
        header("location:".base_url."usuario/myAccount");
    }

    public function login(){
        if (isset($_POST)) {
            $email=isset($_POST['email'])? $_POST['email']:false;
            $pass=isset($_POST['pass'])? $_POST['pass']:false;

            $flag=array();
            if (!$email || !filter_var($email,FILTER_VALIDATE_EMAIL)) {
                $flag['email']="Email incorrecto, intente nuevamente";
            }
            if (!$pass || (strlen($pass)<4)) {
                $flag['pass']="Ingrese Constraseña";
            }
            if (count($flag)==0) {
                $user=new Usuario();
                $user->setEmail($email);
                $userLog=$user->getUser();
                if (is_object($userLog)) {
                    //verificar la pass
                    $verify=password_verify($pass,$userLog->pass);
                    if ($verify) {
                        $_SESSION['user']=$userLog;
                    }else {
                        $flag['pass']="Contraseña incorrecto, intente nuevamente";
                        $_SESSION['login']=$flag;
                    }
                }else {
                    $flag['email']="Email incorrecto, intente nuevamente";
                    $_SESSION['login']=$flag;
                }
            }else {
                $_SESSION['login']=$flag;
            }
        }
        header("location:".base_url.'usuario/myAccount');
    }

    public function logout(){
        Utils::isLogin();
        if (isset($_SESSION['user'])) {
            $_SESSION['user']=null;
        }
        header('location:'.base_url);
    }
    
    public function edit(){
        Utils::isLogin();
        $user=$_SESSION['user'];
        require_once 'views/usuario/edit.phtml';
    }
    public function update(){
        if (isset($_POST)) {
            $nombre=isset($_POST['nombre'])? $_POST['nombre']:false;
            $apellidos=isset($_POST['apellidos'])? $_POST['apellidos']:false;
            $pass=isset($_POST['pass'])? $_POST['pass']:false;
            
            $flag=array();
            if (!$nombre || preg_match("/[0-9]/",$nombre)) {
                $flag['nombre']="Campo incorrecto, intente nuevamente";
            }
            if (!$apellidos || preg_match("/[0-9]/",$apellidos)) {
                $flag['apellidos']="Campo incorrecto, intente nuevamente";
            }
            if (!$pass || (strlen($pass)<4)) {
                $flag['pass']="Confirma tu contraseña para actualizar datos";
            }

            if (count($flag)==0) {
                $user=new Usuario();
                $user->setId($_SESSION['user']->id);
                $user->setNombre($nombre);
                $user->setApellidos($apellidos);
                $user->setEmail($_SESSION['user']->email);
                //hash pass
                $passHash=password_hash($pass,PASSWORD_BCRYPT,['cost'=>4]);
                //fin de hash
                $user->setPass($passHash);
                $update=$user->update();
                if ($update) {
                    $_SESSION['update']['user']="Cuenta actualizada correctamente";
                    $_SESSION['user']=$user->getUser();
                }else {
                    $_SESSION['update']['user']="Fallo al actualizar usuario";
                }

            }else {
                $_SESSION['update']=$flag;
            }

        }
        header("location:".base_url."usuario/edit");
    }
}
?>