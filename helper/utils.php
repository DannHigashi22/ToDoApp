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


}
?>