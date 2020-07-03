<?php
class ComptableManagerMoneyGram{
    //UPLOAD
    protected $db;
    public function __construct(PDO $database)
    {
        $this->setDb($database);
    }
    public function setDb(PDO $database){
        $this->db=$database;
    }
    public function voirMoneyGram(){
       
       $sql=$this->db->query("SELECT `SUIVRE`.`MATRICULE`,`ETUDIANTS`.`NOM`,`ETUDIANTS`.`PRENOM`,`ETUDIANTS`.`IDETUDIANTS`,`SUIVRE`.`SEMESTRE`,`IDMONEYGRAM`,`DATYMONEYGRAM`,`REFERENCE`,`EXPEDITEUR`,`DATESERVER`,`OBSERVATION`,`MOTIF`,`DECISION`,`ETAT`,`MONTANT`,`MONTANTMONEYGRAM` FROM `SUIVRE` NATURAL JOIN `MONEYGRAM` NATURAL JOIN `ETUDIANTS` WHERE `MONEYGRAM`.`IDETUDIANTS`=`SUIVRE`.`IDETUDIANTS` AND `MONEYGRAM`.`ETAT`='non lu' ORDER BY `IDMONEYGRAM` ASC");
       $sql->execute();
       $data=$sql->fetchAll(PDO::FETCH_ASSOC);
       return $data;

    
    }
    public function notifMoneyGram(){
        $sql=$this->db->query("SELECT COUNT(*) FROM `MONEYGRAM` WHERE `ETAT`='non lu' ");
        return $sql->fetch();
        $sql->closeCursor();
    }
    public function ValiderEcolageViaMoneyGram($qte,$matricule,$idmoneygram,$observation){
        $sql1=$this->db->prepare("UPDATE `MONEYGRAM` SET `ETAT`='lu',`DECISION`='valide',`OBSERVATION`=:observation WHERE `IDMONEYGRAM`=:idmoneygram");
        $sql1->bindValue(":observation",$observation,PDO::PARAM_STR);
        $sql1->bindValue(":idmoneygram",$idmoneygram,PDO::PARAM_INT);
        $sql1->execute();
        $sql1->closeCursor();
        $sql2=$this->db->prepare("UPDATE `SUIVRE` SET `ECOLAGE`=`ECOLAGE`+:qte WHERE `MATRICULE`=:matricule");
        $sql2->bindValue(":qte",$qte,PDO::PARAM_INT);
        $sql2->bindValue(":matricule",$matricule,PDO::PARAM_STR);
        $sql2->execute();
        $sql2->closeCursor();

    }

    Public function ValiderInscriptionViaMoneyGram($matricule,$idmoneygram,$observation){
        $sql=$this->db->prepare("UPDATE `MONEYGRAM` SET `ETAT`='lu',`DECISION`='valide',`OBSERVATION`=:observation WHERE `IDMONEYGRAM`=:idmoneygram");
        $sql->bindValue(":observation",$observation,PDO::PARAM_STR);
        $sql->bindValue(":idmoneygram",$idmoneygram,PDO::PARAM_INT);
        $sql->execute();
        $sql->closeCursor();


        $sql2=$this->db->prepare("UPDATE `SUIVRE` SET `INSCRIPTION`=1 WHERE `MATRICULE`=:matricule");
        $sql2->bindValue(":matricule",$matricule,PDO::PARAM_STR);
        $sql2->execute();
        $sql2->closeCursor();

    }

