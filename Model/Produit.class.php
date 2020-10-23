<?php
class Produit{
    protected $semestre,$motif,$montant,$nationalite,$devise;
    public function __construct($donne)
    {
        $this->hydrate($donne);
    }
    public function hydrate($donne){
        foreach($donne as $key => $value){
            $method= "set".ucfirst(strtolower($key));
            if(method_exists($this,$method)){
                $this->$method($value);
            }
        }
    }
    public function getDevise(){
        return $this->devise;
    }
    public function getSemestre(){
        return $this->semestre;
    }
    public function getMotif(){
        return $this->motif;
    }
    public function getMontant(){
        return $this->montant;
    }
    public function getNationalite(){
        return $this->nationalite;
    }
    public function setDevise($devise){
        $this->devise=$devise;
    }
    public function setSemestre($semestre){
        $this->semestre=$semestre;
    }
    public function setMotif($motif){
        $this->motif=$motif;
    }
    public function setMontant($montant){
        $this->montant=$montant;
    }
    public function setNationalite($nationalite){
        $this->nationalite=$nationalite;
    }

}
?>