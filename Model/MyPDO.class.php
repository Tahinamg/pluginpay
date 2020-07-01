<?php
class MyPDO{
    public static function getMysqlConnexion()
    {
        
        $db = new PDO('mysql:host=localhost; dbname=emediam_highschool; charset=utf8',"emediam_4dm1n","808283technique");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    }

}

?>