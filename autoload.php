<?php
function appAutoloader($classname){
    include_once 'controllers/'.$classname.'.php';
}

spl_autoload_register('appAutoloader');
?>