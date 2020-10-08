<?php

class ProduitManager{
    protected $db;
    public function __construct(PDO $database)
    {
        $this->setdb($database);
    }
    public function setdb(PDO $data){
        $this->db=$data;
    }
    public function getdb(){
        return $this->db;
    }
    public function getPrix(string $nationality,string $semestre,string $motif){
        $sql=$this->db->prepare("SELECT * FROM PRODUIT WHERE NATIONALITE=:nationality AND SEMESTRE=:semestre AND MOTIF=:motif");
       $sql->execute(array(":nationality"=>$nationality,":semestre"=>$semestre,":motif"=>$motif));
       return $sql->fetchAll(PDO::FETCH_ASSOC);

    }
}

?>