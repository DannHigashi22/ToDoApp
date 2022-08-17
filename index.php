<?php
require_once 'autoload.php';
require_once 'config/db.php';
require_once 'views/layout/header.phtml';

//controllador frontal
if (isset($_GET['controller'])) {
    $nameController=$_GET['controller'].'Controller';
}else{
    $nameController='NotaController';
}

if (isset($_GET['action'])) {
    $actionController=$_GET['action'];
}else {
    $actionController="index";
}

if(@class_exists($nameController) && is_callable([$nameController,$actionController])){
    $controler=new $nameController();
    $controler->$actionController();    
}else {
    require_once 'views/layout/404.phtml';
}

require_once 'views/layout/footer.phtml';


?>

