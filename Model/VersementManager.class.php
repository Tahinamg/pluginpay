<?php
class VersementManager{
 //UPLOAD 
    protected $db;
    public function __construct(PDO $db)
    {
        $this->db=$db;
    }


    public function setVersement(Versement $versement){
        //TSISY OLANA A IZAO NY CHANGEMENT OVAINA ILAY OE DATE DIA AMPIANA ID
        $sql=$this->db->prepare("INSERT INTO VERSEMENT (IDVERSEMENT, NBORDEREAUX, DATY, AGENCE, IDETUDIANTS, MOTIF, ETAT, DECISION, DATESERVER, MONTANT,OBSERVATION,DATEVERSEMENT,DATEVALIDATION,TEMPSVALIDATION) VALUES (NULL, :nbordereaux,:daty,:agence,:idetudiants,:motif, :etat, :decision, CURRENT_TIMESTAMP,:montant,:observation,:dateversement,:datevalidation,:tempsvalidation)");
        $sql->bindValue(":nbordereaux",$versement->getNbordereaux(),PDO::PARAM_STR);
        $sql->bindValue(":daty",$versement->getDaty(),PDO::PARAM_STR);
        $sql->bindValue(":agence",$versement->getAgence(),PDO::PARAM_STR);
        $sql->bindValue(":idetudiants",$versement->getIdetudiants(),PDO::PARAM_INT);
        $sql->bindValue(":motif",$versement->getMotif(),PDO::PARAM_STR);
        $sql->bindValue(":etat",$versement->getEtat(),PDO::PARAM_STR);
        $sql->bindValue(":decision",$versement->getDecision(),PDO::PARAM_STR);
        $sql->bindValue(":montant",$versement->getMontant(),PDO::PARAM_STR);
        $sql->bindValue(":observation",$versement->getObservation(),PDO::PARAM_STR);
        $sql->bindValue(":dateversement",$versement->getDateversement(),PDO::PARAM_STR);
        $sql->bindValue(":datevalidation",$versement->getDatevalidation(),PDO::PARAM_STR);
        $sql->bindValue(":tempsvalidation",$versement->getTempsvalidation(),PDO::PARAM_STR);
        $sql->execute();
        $sql->closeCursor();


    }


}

?>