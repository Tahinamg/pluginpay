<?php
class Etudiant{
public function __construct($donnes)
{
    $this->hydrate($donnes);
}
    Public function hydrate($donnes){
        foreach ($donnes as $key => $value)
        {
            $key=strtolower ($key);
            $method = 'set'.ucfirst($key);
            if (method_exists($this, $method)){
                $this->$method($value);
            }
        }
    }

    
    protected  $idetudiants;
    protected  $nationalite;
    protected  $semestre;
    protected $matricule;
    protected $ecolage;
    protected $inscription;
    protected $examen;
    protected $soutenance;
    protected $repechage;
    protected $certificat;
    protected $email;
    protected $nom;
    protected $prenom;
    protected $numero;


    public function setNom($nom){
        $this->nom=$nom;
    }
    public function setPrenom($prenom){
        $this->prenom=$prenom;
    }
    public function setNumero($numero){
        $this->numero=$numero;
    }

    public function setMail($email){
        $this->email=$email;
    }
    Public function setCertificat($certificat){
        $this->certificat=$certificat;
    }
    Public function setExamen($examen){
        $this->examen=$examen;
    }
    public function setSoutenance($soutenance){
        $this->soutenance=$soutenance;
    }
    Public function setRepechage($repechage){
        $this->repechage=$repechage;
    }
    Public function setInscription($inscription){
        $this->inscription=$inscription;
    }
    Public function setEcolage($ecolage){
        $this->ecolage=$ecolage;
    }

    public function setNationalite($nationalite){
        $this->nationalite=$nationalite;
    }
    public function setIdetudiants($idetudiants){
        $this->idetudiants=$idetudiants;
    }
    public function setMatricule($matricule){
        $this->matricule=$matricule;
    }

    public function setSemestre($semestre)
    {
        $this->semestre=$semestre;
    }
    Public function getNationalite(){
        return $this->nationalite;
    }
    public function getIdetudiants(){
        return $this->idetudiants;
    }
    Public function getMatricule(){
        return $this->matricule;
    }
    public function getSemestre(){
        return $this->semestre;
    }
    Public function getEcolage(){
        return $this->ecolage;
    }
    public function getInscription(){
        return $this->inscription;
    }
    public function getExamen()
    {
        return $this->examen;
    }
    public function getSoutenance()
    {
        return $this->soutenance;
    }
    public function getRepechage()
    {
        return $this->repechage;
    }
    public function getCertificat()
    {
        return $this->certificat;
    }
    public function getMail(){
        return $this->email;
    }

    public function getNom(){
        return $this->nom;
    }
    public function getPrenom(){
        return $this->prenom;
    }
    public function getNumero(){
        return $this->numero;
    }

}
?>