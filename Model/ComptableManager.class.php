<?php

class ComptableManager{
protected $db;

public function __construct($db)
{
    $this->setDb($db);
}
public function setDb(PDO $db){
    $this->db=$db;
}

public function getAccess($data){
    $statement=$this->db->prepare('SELECT count(*) FROM `SCOLARITE` WHERE `MATRICULE`=:matricule AND `MDP`=:mdp');
    $statement->bindValue(":matricule",$data['matricule'],PDO::PARAM_STR);
    $statement->bindValue(":mdp",$data['mdp'],PDO::PARAM_STR);
    $statement->execute();
    $datareturn=$statement->fetch();
    $statement->closeCursor();
    return $datareturn;
}
public function listDateEntreeParVague(){
    $statement=$this->db->query("SELECT * FROM `CODECLASSE` WHERE `DATEDENTER`!='NULL'");
    $data=$statement->fetchAll(PDO::FETCH_ASSOC);
    $statement->closeCursor();
    return $data;
}

public function doRecovery(array $recoveryData){
    if(isset($recoveryData['inputdate'],$recoveryData['mounth'],$recoveryData['paiementstate'],$recoveryData['motif'])){
        if($recoveryData['motif']=="ecolage"){
            if($recoveryData['paiementstate']=="OUI"){
                $statement=$this->db->prepare("SELECT `SUIVRE`.`MATRICULE` `MATRICULE`,`ETUDIANTS`.`NOM` `NOM`,`ETUDIANTS`.`PRENOM` `PRENOM`,`ETUDIANTS`.`NUMERO` `NUMERO`,`SUIVRE`.`FILIERE` `FILIERE`,`SUIVRE`.`SEMESTRE` `SEMESTRE`,`SUIVRE`.`CODE` `CODE`,`SUIVRE`.`ECOLAGE` `ECOLAGE`,`SUIVRE`.`INSCRIPTION` `INSCRIPTION`,`SUIVRE`.`SOUTENANCE` `SOUTENANCE`,`SUIVRE`.`EXAMEN` `EXAMEN`,`SUIVRE`.`CERTIFICAT` `CERTIFICAT` FROM `SUIVRE` NATURAL JOIN `ETUDIANTS` NATURAL JOIN `CODECLASSE` WHERE `CODECLASSE`.`DATEDENTER`=:enterdate AND `SUIVRE`.`ECOLAGE`>=:nbremounth");
                $statement->bindValue(":enterdate",$recoveryData['inputdate'],PDO::PARAM_STR);
                $statement->bindValue(":nbremounth",$recoveryData['mounth'],PDO::PARAM_INT);
                $statement->execute();
               $data=$statement->fetchAll(PDO::FETCH_ASSOC);
               $statement->closeCursor();
               return $data;
    
            }else {
                $statement=$this->db->prepare("SELECT `SUIVRE`.`MATRICULE` `MATRICULE`,`ETUDIANTS`.`NOM` `NOM`,`ETUDIANTS`.`PRENOM` `PRENOM`,`ETUDIANTS`.`NUMERO` `NUMERO`,`SUIVRE`.`FILIERE` `FILIERE`,`SUIVRE`.`SEMESTRE` `SEMESTRE`,`SUIVRE`.`CODE` `CODE`,`SUIVRE`.`ECOLAGE` `ECOLAGE`,`SUIVRE`.`INSCRIPTION` `INSCRIPTION`,`SUIVRE`.`SOUTENANCE` `SOUTENANCE`,`SUIVRE`.`EXAMEN` `EXAMEN`,`SUIVRE`.`CERTIFICAT` `CERTIFICAT` FROM `SUIVRE` NATURAL JOIN `ETUDIANTS` NATURAL JOIN `CODECLASSE` WHERE `CODECLASSE`.`DATEDENTER`=:enterdate AND `SUIVRE`.`ECOLAGE`<:nbremounth");
                $statement->bindValue(":enterdate",$recoveryData['inputdate'],PDO::PARAM_STR);
                $statement->bindValue(":nbremounth",$recoveryData['mounth'],PDO::PARAM_INT);
                $statement->execute();
                $data=$statement->fetchAll(PDO::FETCH_ASSOC);
                $statement->closeCursor();
                return $data;
            }
            
        }elseif($recoveryData['motif']=="inscription"){
            if($recoveryData['paiementstate']=="OUI"){
                $statement=$this->db->prepare("SELECT `SUIVRE`.`MATRICULE` `MATRICULE`,`ETUDIANTS`.`NOM` `NOM`,`ETUDIANTS`.`PRENOM` `PRENOM`,`ETUDIANTS`.`NUMERO` `NUMERO`,`SUIVRE`.`FILIERE` `FILIERE`,`SUIVRE`.`SEMESTRE` `SEMESTRE`,`SUIVRE`.`CODE` `CODE`,`SUIVRE`.`ECOLAGE` `ECOLAGE`,`SUIVRE`.`INSCRIPTION` `INSCRIPTION`,`SUIVRE`.`SOUTENANCE` `SOUTENANCE`,`SUIVRE`.`EXAMEN` `EXAMEN`,`SUIVRE`.`CERTIFICAT` `CERTIFICAT` FROM `SUIVRE` NATURAL JOIN `ETUDIANTS` NATURAL JOIN `CODECLASSE` WHERE `CODECLASSE`.`DATEDENTER`=:enterdate AND `SUIVRE`.`INSCRIPTION`=1");
                $statement->bindValue(":enterdate",$recoveryData['inputdate'],PDO::PARAM_STR);
                $statement->execute();
                $data=$statement->fetchAll(PDO::FETCH_ASSOC);
                $statement->closeCursor();
                return $data;
            }else{
                $statement=$this->db->prepare("SELECT `SUIVRE`.`MATRICULE` `MATRICULE`,`ETUDIANTS`.`NOM` `NOM`,`ETUDIANTS`.`PRENOM` `PRENOM`,`ETUDIANTS`.`NUMERO` `NUMERO`,`SUIVRE`.`FILIERE` `FILIERE`,`SUIVRE`.`SEMESTRE` `SEMESTRE`,`SUIVRE`.`CODE` `CODE`,`SUIVRE`.`ECOLAGE` `ECOLAGE`,`SUIVRE`.`INSCRIPTION` `INSCRIPTION`,`SUIVRE`.`SOUTENANCE` `SOUTENANCE`,`SUIVRE`.`EXAMEN` `EXAMEN`,`SUIVRE`.`CERTIFICAT` `CERTIFICAT` FROM `SUIVRE` NATURAL JOIN `ETUDIANTS` NATURAL JOIN `CODECLASSE` WHERE `CODECLASSE`.`DATEDENTER`=:enterdate AND `SUIVRE`.`INSCRIPTION`!=1");
                $statement->bindValue(":enterdate",$recoveryData['inputdate'],PDO::PARAM_STR);
                $statement->execute();
                $data=$statement->fetchAll(PDO::FETCH_ASSOC);
                $statement->closeCursor();
                return $data;
            }
        }elseif($recoveryData['motif']=="soutenance"){
            if($recoveryData['paiementstate']=="OUI"){
                $statement=$this->db->prepare("SELECT `SUIVRE`.`MATRICULE` `MATRICULE`,`ETUDIANTS`.`NOM` `NOM`,`ETUDIANTS`.`PRENOM` `PRENOM`,`ETUDIANTS`.`NUMERO` `NUMERO`,`SUIVRE`.`FILIERE` `FILIERE`,`SUIVRE`.`SEMESTRE` `SEMESTRE`,`SUIVRE`.`CODE` `CODE`,`SUIVRE`.`ECOLAGE` `ECOLAGE`,`SUIVRE`.`INSCRIPTION` `INSCRIPTION`,`SUIVRE`.`SOUTENANCE` `SOUTENANCE`,`SUIVRE`.`EXAMEN` `EXAMEN`,`SUIVRE`.`CERTIFICAT` `CERTIFICAT` FROM `SUIVRE` NATURAL JOIN `ETUDIANTS` NATURAL JOIN `CODECLASSE` WHERE `CODECLASSE`.`DATEDENTER`=:enterdate AND `SUIVRE`.`SOUTENANCE`=1");
                $statement->bindValue(":enterdate",$recoveryData['inputdate'],PDO::PARAM_STR);
                $statement->execute();
                $data=$statement->fetchAll(PDO::FETCH_ASSOC);
                $statement->closeCursor();
                return $data;
    
            }else {
                $statement=$this->db->prepare("SELECT `SUIVRE`.`MATRICULE` `MATRICULE`,`ETUDIANTS`.`NOM` `NOM`,`ETUDIANTS`.`PRENOM` `PRENOM`,`ETUDIANTS`.`NUMERO` `NUMERO`,`SUIVRE`.`FILIERE` `FILIERE`,`SUIVRE`.`SEMESTRE` `SEMESTRE`,`SUIVRE`.`CODE` `CODE`,`SUIVRE`.`ECOLAGE` `ECOLAGE`,`SUIVRE`.`INSCRIPTION` `INSCRIPTION`,`SUIVRE`.`SOUTENANCE` `SOUTENANCE`,`SUIVRE`.`EXAMEN` `EXAMEN`,`SUIVRE`.`CERTIFICAT` `CERTIFICAT` FROM `SUIVRE` NATURAL JOIN `ETUDIANTS` NATURAL JOIN `CODECLASSE` WHERE `CODECLASSE`.`DATEDENTER`=:enterdate AND `SUIVRE`.`SOUTENANCE`!=1");
                $statement->bindValue(":enterdate",$recoveryData['inputdate'],PDO::PARAM_STR);
                $statement->execute();
                $data=$statement->fetchAll(PDO::FETCH_ASSOC);
                $statement->closeCursor();
                return $data;
            }
        }elseif($recoveryData['motif']=="examen"){
            if($recoveryData['paiementstate']=="OUI"){
                $statement=$this->db->prepare("SELECT `SUIVRE`.`MATRICULE` `MATRICULE`,`ETUDIANTS`.`NOM` `NOM`,`ETUDIANTS`.`PRENOM` `PRENOM`,`ETUDIANTS`.`NUMERO` `NUMERO`,`SUIVRE`.`FILIERE` `FILIERE`,`SUIVRE`.`SEMESTRE` `SEMESTRE`,`SUIVRE`.`CODE` `CODE`,`SUIVRE`.`ECOLAGE` `ECOLAGE`,`SUIVRE`.`INSCRIPTION` `INSCRIPTION`,`SUIVRE`.`SOUTENANCE` `SOUTENANCE`,`SUIVRE`.`EXAMEN` `EXAMEN`,`SUIVRE`.`CERTIFICAT` `CERTIFICAT` FROM `SUIVRE` NATURAL JOIN `ETUDIANTS` NATURAL JOIN `CODECLASSE` WHERE `CODECLASSE`.`DATEDENTER`=:enterdate AND `SUIVRE`.`EXAMEN`=1");
                $statement->bindValue(":enterdate",$recoveryData['inputdate'],PDO::PARAM_STR);
                $statement->execute();
                $data=$statement->fetchAll(PDO::FETCH_ASSOC);
                $statement->closeCursor();
                return $data;
    
            }else {
                $statement=$this->db->prepare("SELECT `SUIVRE`.`MATRICULE` `MATRICULE`,`ETUDIANTS`.`NOM` `NOM`,`ETUDIANTS`.`PRENOM` `PRENOM`,`ETUDIANTS`.`NUMERO` `NUMERO`,`SUIVRE`.`FILIERE` `FILIERE`,`SUIVRE`.`SEMESTRE` `SEMESTRE`,`SUIVRE`.`CODE` `CODE`,`SUIVRE`.`ECOLAGE` `ECOLAGE`,`SUIVRE`.`INSCRIPTION` `INSCRIPTION`,`SUIVRE`.`SOUTENANCE` `SOUTENANCE`,`SUIVRE`.`EXAMEN` `EXAMEN`,`SUIVRE`.`CERTIFICAT` `CERTIFICAT` FROM `SUIVRE` NATURAL JOIN `ETUDIANTS` NATURAL JOIN `CODECLASSE` WHERE `CODECLASSE`.`DATEDENTER`=:enterdate AND `SUIVRE`.`EXAMEN`!=1");
                $statement->bindValue(":enterdate",$recoveryData['inputdate'],PDO::PARAM_STR);
                $statement->execute();
                $data=$statement->fetchAll(PDO::FETCH_ASSOC);
                $statement->closeCursor();
                return $data;
            }
        }elseif($recoveryData['motif']=="certificat"){
            if($recoveryData['paiementstate']=="OUI"){
                $statement=$this->db->prepare("SELECT `SUIVRE`.`MATRICULE` `MATRICULE`,`ETUDIANTS`.`NOM` `NOM`,`ETUDIANTS`.`PRENOM` `PRENOM`,`ETUDIANTS`.`NUMERO` `NUMERO`,`SUIVRE`.`FILIERE` `FILIERE`,`SUIVRE`.`SEMESTRE` `SEMESTRE`,`SUIVRE`.`CODE` `CODE`,`SUIVRE`.`ECOLAGE` `ECOLAGE`,`SUIVRE`.`INSCRIPTION` `INSCRIPTION`,`SUIVRE`.`SOUTENANCE` `SOUTENANCE`,`SUIVRE`.`EXAMEN` `EXAMEN`,`SUIVRE`.`CERTIFICAT` `CERTIFICAT` FROM `SUIVRE` NATURAL JOIN `ETUDIANTS` NATURAL JOIN `CODECLASSE` WHERE `CODECLASSE`.`DATEDENTER`=:enterdate AND `SUIVRE`.`CERTIFICAT`!=0");
                $statement->bindValue(":enterdate",$recoveryData['inputdate'],PDO::PARAM_STR);
                $statement->execute();
                $data=$statement->fetchAll(PDO::FETCH_ASSOC);
                $statement->closeCursor();
                return $data;
    
            }else {
                $statement=$this->db->prepare("SELECT `SUIVRE`.`MATRICULE` `MATRICULE`,`ETUDIANTS`.`NOM` `NOM`,`ETUDIANTS`.`PRENOM` `PRENOM`,`ETUDIANTS`.`NUMERO` `NUMERO`,`SUIVRE`.`FILIERE` `FILIERE`,`SUIVRE`.`SEMESTRE` `SEMESTRE`,`SUIVRE`.`CODE` `CODE`,`SUIVRE`.`ECOLAGE` `ECOLAGE`,`SUIVRE`.`INSCRIPTION` `INSCRIPTION`,`SUIVRE`.`SOUTENANCE` `SOUTENANCE`,`SUIVRE`.`EXAMEN` `EXAMEN`,`SUIVRE`.`CERTIFICAT` `CERTIFICAT` FROM `SUIVRE` NATURAL JOIN `ETUDIANTS` NATURAL JOIN `CODECLASSE` WHERE `CODECLASSE`.`DATEDENTER`=:enterdate AND `SUIVRE`.`CERTIFICAT`=0");
                $statement->bindValue(":enterdate",$recoveryData['inputdate'],PDO::PARAM_STR);
                $statement->execute();
                $data=$statement->fetchAll(PDO::FETCH_ASSOC);
                $statement->closeCursor();
                return $data;
            }
        }
  
    
    }
}
}

?>