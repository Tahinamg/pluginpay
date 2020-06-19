<?php
class ComptableManagerCheque{
protected $db;

    public function __construct($db)
    {
        $this->setDb($db);
    }
    public function setDb(PDO $db){
        $this->db=$db;
    }



    public function VoirCheque(){
        $sql=$this->db->query("SELECT `MATRICULE`,`NOM`,`PRENOM`,`ETUDIANTS`.`IDETUDIANTS`,`MOTIF`,`SEMESTRE`,`CHEQUE`.`MONTANT`,`IDCHEQUE`,`ETAT`,`DECISION`,`TIREUR`,`ETABLISSEMENT`,`NCHEQUE`,`DATESERVER` FROM `CHEQUE` NATURAL JOIN `SUIVRE`,`ETUDIANTS` WHERE `ETUDIANTS`.`IDETUDIANTS`=`CHEQUE`.`IDETUDIANTS` AND `CHEQUE`.`ETAT`='non lu' ORDER BY `IDCHEQUE` ASC");
        return $sql->fetchAll(PDO::FETCH_ASSOC);
        $sql->closeCursor();

    }
    public function NotifCheque(){
        $sql=$this->db->query("SELECT COUNT(*) FROM `CHEQUE` WHERE `ETAT`='non lu' ");
        return $sql->fetch();
        $sql->closeCursor();
    }
    public function ValiderEcolageViaCheque($qte,$matricule,$idCheque){
        $sql1=$this->db->prepare("UPDATE `CHEQUE` SET `ETAT`='lu',`DECISION`='valide' WHERE `IDCHEQUE`=:idCheque");
        $sql1->bindValue(":idCheque",$idCheque,PDO::PARAM_INT);
        $sql1->execute();
        $sql1->closeCursor();
        $sql2=$this->db->prepare("UPDATE `SUIVRE` SET `ECOLAGE`=`ECOLAGE`+:qte WHERE `MATRICULE`=:matricule");
        $sql2->bindValue(":qte",$qte,PDO::PARAM_INT);
        $sql2->bindValue(":matricule",$matricule,PDO::PARAM_STR);
        $sql2->execute();
        $sql2->closeCursor();

    }

    Public function ValiderInscriptionViaCheque($matricule,$idCheque){
        $sql=$this->db->prepare("UPDATE `CHEQUE` SET `ETAT`='lu',`DECISION`='valide' WHERE `IDCHEQUE`=:idCheque");
        $sql->bindValue(":idCheque",$idCheque,PDO::PARAM_INT);
        $sql->execute();
        $sql->closeCursor();


        $sql2=$this->db->prepare("UPDATE `SUIVRE` SET `INSCRIPTION`=1 WHERE `MATRICULE`=:matricule");
        $sql2->bindValue(":matricule",$matricule,PDO::PARAM_STR);
        $sql2->execute();
        $sql2->closeCursor();

    }
    
    public function ValiderRepechageViaCheque($idetudiant,$idCheque){
        $sql=$this->db->prepare("UPDATE `CHEQUE` SET `ETAT`='lu',`DECISION`='valide' WHERE `IDCHEQUE`=:idCheque");
        $sql->bindValue(":idCheque",$idCheque,PDO::PARAM_INT);
        $sql->execute();
        $sql->closeCursor();

        $sql=$this->db->prepare("DELETE FROM `REPECHER` WHERE `IDETUDIANTS`=:id");
        $sql->bindValue(":id",$idetudiant,PDO::PARAM_INT);
        $sql->execute();
    }
    public function ValiderDroitExamenViaCheque($matricule,$idCheque){
        $sql=$this->db->prepare("UPDATE `CHEQUE` SET `ETAT`='lu',`DECISION`='valide' WHERE `IDCHEQUE`=:idCheque");
        $sql->bindValue(":idCheque",$idCheque,PDO::PARAM_INT);
        $sql->execute();
        $sql->closeCursor();

        $sql2=$this->db->prepare("UPDATE `SUIVRE` SET `EXAMEN`=1 WHERE `MATRICULE`=:matricule");
        $sql2->bindValue(":matricule",$matricule,PDO::PARAM_STR);
        $sql2->execute();
        $sql2->closeCursor();
       

    }


    public function ValiderSoutenanceViaCheque($matricule,$idCheque){
        $sql=$this->db->prepare("UPDATE `CHEQUE` SET `ETAT`='lu',`DECISION`='valide' WHERE `IDCHEQUE`=:idCheque");
        $sql->bindValue(":idCheque",$idCheque,PDO::PARAM_INT);
        $sql->execute();
        $sql->closeCursor();

        $sql2=$this->db->prepare("UPDATE `SUIVRE` SET `SOUTENANCE`=1 WHERE `MATRICULE`=:matricule");
        $sql2->bindValue(":matricule",$matricule,PDO::PARAM_STR);
        $sql2->execute();
        $sql2->closeCursor();
       

    }


    public function ValiderCertificat($matricule,$idCheque){
        $sql=$this->db->prepare("UPDATE `CHEQUE` SET `ETAT`='lu',`DECISION`='valide' WHERE `IDCHEQUE`=:idCheque");
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
    }
    
}
?>