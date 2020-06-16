<?php
class Comptable{
    protected $matricule;
    protected $mdp;

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

    public function getMdp(){
        return $this->mdp;
    }
    public function getMatriule(){
        return $this->matricule;
    }
    public function setMdp($mdp){
        $this->mdp=$mdp;
    }

    public function setMatricule($matricule){
        $this->matricule=$matricule;
    }

}
?>