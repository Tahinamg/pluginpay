<?php
//UPLOAD
class Virement{

    protected $ncompte ,$titucompte ,$idvirement,$idetudiants,$motif,$decision,$etat,$dateserver,$montant,$datevirement,$observation,$datevalidation,$tempsvalidation;


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

    public function getDatevalidation(){
        return $this->datevalidation;
    }

    public function getTempsvalidation(){
        return $this->tempsvalidation;
    }
    public function getMontant(){
        return $this->montant;
    }
    public function getNcompte()
    {
        return $this->ncompte;
    }
    public function getTitucompte()
    {
        return $this->titucompte;
    }
    public function getIdvirement(){
        return $this->idvirement;
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
    public function getDatevirement(){
        return $this->datevirement;
    }
    public function getObservation(){
        return $this->observation;
    }
    
    public function setDatevalidation($datevalidation){
        $this->datevalidation=$datevalidation;
    }
    public function setTempsvalidation($tempsvalidation){
        $this->tempsvalidation=$tempsvalidation;
    }
    public function setNcompte($ncompte)
    {
        $this->ncompte=$ncompte;
    }
    public function setTitucompte($titucompte){
        $this->titucompte=$titucompte;
    }
    public function setIdvirement($idvirement){
        $this->idvirement=$idvirement;
    }
    public function setIdetudiants($idetudiants){
        $this->idetudiants=$idetudiants;
    }
    public function setMotif($motif){
        $this->motif=$motif;
    }
    public function setDecision($decision){
        $this->decision=$decision;
    }
    public function setEtat($etat){
        $this->etat=$etat;
    }
    public function setMontant($montant){
        $this->montant=$montant;
    }
    public function setDatevirement($datevirement){
        $this->datevirement=$datevirement;
    }
    public function setObservation($observation){
        $this->observation=$observation;
    }


}

?>