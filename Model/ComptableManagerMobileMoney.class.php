<?php
class ComptableManagerMobileMoney{
    //UPLOAD
protected $db;

    public function __construct($db)
    {
        $this->setDb($db);
    }
    public function setDb(PDO $db){
        $this->db=$db;
    }



    public function VoirMobileMoney(){
        $sql=$this->db->query("SELECT `SUIVRE`.`MATRICULE`,`ETUDIANTS`.`NOM`,`ETUDIANTS`.`PRENOM`,`ETUDIANTS`.`IDETUDIANTS`,`MOTIF`,`SEMESTRE`,`MOBILEMONEY`.`REFERENCE`,`DATY`,`MOBILEMONEY`.`MONTANT`,`IDMOBILEMONEY`,`MOBILEMONEY`.`ETAT`,`MOBILEMONEY`.`DECISION`,`DATESERVER`,`OBSERVATION` FROM `MOBILEMONEY` NATURAL JOIN `SUIVRE`,`ETUDIANTS` WHERE `ETUDIANTS`.`IDETUDIANTS`=`MOBILEMONEY`.`IDETUDIANTS` AND `MOBILEMONEY`.`ETAT`='non lu' ORDER BY `IDMOBILEMONEY` ASC ");
        return $sql->fetchAll(PDO::FETCH_ASSOC);
        $sql->closeCursor();

    }
    public function NotifMobileMoney(){
        $sql=$this->db->query("SELECT COUNT(*) FROM `MOBILEMONEY` WHERE `ETAT`='non lu' ");
        return $sql->fetch();
        $sql->closeCursor();
    }
    public function ValiderEcolageViaMobileMoney($qte,$matricule,$idmobilemoney,$observation){
        $sql1=$this->db->prepare("UPDATE `MOBILEMONEY` SET `ETAT`='lu',`DECISION`='valide',`OBSERVATION`=:observation WHERE `IDMOBILEMONEY`=:idmobilemoney");
        $sql1->bindValue(":observation",$observation,PDO::PARAM_STR);
        $sql1->bindValue(":idmobilemoney",$idmobilemoney,PDO::PARAM_INT);
        $sql1->execute();
        $sql1->closeCursor();
        $sql2=$this->db->prepare("UPDATE `SUIVRE` SET `ECOLAGE`=`ECOLAGE`+:qte WHERE `MATRICULE`=:matricule");
        $sql2->bindValue(":qte",$qte,PDO::PARAM_INT);
        $sql2->bindValue(":matricule",$matricule,PDO::PARAM_STR);
        $sql2->execute();
        $sql2->closeCursor();

    }
    Public function ValiderInscriptionViaMobileMoney($matricule,$idmobilemoney,$observation){
        $sql=$this->db->prepare("UPDATE `MOBILEMONEY` SET `ETAT`='lu',`DECISION`='valide',`OBSERVATION`=:observation WHERE `IDMOBILEMONEY`=:idmobilemoney");
        $sql->bindValue(":observation",$observation,PDO::PARAM_STR);
        $sql->bindValue(":idmobilemoney",$idmobilemoney,PDO::PARAM_INT);
        $sql->execute();
        $sql->closeCursor();


        $sql2=$this->db->prepare("UPDATE `SUIVRE` SET `INSCRIPTION`=1 WHERE `MATRICULE`=:matricule");
        $sql2->bindValue(":matricule",$matricule,PDO::PARAM_STR);
        $sql2->execute();
        $sql2->closeCursor();

    }
    
    public function ValiderRepechage($idetudiant,$idmobilemoney,$observation){
        $sql=$this->db->prepare("UPDATE `MOBILEMONEY` SET `ETAT`='lu',`DECISION`='valide',`OBSERVATION`=:observation WHERE `IDMOBILEMONEY`=:idmobilemoney");
        $sql->bindValue(":observation",$observation,PDO::PARAM_STR);
        $sql->bindValue(":idmobilemoney",$idmobilemoney,PDO::PARAM_INT);
        $sql->execute();
        $sql->closeCursor();

        $sql=$this->db->prepare("DELETE FROM `REPECHER` WHERE `IDETUDIANTS`=:id");
        $sql->bindValue(":id",$idetudiant,PDO::PARAM_INT);
        $sql->execute();
    }


    public function ValiderDroitExamen($matricule,$idmobilemoney,$observation){
        $sql=$this->db->prepare("UPDATE `MOBILEMONEY` SET `ETAT`='lu',`DECISION`='valide',`OBSERVATION`=:observation WHERE `IDMOBILEMONEY`=:idmobilemoney");
        $sql->bindValue(":observation",$observation,PDO::PARAM_STR);
        $sql->bindValue(":idmobilemoney",$idmobilemoney,PDO::PARAM_INT);
        $sql->execute();
        $sql->closeCursor();

        $sql2=$this->db->prepare("UPDATE `SUIVRE` SET `EXAMEN`=1 WHERE `MATRICULE`=:matricule");
        $sql2->bindValue(":matricule",$matricule,PDO::PARAM_STR);
        $sql2->execute();
        $sql2->closeCursor();
       

    }


    public function ValiderSoutenance($matricule,$idmobilemoney,$observation){
        $sql=$this->db->prepare("UPDATE `MOBILEMONEY` SET `ETAT`='lu',`DECISION`='valide',`OBSERVATION`=:observation WHERE `IDMOBILEMONEY`=:idmobilemoney");
        $sql->bindValue(":observation",$observation,PDO::PARAM_STR);
        $sql->bindValue(":idmobilemoney",$idmobilemoney,PDO::PARAM_INT);
        $sql->execute();
        $sql->closeCursor();

        $sql2=$this->db->prepare("UPDATE `SUIVRE` SET `SOUTENANCE`=1 WHERE `MATRICULE`=:matricule");
        $sql2->bindValue(":matricule",$matricule,PDO::PARAM_STR);
        $sql2->execute();
        $sql2->closeCursor();
       

    }
    public function ValiderCertificat($matricule,$idmobilemoney,$observation){
        $sql=$this->db->prepare("UPDATE `MOBILEMONEY` SET `ETAT`='lu',`DECISION`='valide',`OBSERVATION`=:observation WHERE `IDMOBILEMONEY`=:idmobilemoney");
        $sql->bindValue(":observation",$observation,PDO::PARAM_STR);
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
    public function ListPaiementMobileMoney($date,$motif,$vague){
        $sql=$this->db->prepare("SELECT `IDMOBILEMONEY`,`SUIVRE`.`MATRICULE`,`CODE`,`NOM`,`PRENOM`,`NUMERO`,`REFERENCE`,`MOTIF`,`DATY`,`DATESERVER`,`MONTANT`,`OBSERVATION` FROM `SUIVRE` NATURAL JOIN `ETUDIANTS` NATURAL JOIN `MOBILEMONEY` WHERE `SUIVRE`.`IDETUDIANTS`=`MOBILEMONEY`.`IDETUDIANTS` AND `MOBILEMONEY`.`DATESERVER` LIKE :datevalidation AND `CODE`=:vague AND `MOBILEMONEY`.`ETAT`='lu' AND `MOBILEMONEY`.`DECISION`='valide' AND `MOTIF`=:motif ORDER BY DATESERVER ASC");
        $date.="%";
        $sql->bindValue(":datevalidation",$date,PDO::PARAM_STR);
        $sql->bindValue(":vague",$vague,PDO::PARAM_STR);
        $sql->bindValue(":motif",$motif,PDO::PARAM_STR);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }


}
?>