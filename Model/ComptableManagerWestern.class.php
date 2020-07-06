<?php
class ComptableManagerWestern{
//UPLOAD
protected $db;

    public function __construct($db)
    {
        $this->setDb($db);
    }
    public function setDb(PDO $db){
        $this->db=$db;
    }



    public function VoirWestern(){
        $sql=$this->db->query("SELECT `MATRICULE`,`NOM`,`PRENOM`,`ETUDIANTS`.`IDETUDIANTS`,`MOTIF`,`SEMESTRE`,`WESTERN`.`MONTANT`,`IDWESTERN`,`ETAT`,`DECISION`,`DATESERVER`,`NSUIVI`,`NOMEXP`,`MONTANTWESTERN`,`OBSERVATION` FROM `WESTERN` NATURAL JOIN `SUIVRE`,`ETUDIANTS` WHERE `ETUDIANTS`.`IDETUDIANTS`=`WESTERN`.`IDETUDIANTS` AND `WESTERN`.`ETAT`='non lu' ORDER BY `IDWESTERN` ASC");
        $data=$sql->fetchAll(PDO::FETCH_ASSOC);
        $sql->closeCursor();
        return $data;

    }
    public function NotifWestern(){
        $sql=$this->db->query("SELECT COUNT(*) FROM `WESTERN` WHERE `ETAT`='non lu'");
        $data=$sql->fetch();
        $sql->closeCursor();
        return $data;
    }
    public function ValiderEcolageViaWestern($qte,$matricule,$idwestern,$observation){
        $sql1=$this->db->prepare("UPDATE `WESTERN` SET `ETAT`='lu',`DECISION`='valide',`OBSERVATION`=:observation WHERE `IDWESTERN`=:idwestern");
        $sql1->bindValue(":observation",$observation,PDO::PARAM_STR);
        $sql1->bindValue(":idwestern",$idwestern,PDO::PARAM_INT);
        $sql1->execute();
        $sql1->closeCursor();

        $sql2=$this->db->prepare("UPDATE `SUIVRE` SET `ECOLAGE`=`ECOLAGE`+:qte WHERE `MATRICULE`=:matricule");
        $sql2->bindValue(":qte",$qte,PDO::PARAM_INT);
        $sql2->bindValue(":matricule",$matricule,PDO::PARAM_STR);
        $sql2->execute();
        $sql2->closeCursor();

    }

    Public function ValiderInscriptionViaWestern($matricule,$idwestern,$observation){
        $sql=$this->db->prepare("UPDATE `WESTERN` SET `ETAT`='lu',`DECISION`='valide',`OBSERVATION`=:observation WHERE `IDWESTERN`=:idwestern");
        $sql->bindValue(":observation",$observation,PDO::PARAM_STR);
        $sql->bindValue(":idwestern",$idwestern,PDO::PARAM_INT);
        $sql->execute();
        $sql->closeCursor();


        $sql2=$this->db->prepare("UPDATE `SUIVRE` SET `INSCRIPTION`=1 WHERE `MATRICULE`=:matricule");
        $sql2->bindValue(":matricule",$matricule,PDO::PARAM_STR);
        $sql2->execute();
        $sql2->closeCursor();

    }
    
    public function ValiderRepechageViaWestern($idetudiant,$idwestern,$observation){
        $sql=$this->db->prepare("UPDATE `WESTERN` SET `ETAT`='lu',`DECISION`='valide',`OBSERVATION`=:observation WHERE `IDWESTERN`=:idwestern");
        $sql->bindValue(":observation",$observation,PDO::PARAM_STR);
        $sql->bindValue(":idwestern",$idwestern,PDO::PARAM_INT);
        $sql->execute();
        $sql->closeCursor();

        $sql=$this->db->prepare("DELETE FROM `REPECHER` WHERE `IDETUDIANTS`=:id");
        $sql->bindValue(":id",$idetudiant,PDO::PARAM_INT);
        $sql->execute();
        $sql->closeCursor();
    }
    public function ValiderDroitExamenViaWestern($matricule,$idwestern,$observation){
        $sql=$this->db->prepare("UPDATE `WESTERN` SET `ETAT`='lu',`DECISION`='valide',`OBSERVATION`=:observation WHERE `IDWESTERN`=:idwestern");
        $sql->bindValue(":observation",$observation,PDO::PARAM_STR);
        $sql->bindValue(":idwestern",$idwestern,PDO::PARAM_INT);
        $sql->execute();
        $sql->closeCursor();

        $sql2=$this->db->prepare("UPDATE `SUIVRE` SET `EXAMEN`=1 WHERE `MATRICULE`=:matricule");
        $sql2->bindValue(":matricule",$matricule,PDO::PARAM_STR);
        $sql2->execute();
        $sql2->closeCursor();
       

    }


