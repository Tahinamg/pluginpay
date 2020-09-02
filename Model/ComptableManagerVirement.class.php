<?php
class ComptableManagerVirement{
protected $db;

    public function __construct($db)
    {
        $this->setDb($db);
    }
    public function setDb(PDO $db){
        $this->db=$db;
    }



    public function VoirVirement(){
        $sql=$this->db->query("SELECT `MATRICULE`,`NOM`,`PRENOM`,`ETUDIANTS`.`IDETUDIANTS`,`MOTIF`,`SEMESTRE`,`VIREMENT`.`MONTANT`,`DATEVIREMENT`,`IDVIREMENT`,`ETAT`,`DECISION`,`DATESERVER`,`TITUCOMPTE`,`NCOMPTE`,`OBSERVATION` FROM `VIREMENT` NATURAL JOIN `SUIVRE`,`ETUDIANTS` WHERE `ETUDIANTS`.`IDETUDIANTS`=`VIREMENT`.`IDETUDIANTS` AND `VIREMENT`.`ETAT`='non lu' ORDER BY `IDVIREMENT` ASC");
        $data=$sql->fetchAll(PDO::FETCH_ASSOC);
        $sql->closeCursor();
        return $data;

    }
    public function NotifVirement(){
        $sql=$this->db->query("SELECT COUNT(*) FROM `VIREMENT` WHERE `ETAT`='non lu' ");
        $data=$sql->fetch();
        $sql->closeCursor();
        return $data;
    }
    public function ValiderEcolageViaVirement($qte,$matricule,$idvirement,$observation){
        $sql1=$this->db->prepare("UPDATE `VIREMENT` SET `ETAT`='lu',`DECISION`='valide',`OBSERVATION`=:observation WHERE `IDVIREMENT`=:idvirement");
        $sql1->bindValue(":observation",$observation,PDO::PARAM_STR);
        $sql1->bindValue(":idvirement",$idvirement,PDO::PARAM_INT);
        $sql1->execute();
        $sql1->closeCursor();

        $sql2=$this->db->prepare("UPDATE `SUIVRE` SET `ECOLAGE`=`ECOLAGE`+:qte WHERE `MATRICULE`=:matricule");
        $sql2->bindValue(":qte",$qte,PDO::PARAM_INT);
        $sql2->bindValue(":matricule",$matricule,PDO::PARAM_STR);
        $sql2->execute();
        $sql2->closeCursor();

    }

    Public function ValiderInscriptionViaVirement($matricule,$idvirement,$observation){
        $sql=$this->db->prepare("UPDATE `VIREMENT` SET `ETAT`='lu',`DECISION`='valide',`OBSERVATION`=:observation WHERE `IDVIREMENT`=:idvirement");
        $sql->bindValue(":observation",$observation,PDO::PARAM_STR);
        $sql->bindValue(":idvirement",$idvirement,PDO::PARAM_INT);
        $sql->execute();
        $sql->closeCursor();


        $sql2=$this->db->prepare("UPDATE `SUIVRE` SET `INSCRIPTION`=1 WHERE `MATRICULE`=:matricule");
        $sql2->bindValue(":matricule",$matricule,PDO::PARAM_STR);
        $sql2->execute();
        $sql2->closeCursor();

    }
    
    public function ValiderRepechageViaVirement($idetudiant,$idvirement,$observation){
        $sql=$this->db->prepare("UPDATE `VIREMENT` SET `ETAT`='lu',`DECISION`='valide',`OBSERVATION`=:observation WHERE `IDVIREMENT`=:idvirement");
        $sql->bindValue(":observation",$observation,PDO::PARAM_STR);
        $sql->bindValue(":idvirement",$idvirement,PDO::PARAM_INT);
        $sql->execute();
        $sql->closeCursor();

        $sql=$this->db->prepare("DELETE FROM `REPECHER` WHERE `IDETUDIANTS`=:id");
        $sql->bindValue(":id",$idetudiant,PDO::PARAM_INT);
        $sql->execute();
        $sql->closeCursor();
    }
    public function ValiderDroitExamenViaVirement($matricule,$idvirement,$observation){
        $sql=$this->db->prepare("UPDATE `VIREMENT` SET `ETAT`='lu',`DECISION`='valide',`OBSERVATION`=:observation WHERE `IDVIREMENT`=:idvirement");
        $sql->bindValue(":observation",$observation,PDO::PARAM_STR);
        $sql->bindValue(":idvirement",$idvirement,PDO::PARAM_INT);
        $sql->execute();
        $sql->closeCursor();

        $sql2=$this->db->prepare("UPDATE `SUIVRE` SET `EXAMEN`=1 WHERE `MATRICULE`=:matricule");
        $sql2->bindValue(":matricule",$matricule,PDO::PARAM_STR);
        $sql2->execute();
        $sql2->closeCursor();
       

    }


