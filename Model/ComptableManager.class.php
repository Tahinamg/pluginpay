<?php
class ComptableManager{
protected $db;

public function __construct($db)
{
    $this->setDb($db);
}
public function setDb(PDO $db){
    $this->db=$db;
}

public function getAccess($data){
    $statement=$this->db->prepare('SELECT count(*) FROM `SCOLARITE` WHERE `MATRICULE`=:matricule AND `MDP`=:mdp');
    $statement->bindValue(":matricule",$data['matricule'],PDO::PARAM_STR);
    $statement->bindValue(":mdp",$data['mdp'],PDO::PARAM_STR);
    $statement->execute();
    return $statement->fetch();
}
}

?>