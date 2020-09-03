<?php
class Cheque{
    //UPLOAD
    protected $idcheque;
    protected $tireur;
    protected $etablissement;
    protected $ncheque;
    protected $idetudiants;
    protected $motif;
    protected $etat;
    protected $decision;
    protected $dateserver;
    protected $montant;
    protected $observation; 
    protected $datevalidation;
    protected $tempsvalidation;

    public function __construct($donnes)
    {
        $this->hydrate($donnes);
    }
    Public function hydrate($donnes){
        foreach ($donnes as $key => $value)
        {
            $key=strtolower($key);
            $method = 'set'.ucfirst($key);
            if (method_exists($this, $method)){
                $this->$method($value);
            }
        }
    }
    public function setDatevalidation($datevalidation){
        $this->datevalidation=$datevalidation;
    }
    public function setTempsvalidation($tempsvalidation){
        $this->tempsvalidation=$tempsvalidation;
    }
    public function setMontant($montant){
        $this->montant=$montant;
    }
    public function setIdcheque($idcheque){
        $this->idcheque=$idcheque;
    }
    public  function setTireur($tireur){
        $this->tireur=$tireur;
    }
    public function setEtablissement($etablissement){
        $this->etablissement=$etablissement;
    }
    public function setNcheque($ncheque){
        $this->ncheque=$ncheque;
    }
    public function setIdetudiants($idetudiants){
        $this->idetudiants=$idetudiants;
    }
    
    public function setMotif($motif){
        $this->motif=$motif;
    }
    public function setEtat($etat){
        $this->etat=$etat;
    }
    public function setDecision($decision){
        $this->decision=$decision;
    }
    public function setDateserver($dateserver){
        $this->dateserver=$dateserver;
    }

    public function setObservation($observation){
        $this->observation=$observation;
    }



    public function getDatevalidation(){
        return $this->datevalidation;
    }
    public function getTempsvalidation(){
        return $this->tempsvalidation;
    }
    public function getMontant(){
        return $this->montant;
    }

    public function getIdcheque(){
        return $this->idcheque;
    }
    public  function getTireur(){
        return $this->tireur;
    }
    public function getEtablissement(){
        return $this->etablissement;
    }
    public function getNcheque(){
        return $this->ncheque;
    }
    public function getIdetudiants(){
        return $this->idetudiants;
    }
    
    public function getMotif(){
        return $this->motif;
    }
    public function getEtat(){
        return $this->etat;
    }
    public function getDecision(){
        return $this->decision;
    }
    public function getDateserver(){
        return $this->dateserver;
    }
    public function getObservation(){
        return $this->observation;
    }





}


?>