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
        $sql=$this->db->query("SELECT `SUIVRE`.`MATRICULE`,`ETUDIANTS`.`NOM`,`ETUDIANTS`.`PRENOM`,`ETUDIANTS`.`IDETUDIANTS`,`MOTIF`,`SEMESTRE`,`MOBILEMONEY`.`REFERENCE`,`DATY`,`MOBILEMONEY`.`MONTANT`,`IDMOBILEMONEY`,`MOBILEMONEY`.`ETAT`,`MOBILEMONEY`.`DECISION`,`DATESERVER`,`OBSERVATION`,`DATEVALIDATION`,`TEMPSVALIDATION` FROM `MOBILEMONEY` NATURAL JOIN `SUIVRE`,`ETUDIANTS` WHERE `ETUDIANTS`.`IDETUDIANTS`=`MOBILEMONEY`.`IDETUDIANTS` AND `MOBILEMONEY`.`ETAT`='non lu' ORDER BY `IDMOBILEMONEY` ASC ");
        $data=$sql->fetchAll(PDO::FETCH_ASSOC);
        $sql->closeCursor();
        return $data;

    }
    public function NotifMobileMoney(){
        $sql=$this->db->query("SELECT COUNT(*) FROM `MOBILEMONEY` WHERE `ETAT`='non lu' AND IDETUDIANTS!=0");
        $data=$sql->fetch();
        $sql->closeCursor();
        return $data;
    }
    public function ValiderEcolageViaMobileMoney($qte,$matricule,$idmobilemoney,$observation){
        $sql1=$this->db->prepare("UPDATE `MOBILEMONEY` SET `ETAT`='lu',`DECISION`='valide',`OBSERVATION`=:observation,`DATEVALIDATION`=CURRENT_DATE,`TEMPSVALIDATION`=CURRENT_TIME WHERE `IDMOBILEMONEY`=:idmobilemoney");
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
        $sql=$this->db->prepare(" UPDATE `MOBILEMONEY` SET `ETAT`='lu',`DECISION`='valide',`OBSERVATION`=:observation,`TEMPSVALIDATION`=CURRENT_TIME,`DATEVALIDATION`=CURRENT_DATE  WHERE `IDMOBILEMONEY`=:idmobilemoney");
        $sql->execute(array(":observation"=>$observation,":idmobilemoney"=>$idmobilemoney));
        $sql->closeCursor();


        $sql2=$this->db->prepare("UPDATE `SUIVRE` SET `INSCRIPTION`=1 WHERE `MATRICULE`=:matricule");
        $sql2->bindValue(":matricule",$matricule,PDO::PARAM_STR);
        $sql2->execute();
        $sql2->closeCursor();

    }
    
    public function ValiderRepechage($idetudiant,$idmobilemoney,$observation){
        $sql=$this->db->prepare("UPDATE `MOBILEMONEY` SET `ETAT`='lu',`DECISION`='valide',`OBSERVATION`=:observation,`DATEVALIDATION`=CURRENT_DATE,`TEMPSVALIDATION`=CURRENT_TIME WHERE `IDMOBILEMONEY`=:idmobilemoney");
        $sql->bindValue(":observation",$observation,PDO::PARAM_STR);
        $sql->bindValue(":idmobilemoney",$idmobilemoney,PDO::PARAM_INT);
        $sql->execute();
        $sql->closeCursor();

        $sql=$this->db->prepare("DELETE FROM `REPECHER` WHERE `IDETUDIANTS`=:id");
        $sql->bindValue(":id",$idetudiant,PDO::PARAM_INT);
        $sql->execute();
        $sql->closeCursor();
    }


    public function ValiderDroitExamen($matricule,$idmobilemoney,$observation){
        $sql=$this->db->prepare("UPDATE `MOBILEMONEY` SET `ETAT`='lu',`DECISION`='valide',`OBSERVATION`=:observation,`DATEVALIDATION`=CURRENT_DATE,`TEMPSVALIDATION`=CURRENT_TIME WHERE `IDMOBILEMONEY`=:idmobilemoney");
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
        $sql=$this->db->prepare("UPDATE `MOBILEMONEY` SET `ETAT`='lu',`DECISION`='valide',`OBSERVATION`=:observation,`DATEVALIDATION`=CURRENT_DATE,`TEMPSVALIDATION`=CURRENT_TIME WHERE `IDMOBILEMONEY`=:idmobilemoney");
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
        $sql=$this->db->prepare("UPDATE `MOBILEMONEY` SET `ETAT`='lu',`DECISION`='valide',`OBSERVATION`=:observation,`DATEVALIDATION`=CURRENT_DATE,`TEMPSVALIDATION`=CURRENT_TIME WHERE `IDMOBILEMONEY`=:idmobilemoney");
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
        $sql->closeCursor();
    }
    
    public function ListReferenceIdZero(){
        $sql=$this->db->query("SELECT `REFERENCE` FROM `MOBILEMONEY` WHERE `MOBILEMONEY`.`IDETUDIANTS`=0 ORDER BY `IDMOBILEMONEY` ASC ");
        $data=$sql->fetchAll(PDO::FETCH_ASSOC);
        $sql->closeCursor();
        return $data;
       
    }
    public function ListPaiementMobileMoneyByReferenceOrderByDateValidation($reference){
        $sql=$this->db->prepare("SELECT `SUIVRE`.`MATRICULE`,`ETUDIANTS`.`NOM`,`ETUDIANTS`.`PRENOM`,`ETUDIANTS`.`IDETUDIANTS`,`MOTIF`,`SEMESTRE`,`MOBILEMONEY`.`REFERENCE`,`DATY`,`MOBILEMONEY`.`MONTANT`,`IDMOBILEMONEY`,`MOBILEMONEY`.`ETAT`,`MOBILEMONEY`.`DECISION`,`DATESERVER`,`OBSERVATION`,`DATEVALIDATION`,`TEMPSVALIDATION` FROM `MOBILEMONEY` NATURAL JOIN `SUIVRE`,`ETUDIANTS` WHERE `REFERENCE`=:reference ORDER BY `DATEVALIDATION` ASC");
        $sql->bindValue(":reference",$reference,PDO::PARAM_STR);
        $sql->execute();
        $data=$sql->fetchAll();
        $sql->closeCursor();
        return $data;
    }
    

}
?>