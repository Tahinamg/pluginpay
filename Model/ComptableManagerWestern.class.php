<?php
class ComptableManagerWestern{

protected $db;

    public function __construct($db)
    {
        $this->setDb($db);
    }
    public function setDb(PDO $db){
        $this->db=$db;
    }



    public function VoirWestern(){
        $sql=$this->db->query("SELECT `MATRICULE`,`NOM`,`PRENOM`,`ETUDIANTS`.`IDETUDIANTS`,`MOTIF`,`SEMESTRE`,`WESTERN`.`MONTANT`,`IDWESTERN`,`ETAT`,`DECISION`,`DATESERVER`,`NSUIVI`,`NOMEXP`,`MONTANTWESTERN` FROM `WESTERN` NATURAL JOIN `SUIVRE`,`ETUDIANTS` WHERE `ETUDIANTS`.`IDETUDIANTS`=`WESTERN`.`IDETUDIANTS` AND `WESTERN`.`ETAT`='non lu' ORDER BY `IDWESTERN` ASC");
        return $sql->fetchAll(PDO::FETCH_ASSOC);
        $sql->closeCursor();

    }
    public function NotifWestern(){
        $sql=$this->db->query("SELECT COUNT(*) FROM `WESTERN` WHERE `ETAT`='non lu'");
        return $sql->fetch();
        $sql->closeCursor();
    }
    public function ValiderEcolageViaWestern($qte,$matricule,$idwestern){
        $sql1=$this->db->prepare("UPDATE `WESTERN` SET `ETAT`='lu',`DECISION`='valide' WHERE `IDWESTERN`=:idwestern");
        $sql1->bindValue(":idwestern",$idwestern,PDO::PARAM_INT);
        $sql1->execute();
        $sql1->closeCursor();

        $sql2=$this->db->prepare("UPDATE `SUIVRE` SET `ECOLAGE`=`ECOLAGE`+:qte WHERE `MATRICULE`=:matricule");
        $sql2->bindValue(":qte",$qte,PDO::PARAM_INT);
        $sql2->bindValue(":matricule",$matricule,PDO::PARAM_STR);
        $sql2->execute();
        $sql2->closeCursor();

    }

    Public function ValiderInscriptionViaWestern($matricule,$idwestern){
        $sql=$this->db->prepare("UPDATE `WESTERN` SET `ETAT`='lu',`DECISION`='valide' WHERE `IDWESTERN`=:idwestern");
        $sql->bindValue(":idwestern",$idwestern,PDO::PARAM_INT);
        $sql->execute();
        $sql->closeCursor();


        $sql2=$this->db->prepare("UPDATE `SUIVRE` SET `INSCRIPTION`=1 WHERE `MATRICULE`=:matricule");
        $sql2->bindValue(":matricule",$matricule,PDO::PARAM_STR);
        $sql2->execute();
        $sql2->closeCursor();

    }
    
    public function ValiderRepechageViaWestern($idetudiant,$idwestern){
        $sql=$this->db->prepare("UPDATE `WESTERN` SET `ETAT`='lu',`DECISION`='valide' WHERE `IDWESTERN`=:idwestern");
        $sql->bindValue(":idwestern",$idwestern,PDO::PARAM_INT);
        $sql->execute();
        $sql->closeCursor();

        $sql=$this->db->prepare("DELETE FROM `REPECHER` WHERE `IDETUDIANTS`=:id");
        $sql->bindValue(":id",$idetudiant,PDO::PARAM_INT);
        $sql->execute();
    }
    public function ValiderDroitExamenViaWestern($matricule,$idwestern){
        $sql=$this->db->prepare("UPDATE `WESTERN` SET `ETAT`='lu',`DECISION`='valide' WHERE `IDWESTERN`=:idwestern");
        $sql->bindValue(":idwestern",$idwestern,PDO::PARAM_INT);
        $sql->execute();
        $sql->closeCursor();

        $sql2=$this->db->prepare("UPDATE `SUIVRE` SET `EXAMEN`=1 WHERE `MATRICULE`=:matricule");
        $sql2->bindValue(":matricule",$matricule,PDO::PARAM_STR);
        $sql2->execute();
        $sql2->closeCursor();
       

    }


    public function ValiderSoutenanceViaWestern($matricule,$idwestern){
        $sql=$this->db->prepare("UPDATE `WESTERN` SET `ETAT`='lu',`DECISION`='valide' WHERE `IDWESTERN`=:idwestern");
        $sql->bindValue(":idwestern",$idwestern,PDO::PARAM_INT);
        $sql->execute();
        $sql->closeCursor();

        $sql2=$this->db->prepare("UPDATE `SUIVRE` SET `SOUTENANCE`=1 WHERE `MATRICULE`=:matricule");
        $sql2->bindValue(":matricule",$matricule,PDO::PARAM_STR);
        $sql2->execute();
        $sql2->closeCursor();
       

    }
    public function ValiderCertificat($matricule,$idwestern){
        $sql=$this->db->prepare("UPDATE `WESTERN` SET `ETAT`='lu',`DECISION`='valide' WHERE `IDWESTERN`=:idwestern");
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
    }
    
}
?>