    public function ValiderSoutenanceViaVirement($matricule,$idvirement,$observation){
        $sql=$this->db->prepare("UPDATE `VIREMENT` SET `ETAT`='lu',`DECISION`='valide',`OBSERVATION`=:observation WHERE `IDVIREMENT`=:idvirement");
        $sql->bindValue(":observation",$observation,PDO::PARAM_STR);
        $sql->bindValue(":idvirement",$idvirement,PDO::PARAM_INT);
        $sql->execute();
        $sql->closeCursor();

        $sql2=$this->db->prepare("UPDATE `SUIVRE` SET `SOUTENANCE`=1 WHERE `MATRICULE`=:matricule");
        $sql2->bindValue(":matricule",$matricule,PDO::PARAM_STR);
        $sql2->execute();
        $sql2->closeCursor();
       

    }
    public function ValiderCertificat($matricule,$idvirement,$observation){
        $sql=$this->db->prepare("UPDATE `VIREMENT` SET `ETAT`='lu',`DECISION`='valide',`OBSERVATION`=:observation WHERE `IDVIREMENT`=:idvirement");
        $sql->bindValue(":observation",$observation,PDO::PARAM_STR);
        $sql->bindValue(":idvirement",$idvirement,PDO::PARAM_INT);
        $sql->execute();
        $sql->closeCursor();

        $sql2=$this->db->prepare("UPDATE `SUIVRE` SET `CERTIFICAT`=`CERTIFICAT`+1 WHERE `MATRICULE`=:matricule");
        $sql2->bindValue(":matricule",$matricule,PDO::PARAM_STR);
        $sql2->execute();
        $sql2->closeCursor();
       

    }
    public function RefuserVirement($idvirement){
        $sql=$this->db->prepare("DELETE FROM `VIREMENT` WHERE `VIREMENT`.`IDVIREMENT` =:idvirement");
        $sql->bindValue(":idvirement",$idvirement,PDO::PARAM_INT);
        $sql->execute();
        $sql->closeCursor();
    }

    public function ListPaiementVirement($date,$motif,$vague){
        $sql=$this->db->prepare("SELECT `IDVIREMENT`,`SUIVRE`.`MATRICULE`,`CODE`,`NOM`,`PRENOM`,`NUMERO`,`TITUCOMPTE`,`NCOMPTE`,`DATEVIREMENT`,`MOTIF`,`DATESERVER`,`MONTANT`,`OBSERVATION` FROM `SUIVRE` NATURAL JOIN `ETUDIANTS` NATURAL JOIN `VIREMENT` WHERE `SUIVRE`.`IDETUDIANTS`=`VIREMENT`.`IDETUDIANTS` AND `VIREMENT`.`DATESERVER` LIKE :datevalidation AND `CODE`=:vague AND `VIREMENT`.`ETAT`='lu' AND `VIREMENT`.`DECISION`='valide' AND `MOTIF`=:motif ORDER BY DATESERVER ASC");
        $date.="%";
        $sql->bindValue(":datevalidation",$date,PDO::PARAM_STR);
        $sql->bindValue(":vague",$vague,PDO::PARAM_STR);
        $sql->bindValue(":motif",$motif,PDO::PARAM_STR);
        $sql->execute();
        $data=$sql->fetchAll(PDO::FETCH_ASSOC);
        $sql->closeCursor();
        return $data;
    }
    
}
?>