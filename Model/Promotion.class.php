<?php
final class Promotion{
    protected $codepromo;
    protected $utilise;

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
    public function generatePromo(){
        $cle=random_int(1,786);
        $this->codepromo=str_shuffle("3M3D14Pr0Mau1NsRi".$cle);
    }

    public function setCodepromo($codepromo){
        $this->codepromo=$codepromo;
    }
    public function setUtilise($utilite){
        $this->utilise=$utilite;
    }
    public function getCodepromo(){
        return $this->codepromo;
    }
    public function getUtilise(){
        return $this->utilise;
    }
    
}
?>