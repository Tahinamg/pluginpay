<?php
class MoneyGram{
    //UPLOAD
    protected $idmoneygram;
    protected $expediteur;
    protected $reference;
    protected $datymoneygram;
    protected $montantmoneygram;
    protected $montant;
    protected $dateserver;
    protected $observation;
    protected $motif;
    protected $idetudiants;
    protected $decision;
    protected $etat;
    protected $tempsvalidation;
    protected $datevalidation;
public function __construct(array $data){
    $this->hydrate($data);
}
    
public function hydrate(array $datahydrate){
    foreach($datahydrate as $key => $value){
        $method="set".ucfirst(strtolower($key));
        if(method_exists($this,$method)){
            $this->$method($value);
        }
    }
}
    public function getTempsvalidation(){
        return $this->tempsvalidation;
    }
    public function getDatevalidation(){
        return $this->datevalidation;
    }
    public function getIdmoneygram(){
        return $this->idmoneygram;
    }
    public function getExpediteur(){
        return $this->expediteur;
    }
    public function getReference(){
        return $this->reference;
    }
    public function getDatymoneygram(){
        return $this->datymoneygram;
    }
    public function getMontantmoneygram(){
        return $this->montantmoneygram;
    }
    public function getMontant(){
        return $this->montant;
    }
    public function getDateserver(){
        return $this->dateserver;
    }
    public function getObservation(){
        return $this->observation;
    }
    public function getMotif(){
        return $this->motif;
    }
    public function getIdetudiants(){
        return $this->idetudiants;
    }
    public function getDecision(){
        return $this->decision;
    }
    public function getEtat(){
        return $this->etat;
    }

    public function setDatevalidation($datevalidation){
        $this->datevalidation=$datevalidation;
    }
    public function setTempsvalidation($tempsvalidation){
        $this->tempsvalidation=$tempsvalidation;
    }
    public function setIdmoneygram($idmoneygram){
         $this->idmoneygram=$idmoneygram;
    }
    public function setExpediteur($expediteur){
         $this->expediteur=$expediteur;
    }
    public function setReference($reference){
         $this->reference=$reference;
    }
    public function setDatymoneygram($datymoneygram){
         $this->datymoneygram=$datymoneygram;
    }
    public function setMontantmoneygram($montantmoneygram){
         $this->montantmoneygram=$montantmoneygram;
    }
    public function setMontant($montant){
         $this->montant=$montant;
    }
    public function setDateserver($dateserver){
         $this->dateserver=$dateserver;
    }
    public function setObservation($observation){
         $this->observation=$observation;
    }
    public function setMotif($motif){
         $this->motif=$motif;
    }
    public function setIdetudiants($idetudiants){
         $this->idetudiants=$idetudiants;
    }
    public function setDecision($decision){
         $this->decision=$decision;
    }
    public function setEtat($etat){
         $this->etat=$etat;
    }
}
?>