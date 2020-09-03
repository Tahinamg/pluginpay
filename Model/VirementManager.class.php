<?php 
class VirementManager{
    //UPLOAD
    protected $db;
    public function __construct(PDO $db)
    {
        $this->db=$db;
    }
    public function setVirement(Virement $virement){
        $sql=$this->db->prepare("INSERT INTO VIREMENT VALUES(NULL,:ncompte,:titucompte,:datevirement,:idetudiants,:motif,:etat,:decision,:dateserver,:montant,:observation,:datevalidation,:tempsvalidation)");
        $sql->bindValue(":ncompte",$virement->getNcompte(),PDO::PARAM_STR);
        $sql->bindValue(":titucompte",$virement->getTitucompte(),PDO::PARAM_STR);
        $sql->bindValue(":datevirement",$virement->getDatevirement(),PDO::PARAM_STR);
        $sql->bindValue(":idetudiants",$virement->getIdetudiants(),PDO::PARAM_INT);
        $sql->bindValue(":motif",$virement->getMotif(),PDO::PARAM_STR);
        $sql->bindValue(":etat",$virement->getEtat(),PDO::PARAM_STR);
        $sql->bindValue(":decision",$virement->getDecision(),PDO::PARAM_STR);
        $sql->bindValue(":dateserver",date('Y-m-d H:i:s'),PDO::PARAM_STR);
        $sql->bindValue(":montant",$virement->getMontant(),PDO::PARAM_STR);
        $sql->bindValue(":observation",$virement->getObservation(),PDO::PARAM_STR);
        $sql->bindValue("datevalidation",$virement->getDatevalidation(),PDO::PARAM_STR);
        $sql->bindValue("tempsvalidation",$virement->getTempsvalidation(),PDO::PARAM_STR);
        $sql->execute();
        $sql->closeCursor();
    }
    
    
    
}
?>