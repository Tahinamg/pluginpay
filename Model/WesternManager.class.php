<?php
class WesternManager{
    protected $db;

    public function __construct(PDO $db)
    {
        $this->db=$db;
    }
    public function setWestern(Western $union){
        $statement=$this->db->prepare("INSERT INTO `WESTERN` VALUES(NULL,:nsuivi,:nomexp,:montantwestern,:montant,:motif,:etat,:decision,CURRENT_TIMESTAMP,:idetudiants,:observation,:datevalidation,:tempsvalidation)");
        $statement->bindValue(':nsuivi',$union->getNsuivi(),PDO::PARAM_STR);
        $statement->bindValue(':nomexp',$union->getNomexp(),PDO::PARAM_STR);
        $statement->bindValue(':montantwestern',$union->getMontantwestern(),PDO::PARAM_STR);
        $statement->bindValue(':montant',$union->getMontant(),PDO::PARAM_STR);
        $statement->bindValue(':motif',$union->getMotif(),PDO::PARAM_STR);
        $statement->bindValue(':etat',$union->getEtat(),PDO::PARAM_STR);
        $statement->bindValue(':decision',$union->getDecision(),PDO::PARAM_STR);
        $statement->bindValue(':idetudiants',$union->getIdetudiants(),PDO::PARAM_INT);
        $statement->bindValue(":observation",$union->getObservation(),PDO::PARAM_STR);
        $statement->bindValue(":datevalidation",$union->getDatevalidation(),PDO::PARAM_STR);
        $statement->bindValue(":tempsvalidation",$union->getTempsvalidation(),PDO::PARAM_STR);
        $statement->execute();      
        $statement->closeCursor();
       
    }
}
?>