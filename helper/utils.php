<?php
class Utils{
    public static function deleteFlag($campo){
        if (isset($_SESSION[$campo])) {
            $_SESSION[$campo]=null;
        }
    }

    public static function showFlagFailed($array,$campo){
        if (isset($_SESSION[$array][$campo])) {
            $result='<p class="flag-red">'.$_SESSION[$array][$campo].'</p>';
        }else {
            $result='';
        }
        return $result;
    }

    public static function isLogin(){
        if (!isset($_SESSION['user'])) {
            header('location:'.base_url.'usuario/index');
        }
    }

    public static function showState($state){
        switch ($state) {
            case 'done':
                $result='Realizado';
                break;
            default:
                $result="Pendiente";
                break;
        }
        return $result;
    }

    public static function howTask(){
        if (isset($_SESSION['user'])) {
            require_once 'models/nota.php';
            $user=$_SESSION['user']->id;
            date_default_timezone_set('America/Santiago');
            $today=date('Y-m-d');
            $task=new Nota();
            $task->setUsuario_id($user);
            $task->setFecha($today);
            $task=$task->getPending();
            $result='Tienes '.$task->num_rows.' To Do';
        }else {
            $result='Entra para saber mas';
        }
        return $result;
    }


}
?>