    public function ValiderSoutenanceViaWestern($matricule,$idwestern,$observation){
        $sql=$this->db->prepare("UPDATE `WESTERN` SET `ETAT`='lu',`DECISION`='valide',`OBSERVATION`=:observation WHERE `IDWESTERN`=:idwestern");
        $sql->bindValue(":observation",$observation,PDO::PARAM_STR);
        $sql->bindValue(":idwestern",$idwestern,PDO::PARAM_INT);
        $sql->execute();
        $sql->closeCursor();

        $sql2=$this->db->prepare("UPDATE `SUIVRE` SET `SOUTENANCE`=1 WHERE `MATRICULE`=:matricule");
        $sql2->bindValue(":matricule",$matricule,PDO::PARAM_STR);
        $sql2->execute();
        $sql2->closeCursor();
       

    }
    public function ValiderCertificat($matricule,$idwestern,$observation){
        $sql=$this->db->prepare("UPDATE `WESTERN` SET `ETAT`='lu',`DECISION`='valide',`OBSERVATION`=:observation WHERE `IDWESTERN`=:idwestern");
        $sql->bindValue(":observation",$observation,PDO::PARAM_STR);
        $sql->bindValue(":idwestern",$idwestern,PDO::PARAM_INT);
        $sql->execute();
        $sql->closeCursor();

        $sql2=$this->db->prepare("UPDATE `SUIVRE` SET `CERTIFICAT`=`CERTIFICAT`+1 WHERE `MATRICULE`=:matricule");
        $sql2->bindValue(":matricule",$matricule,PDO::PARAM_STR);
        $sql2->execute();
        $sql2->closeCursor();
       

    }
    public function RefuserWestern($idwestern){
        $sql=$this->db->prepare("DELETE FROM `WESTERN` WHERE `IDWESTERN` =:idwestern");
        $sql->bindValue(":idwestern",$idwestern,PDO::PARAM_INT);
        $sql->execute();
        $sql->closeCursor();
    }
    
    public function ListPaiementWestern($date,$motif,$vague){
        $sql=$this->db->prepare("SELECT `IDWESTERN`,`SUIVRE`.`MATRICULE`,`CODE`,`NOM`,`PRENOM`,`NUMERO`,`NSUIVI`,`NOMEXP`,`MONTANTWESTERN`,`MOTIF`,`DATESERVER`,`MONTANT`,`OBSERVATION` FROM `SUIVRE` NATURAL JOIN `ETUDIANTS` NATURAL JOIN `WESTERN` WHERE `SUIVRE`.`IDETUDIANTS`=`WESTERN`.`IDETUDIANTS` AND `WESTERN`.`DATESERVER` LIKE :datevalidation AND `CODE`=:vague AND `WESTERN`.`ETAT`='lu' AND `WESTERN`.`DECISION`='valide' AND `MOTIF`=:motif ORDER BY DATESERVER ASC");
        $date.="%";
        $sql->bindValue(":datevalidation",$date,PDO::PARAM_STR);
        $sql->bindValue(":vague",$vague,PDO::PARAM_STR);
        $sql->bindValue(":motif",$motif,PDO::PARAM_STR);
        $sql->execute();
        $data= $sql->fetchAll(PDO::FETCH_ASSOC);
        $sql->closeCursor();
        return $data;
    }
}
?>