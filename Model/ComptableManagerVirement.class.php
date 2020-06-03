<?php
class ComptableManagerVirement{
//TODO INSERT MAIL AT VALIDATION AND REQUEST
protected $db;

    public function __construct($db)
    {
        $this->setDb($db);
    }
    public function setDb(PDO $db){
        $this->db=$db;
    }



    public function VoirVirement(){
        $sql=$this->db->query("SELECT `MATRICULE`,`NOM`,`PRENOM`,`ETUDIANTS`.`IDETUDIANTS`,`MOTIF`,`SEMESTRE`,`VIREMENT`.`MONTANT`,`IDVIREMENT`,`ETAT`,`DECISION`,`DATESERVER`,`TITUCOMPTE`,`NCOMPTE` FROM `VIREMENT` NATURAL JOIN `SUIVRE`,`ETUDIANTS` WHERE `ETUDIANTS`.`IDETUDIANTS`=`VIREMENT`.`IDETUDIANTS` AND `VIREMENT`.`ETAT`='non lu' ");
        return $sql->fetchAll(PDO::FETCH_ASSOC);
        $sql->closeCursor();

    }
    public function NotifVirement(){
        $sql=$this->db->query("SELECT COUNT(*) FROM `VIREMENT` WHERE `ETAT`='non lu' ");
        return $sql->fetch();
        $sql->closeCursor();
    }
    public function ValiderEcolageViaVirement($qte,$matricule,$idvirement){
        $sql1=$this->db->prepare("UPDATE `VIREMENT` SET `ETAT`='lu',`DECISION`='valide' WHERE `IDVIREMENT`=:idvirement");
        $sql1->bindValue(":idvirement",$idvirement,PDO::PARAM_INT);
        $sql1->execute();
        $sql1->closeCursor();

        $sql2=$this->db->prepare("UPDATE `SUIVRE` SET `ECOLAGE`=`ECOLAGE`+:qte WHERE `MATRICULE`=:matricule");
        $sql2->bindValue(":qte",$qte,PDO::PARAM_INT);
        $sql2->bindValue(":matricule",$matricule,PDO::PARAM_STR);
        $sql2->execute();
        $sql2->closeCursor();

    }

    Public function ValiderInscriptionViaVirement($matricule,$idvirement){
        $sql=$this->db->prepare("UPDATE `VIREMENT` SET `ETAT`='lu',`DECISION`='valide' WHERE `IDVIREMENT`=:idvirement");
        $sql->bindValue(":idvirement",$idvirement,PDO::PARAM_INT);
        $sql->execute();
        $sql->closeCursor();


        $sql2=$this->db->prepare("UPDATE `SUIVRE` SET `INSCRIPTION`=1 WHERE `MATRICULE`=:matricule");
        $sql2->bindValue(":matricule",$matricule,PDO::PARAM_STR);
        $sql2->execute();
        $sql2->closeCursor();

    }
    
    public function ValiderRepechageViaVirement($idetudiant,$idvirement){
        $sql=$this->db->prepare("UPDATE `VIREMENT` SET `ETAT`='lu',`DECISION`='valide' WHERE `IDVIREMENT`=:idvirement");
        $sql->bindValue(":idvirement",$idvirement,PDO::PARAM_INT);
        $sql->execute();
        $sql->closeCursor();

        $sql=$this->db->prepare("DELETE FROM `REPECHER` WHERE `IDETUDIANTS`=:id");
        $sql->bindValue(":id",$idetudiant,PDO::PARAM_INT);
        $sql->execute();
    }
    public function ValiderDroitExamenViaVirement($matricule,$idvirement){
        $sql=$this->db->prepare("UPDATE `VIREMENT` SET `ETAT`='lu',`DECISION`='valide' WHERE `IDVIREMENT`=:idvirement");
        $sql->bindValue(":idvirement",$idvirement,PDO::PARAM_INT);
        $sql->execute();
        $sql->closeCursor();

        $sql2=$this->db->prepare("UPDATE `SUIVRE` SET `EXAMEN`=1 WHERE `MATRICULE`=:matricule");
        $sql2->bindValue(":matricule",$matricule,PDO::PARAM_STR);
        $sql2->execute();
        $sql2->closeCursor();
       

    }


    public function ValiderSoutenanceViaVirement($matricule,$idvirement){
        $sql=$this->db->prepare("UPDATE `VIREMENT` SET `ETAT`='lu',`DECISION`='valide' WHERE `IDVIREMENT`=:idvirement");
        $sql->bindValue(":idvirement",$idvirement,PDO::PARAM_INT);
        $sql->execute();
        $sql->closeCursor();

        $sql2=$this->db->prepare("UPDATE `SUIVRE` SET `SOUTENANCE`=1 WHERE `MATRICULE`=:matricule");
        $sql2->bindValue(":matricule",$matricule,PDO::PARAM_STR);
        $sql2->execute();
        $sql2->closeCursor();
       

    }
    public function ValiderCertificat($matricule,$idvirement){
        $sql=$this->db->prepare("UPDATE `VIREMENT` SET `ETAT`='lu',`DECISION`='valide' WHERE `IDVIREMENT`=:idvirement");
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
    }
    
}
?>