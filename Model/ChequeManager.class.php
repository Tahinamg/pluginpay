<?php
class ChequeManager{
protected $db;
    public function __construct(PDO $db)
    {
        $this->db=$db;
    }

    public function setCheque(Cheque $cheque){
//MISY OLANA
        $sql=$this->db->prepare("INSERT INTO CHEQUE VALUES(NULL,:tireur,:etablissement,:ncheque,:idetudiants,:motif,:etat,:decision,:dateserver,:montant)");

        $sql->bindValue(":tireur",$cheque->getTireur(),PDO::PARAM_STR);
        $sql->bindValue(":etablissement",$cheque->getEtablissement(),PDO::PARAM_STR);
        $sql->bindValue(":ncheque",$cheque->getNcheque(),PDO::PARAM_STR);
        $sql->bindValue(":idetudiants",$cheque->getIdetudiants(),PDO::PARAM_STR);
        $sql->bindValue(":motif",$cheque->getMotif(),PDO::PARAM_STR);
        $sql->bindValue(":etat",$cheque->getEtat(),PDO::PARAM_STR);
        $sql->bindValue(":decision",$cheque->getDecision(),PDO::PARAM_STR);
        $sql->bindValue(":dateserver",date('Y-m-d H:i:s'),PDO::PARAM_STR);
        $sql->bindValue(":montant",$cheque->getMontant(),PDO::PARAM_STR);


        $sql->execute();
        $sql->closeCursor();

    }
}
    ?>