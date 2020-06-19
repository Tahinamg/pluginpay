<?php
class ComptableManagerVersement{
protected $db;

    public function __construct($db)
    {
        $this->setDb($db);
    }
    public function setDb(PDO $db){
        $this->db=$db;
    }



    public function VoirVersement(){
        $sql=$this->db->query("SELECT `MATRICULE`,`NOM`,`PRENOM`,`ETUDIANTS`.`IDETUDIANTS`,`MOTIF`,`SEMESTRE`,`VERSEMENT`.`MONTANT`,`IDVERSEMENT`,`ETAT`,`DECISION`,`DATESERVER`,`NBORDEREAUX`,`DATY`,`AGENCE` FROM `VERSEMENT` NATURAL JOIN `SUIVRE`,`ETUDIANTS` WHERE `ETUDIANTS`.`IDETUDIANTS`=`VERSEMENT`.`IDETUDIANTS` AND `VERSEMENT`.`ETAT`='non lu' ORDER BY `IDVERSEMENT` ASC");
        return $sql->fetchAll(PDO::FETCH_ASSOC);
        $sql->closeCursor();

    }
    public function NotifVersement(){
        $sql=$this->db->query("SELECT COUNT(*) FROM `VERSEMENT` WHERE `ETAT`='non lu' ");
        return $sql->fetch();
        $sql->closeCursor();
    }
    public function ValiderEcolageViaVersement($qte,$matricule,$idversement){
        $sql1=$this->db->prepare("UPDATE `VERSEMENT` SET `ETAT`='lu',`DECISION`='valide' WHERE `IDVERSEMENT`=:idversement");
        $sql1->bindValue(":idversement",$idversement,PDO::PARAM_INT);
        $sql1->execute();
        $sql1->closeCursor();
        $sql2=$this->db->prepare("UPDATE `SUIVRE` SET `ECOLAGE`=`ECOLAGE`+:qte WHERE `MATRICULE`=:matricule");
        $sql2->bindValue(":qte",$qte,PDO::PARAM_INT);
        $sql2->bindValue(":matricule",$matricule,PDO::PARAM_STR);
        $sql2->execute();
        $sql2->closeCursor();

    }

    Public function ValiderInscriptionViaVersement($matricule,$idversement){
        $sql=$this->db->prepare("UPDATE `VERSEMENT` SET `ETAT`='lu',`DECISION`='valide' WHERE `IDVERSEMENT`=:idversement");
        $sql->bindValue(":idversement",$idversement,PDO::PARAM_INT);
        $sql->execute();
        $sql->closeCursor();


        $sql2=$this->db->prepare("UPDATE `SUIVRE` SET `INSCRIPTION`=1 WHERE `MATRICULE`=:matricule");
        $sql2->bindValue(":matricule",$matricule,PDO::PARAM_STR);
        $sql2->execute();
        $sql2->closeCursor();

    }
    
    public function ValiderRepechageViaVersement($idetudiant,$idversement){
        $sql=$this->db->prepare("UPDATE `VERSEMENT` SET `ETAT`='lu',`DECISION`='valide' WHERE `IDVERSEMENT`=:idversement");
        $sql->bindValue(":idversement",$idversement,PDO::PARAM_INT);
        $sql->execute();
        $sql->closeCursor();

        $sql=$this->db->prepare("DELETE FROM `REPECHER` WHERE `IDETUDIANTS`=:id");
        $sql->bindValue(":id",$idetudiant,PDO::PARAM_INT);
        $sql->execute();
    }
    public function ValiderDroitExamenViaVersement($matricule,$idversement){
        $sql=$this->db->prepare("UPDATE `VERSEMENT` SET `ETAT`='lu',`DECISION`='valide' WHERE `IDVERSEMENT`=:idversement");
        $sql->bindValue(":idversement",$idversement,PDO::PARAM_INT);
        $sql->execute();
        $sql->closeCursor();

        $sql2=$this->db->prepare("UPDATE `SUIVRE` SET `EXAMEN`=1 WHERE `MATRICULE`=:matricule");
        $sql2->bindValue(":matricule",$matricule,PDO::PARAM_STR);
        $sql2->execute();
        $sql2->closeCursor();
       

    }


    public function ValiderSoutenanceViaVersement($matricule,$idversement){
        $sql=$this->db->prepare("UPDATE `VERSEMENT` SET `ETAT`='lu',`DECISION`='valide' WHERE `IDVERSEMENT`=:idversement");
        $sql->bindValue(":idversement",$idversement,PDO::PARAM_INT);
        $sql->execute();
        $sql->closeCursor();

        $sql2=$this->db->prepare("UPDATE `SUIVRE` SET `SOUTENANCE`=1 WHERE `MATRICULE`=:matricule");
        $sql2->bindValue(":matricule",$matricule,PDO::PARAM_STR);
        $sql2->execute();
        $sql2->closeCursor();
       

    }

    public function ValiderCertificat($matricule,$idversement){
        $sql=$this->db->prepare("UPDATE `VERSEMENT` SET `ETAT`='lu',`DECISION`='valide' WHERE `IDVERSEMENT`=:idversement");
        $sql->bindValue(":idversement",$idversement,PDO::PARAM_INT);
        $sql->execute();
        $sql->closeCursor();

        $sql2=$this->db->prepare("UPDATE `SUIVRE` SET `CERTIFICAT`=`CERTIFICAT`+1 WHERE `MATRICULE`=:matricule");
        $sql2->bindValue(":matricule",$matricule,PDO::PARAM_STR);
        $sql2->execute();
        $sql2->closeCursor();
    }


    public function RefuserVersement($idversement){
        $sql=$this->db->prepare("DELETE FROM `VERSEMENT` WHERE `VERSEMENT`.`IDVERSEMENT` =:idversement");
        $sql->bindValue(":idversement",$idversement,PDO::PARAM_INT);
        $sql->execute();
    }
    
}
?>