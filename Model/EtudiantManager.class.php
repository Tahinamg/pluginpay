<?php
//uploadena

class EtudiantManager{
    protected $db;

    public function __construct($db)
    {
        $this->setDb($db);
    }
    public function setDb(PDO $db){
        $this->db=$db;
    }
    Public function createEtudiant($matricule){
        $statement=$this->db->prepare("SELECT IDETUDIANTS,NATIONALITE,NOM,PRENOM,NUMERO,SEMESTRE,ECOLAGE,INSCRIPTION,EXAMEN,SOUTENANCE,CERTIFICAT,MATRICULE,MAIL from SUIVRE NATURAL JOIN ETUDIANTS WHERE MATRICULE = :matricule ");
        $statement->bindValue(":matricule",$matricule,PDO::PARAM_STR);
        $statement->execute();
        
        $data=$statement->fetch(PDO::FETCH_ASSOC);
        $statement->closeCursor();
        return $data;
    }
    public function getRepechageEtudiant($idetudiants){
        $statement=$this->db->prepare("SELECT count(*) FROM `REPECHER` WHERE `IDETUDIANTS`=:idetudiants ");
        $statement->bindValue(":idetudiants",$idetudiants,PDO::PARAM_INT);
        $statement->execute();
        $data=$statement->fetch();
        $statement->closeCursor();
        return $data;
    }

    public function dejaInscrit($data){
        $statement=$this->db->prepare("SELECT count(*) FROM `SUIVRE` NATURAL JOIN `ETUDIANTS` WHERE `NOM`=:nom AND `PRENOM`=:prenom AND `NUMERO`=:numero AND `INSCRIPTION`=1");
        $statement->bindValue(":nom",$data['nom'],PDO::PARAM_STR);
        $statement->bindValue(":prenom",$data['prenom'],PDO::PARAM_STR);
        $statement->bindValue(":numero",$data['numero'],PDO::PARAM_STR);
        $statement->execute();
        $datareturn=$statement->fetch();
        $statement->closeCursor();
        return $datareturn;
    }
    public function inscriPlusieursFois($data){
        $statement=$this->db->prepare("SELECT count(*) FROM `ETUDIANTS` WHERE `NOM`=:nom AND `PRENOM`=:prenom AND `NUMERO`=:numero");
        $statement->bindValue(":nom",$data['nom'],PDO::PARAM_STR);
        $statement->bindValue(":prenom",$data['prenom'],PDO::PARAM_STR);
        $statement->bindValue(":numero",$data['numero'],PDO::PARAM_STR);
        $statement->execute();
        $datareturn=$statement->fetch();
        $statement->closeCursor();
        return $datareturn;
    }
    

}


?>