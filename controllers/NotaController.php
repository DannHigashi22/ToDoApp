<?php
require_once 'models/nota.php';
class NotaController{
    public function index(){
        Utils::isLogin();
        $user=$_SESSION['user'];
        date_default_timezone_set('America/Santiago');
        $today=date('Y-m-d');
      
        $notas_User=new Nota();
        $notas_User->setUsuario_id($user->id);
        $notas_User->setFecha($today);

        $notasToday=$notas_User->getAll();
        require_once 'views/nota/index.phtml';
    }

    public function create(){
        Utils::isLogin();
        if ($_POST) {
            $user=$_SESSION['user'];
            $titulo=isset($_POST['titulo'])? $_POST['titulo']:false;

            $errores=array();
            if (empty($titulo)) {
                $errores['titulo']='Este campo no puede ser vacio';
            }

            if (count($errores)==0) {
                $new_nota=new Nota();
                $new_nota->setUsuario_id($user->id);
                $new_nota->setTitulo($titulo);
                $new_nota->create();
            }

        }
        return header('location:'.base_url.'nota/index');
    }
}
?>