<?php
class Western{
    protected $idwestern;
    protected $nsuivi;
    protected $nomexp;
    protected $montantwestern;
    protected $montant;
    protected $decision;
    protected $etat;
    protected $motif;
    protected $dateserver;
    protected $idetudiants;
    protected $observation;
    protected $datevalidation;
    protected $tempsvalidation;

    public function __construct($data)
    {
        $this->hydrate($data);
    }

    public function hydrate($data){
        foreach ($data as $key => $value) {
            $key=strtolower($key);
            $method="set".ucfirst($key);
            if(method_exists($this,$method)){
                $this->$method($value);
            }
        }
    }

    public function getIdwestern(){
        return $this->idwestern;
    }
    public function getNsuivi(){
        return $this->nsuivi;
    }
    public function getNomexp(){
        return $this->nomexp;
    }
    public function getMontantwestern(){
        return $this->montantwestern;
    }
    public function getMontant(){
        return $this->montant;
    }
    public function getDecision(){
        return $this->decision;
    }
    public function getEtat(){
        return $this->etat;
    }
    public function getMotif(){
        return $this->motif;
    }
    public function getDateserver(){
        return $this->dateserver;
    }
    public function getIdetudiants(){
        return $this->idetudiants;
    }
    public function getObservation(){
        return $this->observation;
    }

    public function getDatevalidation(){
        return $this->datevalidation;
    }
    public function getTempsvalidation(){
        return $this->tempsvalidation;
    }
    

    public function setIdwestern($idwestern){
        $this->idwestern=$idwestern;
    }
    public function setNsuivi($nsuivi){
        $this->nsuivi=$nsuivi;
    }
    public function setNomexp($nomexp){
        $this->nomexp=$nomexp;
    }
    public function setMontantwestern($montantwestern){
        $this->montantwestern=$montantwestern;
    }
    public function setMontant($montant){
        $this->montant=$montant;
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
    public function setIdetudiants($idetudiants){
        $this->idetudiants=$idetudiants;
    }
    public function setObservation($observation){
        $this->observation=$observation;
    }
    public function setDatevalidation($datevalidation){
        $this->datevalidation=$datevalidation;
    }
    public function setTempsvalidation($tempsvalidation){
        $this->tempsvalidation=$tempsvalidation;
    }

}

?>