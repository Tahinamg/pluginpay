<?php
class MobileMoneyManager{
    //UPLOAD
protected $db;
    public function __construct(PDO $db)
    {
        $this->db=$db;
    }

    public function setMobileMoney(MobileMoney $mobilemoney){
        //MOBILEMONEY
        $sql=$this->db->prepare("INSERT INTO MOBILEMONEY VALUES(NULL,:idetudiants,:daty,:reference,:motif,:etat,:decision,:dateserver,:montant,:observation,:datevalidation,:tempsvalidation)");
        $sql->bindValue(":reference",$mobilemoney->getReference(),PDO::PARAM_STR);
        $sql->bindValue(":daty",$mobilemoney->getDaty(),PDO::PARAM_STR);
        $sql->bindValue(":idetudiants",$mobilemoney->getIdetudiants(),PDO::PARAM_INT);
        $sql->bindValue(":motif",$mobilemoney->getMotif(),PDO::PARAM_STR);
        $sql->bindValue(":etat",$mobilemoney->getEtat(),PDO::PARAM_STR);
        $sql->bindValue(":decision",$mobilemoney->getDecision(),PDO::PARAM_STR);
        $sql->bindValue(":dateserver",date('Y-m-d H:i:s'),PDO::PARAM_STR);
        $sql->bindValue(":montant",$mobilemoney->getMontant(),PDO::PARAM_STR);
        $sql->bindValue(":observation",$mobilemoney->getObservation(),PDO::PARAM_STR);
        $sql->bindValue(":datevalidation",$mobilemoney->getDatevalidation(),PDO::PARAM_STR);
        $sql->bindValue(":tempsvalidation",$mobilemoney->getTempsvalidation(),PDO::PARAM_STR);
        $sql->execute();
        $sql->closeCursor();
    }
}
    ?>