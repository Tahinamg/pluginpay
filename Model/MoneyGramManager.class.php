<?php
class MoneyGramManager{
    //UPLOAD
protected $db;
    public function __construct(PDO $db)
    {
        $this->db=$db;
    }

    public function setMoneyGram(MoneyGram $moneyGram){
        $sql=$this->db->prepare("INSERT INTO MONEYGRAM VALUES(NULL,:idetudiants,:datymoneygram,:reference,:expediteur,:dateserver,:observation,:motif,:decision,:etat,:montant,:montantmoneygram,:datevalidation,:tempsvalidation)");
        $sql->bindValue(":idetudiants",$moneyGram->getIdetudiants(),PDO::PARAM_INT);
        $sql->bindValue(":datymoneygram",$moneyGram->getDatymoneygram(),PDO::PARAM_STR);
        $sql->bindValue(":reference",$moneyGram->getReference(),PDO::PARAM_STR);  
        $sql->bindValue(":expediteur",$moneyGram->getExpediteur(),PDO::PARAM_STR);
        $sql->bindValue(":dateserver",date('Y-m-d H:i:s'),PDO::PARAM_STR);
        $sql->bindValue(":observation",$moneyGram->getObservation(),PDO::PARAM_STR);
        $sql->bindValue(":motif",$moneyGram->getMotif(),PDO::PARAM_STR);
        $sql->bindValue(":decision",$moneyGram->getDecision(),PDO::PARAM_STR);
        $sql->bindValue(":etat",$moneyGram->getEtat(),PDO::PARAM_STR);
        $sql->bindValue(":montant",$moneyGram->getMontant(),PDO::PARAM_STR);
        $sql->bindValue(":montantmoneygram",$moneyGram->getMontantmoneygram(),PDO::PARAM_STR);
        $sql->bindValue(":datevalidation",$moneyGram->getDatevalidation(),PDO::PARAM_STR);
        $sql->bindValue(":tempsvalidation",$moneyGram->getTempsvalidation(),PDO::PARAM_STR);
        $sql->execute();
        $sql->closeCursor();
    }
}
    ?>