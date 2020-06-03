<?php
class MyPDO{
    public static function getMysqlConnexion()
    {
        $db = new PDO('mysql:host=localhost;dbname=online;charset=utf8','root','');
       // TODO  $db = new PDO('mysql:host=localhost; dbname=emediam_online; charset=utf8',"emediam_tsiory","808283technique");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    }

}

?>