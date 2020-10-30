<?php
class ComptableManagerCheque{
protected $db;
    //UPLOAD
    public function __construct($db)
    {
        $this->setDb($db);
    }
    public function setDb(PDO $db){
        $this->db=$db;
    }



    public function VoirCheque(){
        $sql=$this->db->query("SELECT `MATRICULE`,`NOM`,`PRENOM`,`ETUDIANTS`.`IDETUDIANTS`,`MOTIF`,`SEMESTRE`,`CHEQUE`.`MONTANT`,`IDCHEQUE`,`ETAT`,`DECISION`,`TIREUR`,`ETABLISSEMENT`,`NCHEQUE`,`DATESERVER`,`OBSERVATION`,`DATEVALIDATION`,`TEMPSVALIDATION` FROM `CHEQUE` NATURAL JOIN `SUIVRE`,`ETUDIANTS` WHERE `ETUDIANTS`.`IDETUDIANTS`=`CHEQUE`.`IDETUDIANTS` AND `CHEQUE`.`ETAT`='non lu' ORDER BY `IDCHEQUE` ASC");
         $data=$sql->fetchAll(PDO::FETCH_ASSOC);
        $sql->closeCursor();
        return $data;
        

    }
    public function NotifCheque(){
        $sql=$this->db->query("SELECT COUNT(*) FROM `CHEQUE` WHERE `ETAT`='non lu' AND IDETUDIANTS!=0 ");
        $data=$sql->fetch();
        $sql->closeCursor();
        return $data;
    }
    public function ValiderEcolageViaCheque($qte,$matricule,$idCheque,$observation){
        $sql1=$this->db->prepare("UPDATE `CHEQUE` SET `ETAT`='lu',`DECISION`='valide',`OBSERVATION`=:observation,`DATEVALIDATION`=CURRENT_DATE,`TEMPSVALIDATION`=CURRENT_TIME WHERE `IDCHEQUE`=:idCheque");
        $sql1->bindValue(":observation",$observation,PDO::PARAM_STR);
        $sql1->bindValue(":idCheque",$idCheque,PDO::PARAM_INT);
        $sql1->execute();
        $sql1->closeCursor();
        $sql2=$this->db->prepare("UPDATE `SUIVRE` SET `ECOLAGE`=`ECOLAGE`+:qte WHERE `MATRICULE`=:matricule");
        $sql2->bindValue(":qte",$qte,PDO::PARAM_INT);
        $sql2->bindValue(":matricule",$matricule,PDO::PARAM_STR);
        $sql2->execute();
        $sql2->closeCursor();

    }

    Public function ValiderInscriptionViaCheque($matricule,$idCheque,$observation){
        $sql=$this->db->prepare("UPDATE `CHEQUE` SET `ETAT`='lu',`DECISION`='valide',`OBSERVATION`=:observation,`DATEVALIDATION`=CURRENT_DATE,`TEMPSVALIDATION`=CURRENT_TIME WHERE `IDCHEQUE`=:idCheque");
        $sql->bindValue(":observation",$observation,PDO::PARAM_STR);
        $sql->bindValue(":idCheque",$idCheque,PDO::PARAM_INT);
        $sql->execute();
        $sql->closeCursor();


        $sql2=$this->db->prepare("UPDATE `SUIVRE` SET `INSCRIPTION`=1 WHERE `MATRICULE`=:matricule");
        $sql2->bindValue(":matricule",$matricule,PDO::PARAM_STR);
        $sql2->execute();
        $sql2->closeCursor();

    }
    
    public function ValiderRepechageViaCheque($idetudiant,$idCheque,$observation){
        $sql=$this->db->prepare("UPDATE `CHEQUE` SET `ETAT`='lu',`DECISION`='valide',`OBSERVATION`=:observation,`DATEVALIDATION`=CURRENT_DATE,`TEMPSVALIDATION`=CURRENT_TIME WHERE `IDCHEQUE`=:idCheque");
        $sql->bindValue(":observation",$observation,PDO::PARAM_STR);
        $sql->bindValue(":idCheque",$idCheque,PDO::PARAM_INT);
        $sql->execute();
        $sql->closeCursor();

        $sql=$this->db->prepare("DELETE FROM `REPECHER` WHERE `IDETUDIANTS`=:id");
        $sql->bindValue(":id",$idetudiant,PDO::PARAM_INT);
        $sql->execute();
        $sql->closeCursor();
    }
    public function ValiderDroitExamenViaCheque($matricule,$idCheque,$observation){
        $sql=$this->db->prepare("UPDATE `CHEQUE` SET `ETAT`='lu',`DECISION`='valide',`OBSERVATION`=:observation,`DATEVALIDATION`=CURRENT_DATE,`TEMPSVALIDATION`=CURRENT_TIME WHERE `IDCHEQUE`=:idCheque");
        $sql->bindValue(":observation",$observation,PDO::PARAM_STR);
        $sql->bindValue(":idCheque",$idCheque,PDO::PARAM_INT);
        $sql->execute();
        $sql->closeCursor();

        $sql2=$this->db->prepare("UPDATE `SUIVRE` SET `EXAMEN`=1 WHERE `MATRICULE`=:matricule");
        $sql2->bindValue(":matricule",$matricule,PDO::PARAM_STR);
        $sql2->execute();
        $sql2->closeCursor();
       

    }


    public function ValiderSoutenanceViaCheque($matricule,$idCheque,$observation){
        $sql=$this->db->prepare("UPDATE `CHEQUE` SET `ETAT`='lu',`DECISION`='valide',`OBSERVATION`=:observation,`DATEVALIDATION`=CURRENT_DATE,`TEMPSVALIDATION`=CURRENT_TIME WHERE `IDCHEQUE`=:idCheque");
        $sql->bindValue(":observation",$observation,PDO::PARAM_STR);
        $sql->bindValue(":idCheque",$idCheque,PDO::PARAM_INT);
        $sql->execute();
        $sql->closeCursor();

        $sql2=$this->db->prepare("UPDATE `SUIVRE` SET `SOUTENANCE`=1 WHERE `MATRICULE`=:matricule");
        $sql2->bindValue(":matricule",$matricule,PDO::PARAM_STR);
        $sql2->execute();
        $sql2->closeCursor();
       

    }


    public function ValiderCertificat($matricule,$idCheque,$observation){
        $sql=$this->db->prepare("UPDATE `CHEQUE` SET `ETAT`='lu',`DECISION`='valide',`OBSERVATION`=:observation,`DATEVALIDATION`=CURRENT_DATE,`TEMPSVALIDATION`=CURRENT_TIME WHERE `IDCHEQUE`=:idCheque");
        $sql->bindValue(":observation",$observation,PDO::PARAM_STR);
        $sql->bindValue(":idCheque",$idCheque,PDO::PARAM_INT);
        $sql->execute();
        $sql->closeCursor();

        $sql2=$this->db->prepare("UPDATE `SUIVRE` SET `CERTIFICAT`=`CERTIFICAT`+1 WHERE `MATRICULE`=:matricule");
        $sql2->bindValue(":matricule",$matricule,PDO::PARAM_STR);
        $sql2->execute();
        $sql2->closeCursor();
       

    }
    public function RefuserCheque($idCheque){
        $sql=$this->db->prepare("DELETE FROM `CHEQUE` WHERE `CHEQUE`.`IDCHEQUE`=:idcheque");
        $sql->bindValue(":idcheque",$idCheque,PDO::PARAM_INT);
        $sql->execute();
        $sql->closeCursor();
    }

    
}
?>