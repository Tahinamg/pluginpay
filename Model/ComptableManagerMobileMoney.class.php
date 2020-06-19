<?php
class ComptableManagerMobileMoney{
protected $db;

    public function __construct($db)
    {
        $this->setDb($db);
    }
    public function setDb(PDO $db){
        $this->db=$db;
    }



    public function VoirMobileMoney(){
        $sql=$this->db->query("SELECT `SUIVRE`.`MATRICULE`,`ETUDIANTS`.`NOM`,`ETUDIANTS`.`PRENOM`,`ETUDIANTS`.`IDETUDIANTS`,`MOTIF`,`SEMESTRE`,`MOBILEMONEY`.`REFERENCE`,`DATY`,`MOBILEMONEY`.`MONTANT`,`IDMOBILEMONEY`,`MOBILEMONEY`.`ETAT`,`MOBILEMONEY`.`DECISION`,`DATESERVER`  FROM `MOBILEMONEY` NATURAL JOIN `SUIVRE`,`ETUDIANTS` WHERE `ETUDIANTS`.`IDETUDIANTS`=`MOBILEMONEY`.`IDETUDIANTS` AND `MOBILEMONEY`.`ETAT`='non lu' ORDER BY `IDMOBILEMONEY` ASC ");
        return $sql->fetchAll(PDO::FETCH_ASSOC);
        $sql->closeCursor();

    }
    public function NotifMobileMoney(){
        $sql=$this->db->query("SELECT COUNT(*) FROM `MOBILEMONEY` WHERE `ETAT`='non lu' ");
        return $sql->fetch();
        $sql->closeCursor();
    }
    public function ValiderEcolageViaMobileMoney($qte,$matricule,$idmobilemoney){
        $sql1=$this->db->prepare("UPDATE `MOBILEMONEY` SET `ETAT`='lu',`DECISION`='valide' WHERE `IDMOBILEMONEY`=:idmobilemoney");
        $sql1->bindValue(":idmobilemoney",$idmobilemoney,PDO::PARAM_INT);
        $sql1->execute();
        $sql1->closeCursor();
        $sql2=$this->db->prepare("UPDATE `SUIVRE` SET `ECOLAGE`=`ECOLAGE`+:qte WHERE `MATRICULE`=:matricule");
        $sql2->bindValue(":qte",$qte,PDO::PARAM_INT);
        $sql2->bindValue(":matricule",$matricule,PDO::PARAM_STR);
        $sql2->execute();
        $sql2->closeCursor();

    }
    Public function ValiderInscriptionViaMobileMoney($matricule,$idmobilemoney){
        $sql=$this->db->prepare("UPDATE `MOBILEMONEY` SET `ETAT`='lu',`DECISION`='valide' WHERE `IDMOBILEMONEY`=:idmobilemoney");
        $sql->bindValue(":idmobilemoney",$idmobilemoney,PDO::PARAM_INT);
        $sql->execute();
        $sql->closeCursor();


        $sql2=$this->db->prepare("UPDATE `SUIVRE` SET `INSCRIPTION`=1 WHERE `MATRICULE`=:matricule");
        $sql2->bindValue(":matricule",$matricule,PDO::PARAM_STR);
        $sql2->execute();
        $sql2->closeCursor();

    }
    
    public function ValiderRepechage($idetudiant,$idmobilemoney){
        $sql=$this->db->prepare("UPDATE `MOBILEMONEY` SET `ETAT`='lu',`DECISION`='valide' WHERE `IDMOBILEMONEY`=:idmobilemoney");
        $sql->bindValue(":idmobilemoney",$idmobilemoney,PDO::PARAM_INT);
        $sql->execute();
        $sql->closeCursor();

        $sql=$this->db->prepare("DELETE FROM `REPECHER` WHERE `IDETUDIANTS`=:id");
        $sql->bindValue(":id",$idetudiant,PDO::PARAM_INT);
        $sql->execute();
    }


    public function ValiderDroitExamen($matricule,$idmobilemoney){
        $sql=$this->db->prepare("UPDATE `MOBILEMONEY` SET `ETAT`='lu',`DECISION`='valide' WHERE `IDMOBILEMONEY`=:idmobilemoney");
        $sql->bindValue(":idmobilemoney",$idmobilemoney,PDO::PARAM_INT);
        $sql->execute();
        $sql->closeCursor();

        $sql2=$this->db->prepare("UPDATE `SUIVRE` SET `EXAMEN`=1 WHERE `MATRICULE`=:matricule");
        $sql2->bindValue(":matricule",$matricule,PDO::PARAM_STR);
        $sql2->execute();
        $sql2->closeCursor();
       

    }


    public function ValiderSoutenance($matricule,$idmobilemoney){
        $sql=$this->db->prepare("UPDATE `MOBILEMONEY` SET `ETAT`='lu',`DECISION`='valide' WHERE `IDMOBILEMONEY`=:idmobilemoney");
        $sql->bindValue(":idmobilemoney",$idmobilemoney,PDO::PARAM_INT);
        $sql->execute();
        $sql->closeCursor();

        $sql2=$this->db->prepare("UPDATE `SUIVRE` SET `SOUTENANCE`=1 WHERE `MATRICULE`=:matricule");
        $sql2->bindValue(":matricule",$matricule,PDO::PARAM_STR);
        $sql2->execute();
        $sql2->closeCursor();
       

    }
    public function ValiderCertificat($matricule,$idmobilemoney){
        $sql=$this->db->prepare("UPDATE `MOBILEMONEY` SET `ETAT`='lu',`DECISION`='valide' WHERE `IDMOBILEMONEY`=:idmobilemoney");
        $sql->bindValue(":idmobilemoney",$idmobilemoney,PDO::PARAM_INT);
        $sql->execute();
        $sql->closeCursor();

        $sql2=$this->db->prepare("UPDATE `SUIVRE` SET `CERTIFICAT`=`CERTIFICAT`+1 WHERE `MATRICULE`=:matricule");
        $sql2->bindValue(":matricule",$matricule,PDO::PARAM_STR);
        $sql2->execute();
        $sql2->closeCursor();
    }
    public function RefuserMoney($idmobilemoney){
        $sql=$this->db->prepare("DELETE FROM `MOBILEMONEY` WHERE `MOBILEMONEY`.`IDMOBILEMONEY` =:idmobilemoney");
        $sql->bindValue(":idmobilemoney",$idmobilemoney,PDO::PARAM_INT);
        $sql->execute();
    }
    
}
?>