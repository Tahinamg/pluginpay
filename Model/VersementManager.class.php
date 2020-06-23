<?php
//TODO add field observation
class VersementManager{
  
    protected $db;
    public function __construct(PDO $db)
    {
        $this->db=$db;
    }


    public function setVersement(Versement $versement){
        //TSISY OLANA A IZAO NY CHANGEMENT OVAINA ILAY OE DATE DIA AMPIANA ID
        $sql=$this->db->prepare("INSERT INTO VERSEMENT (IDVERSEMENT, NBORDEREAUX, DATY, AGENCE, IDETUDIANTS, MOTIF, ETAT, DECISION, DATESERVER, MONTANT,OBSERVATION) VALUES (NULL, :nbordereaux,:daty,:agence,:idetudiants,:motif, :etat, :decision, CURRENT_TIMESTAMP,:montant,:observation)");
        $sql->bindValue(":nbordereaux",$versement->getNbordereaux(),PDO::PARAM_STR);
        $sql->bindValue(":daty",$versement->getDaty(),PDO::PARAM_STR);
        $sql->bindValue(":agence",$versement->getAgence(),PDO::PARAM_STR);
        $sql->bindValue(":idetudiants",$versement->getIdetudiants(),PDO::PARAM_INT);
        $sql->bindValue(":motif",$versement->getMotif(),PDO::PARAM_STR);
        $sql->bindValue(":etat",$versement->getEtat(),PDO::PARAM_STR);
        $sql->bindValue(":decision",$versement->getDecision(),PDO::PARAM_STR);
        $sql->bindValue(":montant",$versement->getMontant(),PDO::PARAM_STR);
        $sql->bindValue(":observation",$versement->getObservation(),PDO::PARAM_STR);
        $sql->execute();
        $sql->closeCursor();


    }


}

?>