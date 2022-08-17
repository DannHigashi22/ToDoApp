<?php
class Database{
    public static function connect(){
        $db=new Mysqli("localhost","root",'',"Dbtodo","3307");
        $db->query("SET NAMES 'utf8'");
        return $db;
    }
}

?>