    public function ValiderRepechageViaMoneyGram($idetudiant,$idmoneygram,$observation){
        $sql=$this->db->prepare("UPDATE `MONEYGRAM` SET `ETAT`='lu',`DECISION`='valide',`OBSERVATION`=:observation WHERE `IDMONEYGRAM`=:idmoneygram");
        $sql->bindValue(":observation",$observation,PDO::PARAM_STR);
        $sql->bindValue(":idmoneygram",$idmoneygram,PDO::PARAM_INT);
        $sql->execute();
        $sql->closeCursor();

        $sql=$this->db->prepare("DELETE FROM `REPECHER` WHERE `IDETUDIANTS`=:id");
        $sql->bindValue(":id",$idetudiant,PDO::PARAM_INT);
        $sql->execute();
    }
    public function ValiderDroitExamenViaMoneyGram($matricule,$idmoneygram,$observation){
        $sql=$this->db->prepare("UPDATE `MONEYGRAM` SET `ETAT`='lu',`DECISION`='valide',`OBSERVATION`=:observation WHERE `IDMONEYGRAM`=:idmoneygram");
        $sql->bindValue(":observation",$observation,PDO::PARAM_STR);
        $sql->bindValue(":idmoneygram",$idmoneygram,PDO::PARAM_INT);
        $sql->execute();
        $sql->closeCursor();

        $sql2=$this->db->prepare("UPDATE `SUIVRE` SET `EXAMEN`=1 WHERE `MATRICULE`=:matricule");
        $sql2->bindValue(":matricule",$matricule,PDO::PARAM_STR);
        $sql2->execute();
        $sql2->closeCursor();
       

    }


    public function ValiderSoutenanceViaMoneyGram($matricule,$idmoneygram,$observation){
        $sql=$this->db->prepare("UPDATE `MONEYGRAM` SET `ETAT`='lu',`DECISION`='valide',`OBSERVATION`=:observation WHERE `IDMONEYGRAM`=:idmoneygram");
        $sql->bindValue(":observation",$observation,PDO::PARAM_STR);
        $sql->bindValue(":idmoneygram",$idmoneygram,PDO::PARAM_INT);
        $sql->execute();
        $sql->closeCursor();

        $sql2=$this->db->prepare("UPDATE `SUIVRE` SET `SOUTENANCE`=1 WHERE `MATRICULE`=:matricule");
        $sql2->bindValue(":matricule",$matricule,PDO::PARAM_STR);
        $sql2->execute();
        $sql2->closeCursor();
       

    }

    public function ValiderCertificat($matricule,$idmoneygram,$observation){
        $sql=$this->db->prepare("UPDATE `MONEYGRAM` SET `ETAT`='lu',`DECISION`='valide',`OBSERVATION`=:observation WHERE `IDMONEYGRAM`=:idmoneygram");
        $sql->bindValue(":observation",$observation,PDO::PARAM_STR);
        $sql->bindValue(":idmoneygram",$idmoneygram,PDO::PARAM_INT);
        $sql->execute();
        $sql->closeCursor();

        $sql2=$this->db->prepare("UPDATE `SUIVRE` SET `CERTIFICAT`=`CERTIFICAT`+1 WHERE `MATRICULE`=:matricule");
        $sql2->bindValue(":matricule",$matricule,PDO::PARAM_STR);
        $sql2->execute();
        $sql2->closeCursor();
    }


    public function RefuserMoneyGram($idmoneygram){
        $sql=$this->db->prepare("DELETE FROM `MONEYGRAM` WHERE `MONEYGRAM`.`IDMONEYGRAM` =:idmoneygram");
        $sql->bindValue(":idmoneygram",$idmoneygram,PDO::PARAM_INT);
        $sql->execute();
    }
    
    public function ListPaiementMoneyGram($date,$motif,$vague){
        $sql=$this->db->prepare("SELECT `IDMONEYGRAM`,`SUIVRE`.`MATRICULE`,`CODE`,`NOM`,`PRENOM`,`NUMERO`,`DATYMONEYGRAM`,`REFERENCE`,`EXPEDITEUR`,`MONTANTMONEYGRAM`,`MOTIF`,`DATESERVER`,`MONTANT`,`OBSERVATION` FROM `SUIVRE` NATURAL JOIN `ETUDIANTS` NATURAL JOIN `MONEYGRAM` WHERE `SUIVRE`.`IDETUDIANTS`=`MONEYGRAM`.`IDETUDIANTS` AND `MONEYGRAM`.`DATESERVER` LIKE :datevalidation AND `CODE`=:vague AND `MONEYGRAM`.`ETAT`='lu' AND `MONEYGRAM`.`DECISION`='valide' AND `MOTIF`=:motif ORDER BY DATESERVER ASC");
        $date.="%";
        $sql->bindValue(":datevalidation",$date,PDO::PARAM_STR);
        $sql->bindValue(":vague",$vague,PDO::PARAM_STR);
        $sql->bindValue(":motif",$motif,PDO::PARAM_STR);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

}
?>