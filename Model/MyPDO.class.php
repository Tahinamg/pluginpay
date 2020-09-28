<?php
class MyPDO{
    public static function getMysqlConnexion()
    {
       $db=new PDO('mysql:host=localhost;dbname=emediam_highschool;charset=utf8',"root","");
      //$db = new PDO('mysql:host=localhost; dbname=emediam_highschool; charset=utf8',"pma","e-Emedia?20.");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    }

}

?>