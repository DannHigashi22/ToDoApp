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
            header('location:'.base_url);
        }
    }

    /*public static function howTask(){
        $user=$_SESSION['user']->id;
        $date=date('Y-m-d');    
    }*/


}
?>