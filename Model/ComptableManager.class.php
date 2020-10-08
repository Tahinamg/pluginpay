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

public function doClassificationMvola(array $classification){
    if(gettype($classification)!="array"){
        throw new Exception("the parameter must be a array");
    }
    if(isset($classification["datevalidation"])){
        if($classification["motif"]!='' && $classification["nationalite"]!=""){
            if($classification["nationalite"]=="MG"){
                $requete=$this->db->prepare("SELECT MATRICULE,NOM,PRENOM,MAIL,NUMERO,DATESERVER,DATY,MONTANT,REFERENCE,OBSERVATION,DATEVALIDATION,TEMPSVALIDATION,NATIONALITE,MOTIF FROM (MOBILEMONEY LEFT OUTER JOIN ETUDIANTS ON MOBILEMONEY.IDETUDIANTS=ETUDIANTS.IDETUDIANTS) LEFT OUTER JOIN SUIVRE ON MOBILEMONEY.IDETUDIANTS=SUIVRE.IDETUDIANTS  WHERE DATEVALIDATION=:datevalidation AND MOTIF=:motif AND NATIONALITE='MG'");
            }else{
                $requete=$this->db->prepare("SELECT MATRICULE,NOM,PRENOM,MAIL,NUMERO,DATESERVER,DATY,MONTANT,REFERENCE,OBSERVATION,DATEVALIDATION,TEMPSVALIDATION,NATIONALITE,MOTIF FROM (MOBILEMONEY LEFT OUTER JOIN ETUDIANTS ON MOBILEMONEY.IDETUDIANTS=ETUDIANTS.IDETUDIANTS) LEFT OUTER JOIN SUIVRE ON MOBILEMONEY.IDETUDIANTS=SUIVRE.IDETUDIANTS  WHERE DATEVALIDATION=:datevalidation AND MOTIF=:motif AND NATIONALITE!='MG'");
            }
            $requete->bindValue(":datevalidation",$classification["datevalidation"],PDO::PARAM_STR);
            $requete->bindValue(":motif",$classification["motif"],PDO::PARAM_STR);
            $requete->execute();
            return $requete->fetchAll(PDO::FETCH_ASSOC);
        }elseif(!empty($classification["motif"])){
            $requete=$this->db->prepare("SELECT MATRICULE,NOM,PRENOM,MAIL,NUMERO,DATESERVER,DATY,MONTANT,REFERENCE,OBSERVATION,DATEVALIDATION,TEMPSVALIDATION,NATIONALITE,MOTIF FROM (MOBILEMONEY LEFT OUTER JOIN ETUDIANTS ON MOBILEMONEY.IDETUDIANTS=ETUDIANTS.IDETUDIANTS) LEFT OUTER JOIN SUIVRE ON MOBILEMONEY.IDETUDIANTS=SUIVRE.IDETUDIANTS  WHERE DATEVALIDATION=:datevalidation AND MOTIF=:motif ");
            $requete->bindValue(":datevalidation",$classification["datevalidation"],PDO::PARAM_STR);
            $requete->bindValue(":motif",$classification["motif"],PDO::PARAM_STR);
            $requete->execute();
            return $requete->fetchAll(PDO::FETCH_ASSOC);
        }elseif(!empty($classification["nationalite"])){
            if($classification["nationalite"]=="MG"){
                $requete=$this->db->prepare("SELECT MATRICULE,NOM,PRENOM,MAIL,NUMERO,DATESERVER,DATY,MONTANT,REFERENCE,OBSERVATION,DATEVALIDATION,TEMPSVALIDATION,NATIONALITE,MOTIF FROM (MOBILEMONEY LEFT OUTER JOIN ETUDIANTS ON MOBILEMONEY.IDETUDIANTS=ETUDIANTS.IDETUDIANTS) LEFT OUTER JOIN SUIVRE ON MOBILEMONEY.IDETUDIANTS=SUIVRE.IDETUDIANTS  WHERE DATEVALIDATION=:datevalidation AND NATIONALITE='MG'");
            }else{
                $requete=$this->db->prepare("SELECT MATRICULE,NOM,PRENOM,MAIL,NUMERO,DATESERVER,DATY,MONTANT,REFERENCE,OBSERVATION,DATEVALIDATION,TEMPSVALIDATION,NATIONALITE,MOTIF FROM (MOBILEMONEY LEFT OUTER JOIN ETUDIANTS ON MOBILEMONEY.IDETUDIANTS=ETUDIANTS.IDETUDIANTS) LEFT OUTER JOIN SUIVRE ON MOBILEMONEY.IDETUDIANTS=SUIVRE.IDETUDIANTS  WHERE DATEVALIDATION=:datevalidation AND NATIONALITE!='MG'");
            }
            $requete->bindValue(":datevalidation",$classification["datevalidation"],PDO::PARAM_STR);
            $requete->execute();
            return $requete->fetchAll(PDO::FETCH_ASSOC);
        }else{
            $requete=$this->db->prepare("SELECT MATRICULE,NOM,PRENOM,MAIL,NUMERO,DATESERVER,DATY,MONTANT,REFERENCE,OBSERVATION,DATEVALIDATION,TEMPSVALIDATION,NATIONALITE,MOTIF FROM (MOBILEMONEY LEFT OUTER JOIN ETUDIANTS ON MOBILEMONEY.IDETUDIANTS=ETUDIANTS.IDETUDIANTS) LEFT OUTER JOIN SUIVRE ON MOBILEMONEY.IDETUDIANTS=SUIVRE.IDETUDIANTS  WHERE DATEVALIDATION=:datevalidation");
            $requete->bindValue(":datevalidation",$classification["datevalidation"],PDO::PARAM_STR);
            $requete->execute();
            return $requete->fetchAll(PDO::FETCH_ASSOC);
        }
        
    }

    
}


public function doClassificationCheque(array $classification){
    if(gettype($classification)!="array"){
        throw new Exception("the parameter must be a array");
    }
    if(isset($classification["datevalidation"])){
        if($classification["motif"]!='' && $classification["nationalite"]!=""){
            if($classification["nationalite"]=="MG"){
                $requete=$this->db->prepare("SELECT MATRICULE,NOM,PRENOM,MAIL,NUMERO,DATESERVER,MONTANT,TIREUR,ETABLISSEMENT,NCHEQUE,OBSERVATION,DATEVALIDATION,TEMPSVALIDATION,NATIONALITE,MOTIF FROM (CHEQUE LEFT OUTER JOIN ETUDIANTS ON CHEQUE.IDETUDIANTS=ETUDIANTS.IDETUDIANTS) LEFT OUTER JOIN SUIVRE ON CHEQUE.IDETUDIANTS=SUIVRE.IDETUDIANTS  WHERE DATEVALIDATION=:datevalidation AND MOTIF=:motif AND NATIONALITE='MG'");
            }else{
                $requete=$this->db->prepare("SELECT MATRICULE,NOM,PRENOM,MAIL,NUMERO,DATESERVER,MONTANT,TIREUR,ETABLISSEMENT,NCHEQUE,OBSERVATION,DATEVALIDATION,TEMPSVALIDATION,NATIONALITE,MOTIF FROM (CHEQUE LEFT OUTER JOIN ETUDIANTS ON CHEQUE.IDETUDIANTS=ETUDIANTS.IDETUDIANTS) LEFT OUTER JOIN SUIVRE ON CHEQUE.IDETUDIANTS=SUIVRE.IDETUDIANTS  WHERE DATEVALIDATION=:datevalidation AND MOTIF=:motif AND NATIONALITE!='MG'");
            }
            $requete->bindValue(":datevalidation",$classification["datevalidation"],PDO::PARAM_STR);
            $requete->bindValue(":motif",$classification["motif"],PDO::PARAM_STR);
            $requete->execute();
            return $requete->fetchAll(PDO::FETCH_ASSOC);
        }elseif(!empty($classification["motif"])){
            $requete=$this->db->prepare("SELECT MATRICULE,NOM,PRENOM,MAIL,NUMERO,DATESERVER,MONTANT,TIREUR,ETABLISSEMENT,NCHEQUE,OBSERVATION,DATEVALIDATION,TEMPSVALIDATION,NATIONALITE,MOTIF FROM (CHEQUE LEFT OUTER JOIN ETUDIANTS ON CHEQUE.IDETUDIANTS=ETUDIANTS.IDETUDIANTS) LEFT OUTER JOIN SUIVRE ON CHEQUE.IDETUDIANTS=SUIVRE.IDETUDIANTS  WHERE DATEVALIDATION=:datevalidation AND MOTIF=:motif");
            $requete->bindValue(":datevalidation",$classification["datevalidation"],PDO::PARAM_STR);
            $requete->bindValue(":motif",$classification["motif"],PDO::PARAM_STR);
            $requete->execute();
            return $requete->fetchAll(PDO::FETCH_ASSOC);
        }elseif(!empty($classification["nationalite"])){
            if($classification["nationalite"]=="MG"){
                $requete=$this->db->prepare("SELECT MATRICULE,NOM,PRENOM,MAIL,NUMERO,DATESERVER,MONTANT,TIREUR,ETABLISSEMENT,NCHEQUE,OBSERVATION,DATEVALIDATION,TEMPSVALIDATION,NATIONALITE,MOTIF FROM (CHEQUE LEFT OUTER JOIN ETUDIANTS ON CHEQUE.IDETUDIANTS=ETUDIANTS.IDETUDIANTS) LEFT OUTER JOIN SUIVRE ON CHEQUE.IDETUDIANTS=SUIVRE.IDETUDIANTS  WHERE DATEVALIDATION=:datevalidation AND NATIONALITE='MG'");
            }else{
                $requete=$this->db->prepare("SELECT MATRICULE,NOM,PRENOM,MAIL,NUMERO,DATESERVER,MONTANT,TIREUR,ETABLISSEMENT,NCHEQUE,OBSERVATION,DATEVALIDATION,TEMPSVALIDATION,NATIONALITE,MOTIF FROM (CHEQUE LEFT OUTER JOIN ETUDIANTS ON CHEQUE.IDETUDIANTS=ETUDIANTS.IDETUDIANTS) LEFT OUTER JOIN SUIVRE ON CHEQUE.IDETUDIANTS=SUIVRE.IDETUDIANTS  WHERE DATEVALIDATION=:datevalidation AND NATIONALITE!='MG'");
            }
            $requete->bindValue(":datevalidation",$classification["datevalidation"],PDO::PARAM_STR);
            $requete->execute();
            return $requete->fetchAll(PDO::FETCH_ASSOC);
        }else{
            $requete=$this->db->prepare("SELECT MATRICULE,NOM,PRENOM,MAIL,NUMERO,DATESERVER,MONTANT,TIREUR,ETABLISSEMENT,NCHEQUE,OBSERVATION,DATEVALIDATION,TEMPSVALIDATION,NATIONALITE,MOTIF FROM (CHEQUE LEFT OUTER JOIN ETUDIANTS ON CHEQUE.IDETUDIANTS=ETUDIANTS.IDETUDIANTS) LEFT OUTER JOIN SUIVRE ON CHEQUE.IDETUDIANTS=SUIVRE.IDETUDIANTS  WHERE DATEVALIDATION=:datevalidation");
            $requete->bindValue(":datevalidation",$classification["datevalidation"],PDO::PARAM_STR);
            $requete->execute();
            return $requete->fetchAll(PDO::FETCH_ASSOC);
        }
        
    }

    
}

public function doClassificationMoneyGram(array $classification){
    if(gettype($classification)!="array"){
        throw new Exception("the parameter must be a array");
    }
    if(isset($classification["datevalidation"])){
        if($classification["motif"]!='' && $classification["nationalite"]!=""){
            if($classification["datevalidation"]=="MG"){
                $requete=$this->db->prepare("SELECT MATRICULE,NOM,PRENOM,MAIL,NUMERO,DATESERVER,DATYMONEYGRAM,REFERENCE,EXPEDITEUR,MONTANTMONEYGRAM,MONTANT,OBSERVATION,DATEVALIDATION,TEMPSVALIDATION,NATIONALITE,MOTIF FROM (MONEYGRAM LEFT OUTER JOIN ETUDIANTS ON MONEYGRAM.IDETUDIANTS=ETUDIANTS.IDETUDIANTS) LEFT OUTER JOIN SUIVRE ON MONEYGRAM.IDETUDIANTS=SUIVRE.IDETUDIANTS  WHERE DATEVALIDATION=:datevalidation AND MOTIF=:motif AND NATIONALITE='MG'");
            }else{
                $requete=$this->db->prepare("SELECT MATRICULE,NOM,PRENOM,MAIL,NUMERO,DATESERVER,DATYMONEYGRAM,REFERENCE,EXPEDITEUR,MONTANTMONEYGRAM,MONTANT,OBSERVATION,DATEVALIDATION,TEMPSVALIDATION,NATIONALITE,MOTIF FROM (MONEYGRAM LEFT OUTER JOIN ETUDIANTS ON MONEYGRAM.IDETUDIANTS=ETUDIANTS.IDETUDIANTS) LEFT OUTER JOIN SUIVRE ON MONEYGRAM.IDETUDIANTS=SUIVRE.IDETUDIANTS  WHERE DATEVALIDATION=:datevalidation AND MOTIF=:motif AND NATIONALITE!='MG'");
            }
            $requete->bindValue(":datevalidation",$classification["datevalidation"],PDO::PARAM_STR);
            $requete->bindValue(":motif",$classification["motif"],PDO::PARAM_STR);
            $requete->execute();
            return $requete->fetchAll(PDO::FETCH_ASSOC);
        }elseif(!empty($classification["motif"])){
            $requete=$this->db->prepare("SELECT MATRICULE,NOM,PRENOM,MAIL,NUMERO,DATESERVER,DATYMONEYGRAM,REFERENCE,EXPEDITEUR,MONTANTMONEYGRAM,MONTANT,OBSERVATION,DATEVALIDATION,TEMPSVALIDATION,NATIONALITE,MOTIF FROM (MONEYGRAM LEFT OUTER JOIN ETUDIANTS ON MONEYGRAM.IDETUDIANTS=ETUDIANTS.IDETUDIANTS) LEFT OUTER JOIN SUIVRE ON MONEYGRAM.IDETUDIANTS=SUIVRE.IDETUDIANTS  WHERE DATEVALIDATION=:datevalidation AND MOTIF=:motif");
            $requete->bindValue(":datevalidation",$classification["datevalidation"],PDO::PARAM_STR);
            $requete->bindValue(":motif",$classification["motif"],PDO::PARAM_STR);
            $requete->execute();
            return $requete->fetchAll(PDO::FETCH_ASSOC);
        }elseif(!empty($classification["nationalite"])){
            if($classification["nationalite"]=="MG"){
                $requete=$this->db->prepare("SELECT MATRICULE,NOM,PRENOM,MAIL,NUMERO,DATESERVER,DATYMONEYGRAM,REFERENCE,EXPEDITEUR,MONTANTMONEYGRAM,MONTANT,OBSERVATION,DATEVALIDATION,TEMPSVALIDATION,NATIONALITE,MOTIF FROM (MONEYGRAM LEFT OUTER JOIN ETUDIANTS ON MONEYGRAM.IDETUDIANTS=ETUDIANTS.IDETUDIANTS) LEFT OUTER JOIN SUIVRE ON MONEYGRAM.IDETUDIANTS=SUIVRE.IDETUDIANTS  WHERE DATEVALIDATION=:datevalidation AND NATIONALITE='MG'");
            }else{
                $requete=$this->db->prepare("SELECT MATRICULE,NOM,PRENOM,MAIL,NUMERO,DATESERVER,DATYMONEYGRAM,REFERENCE,EXPEDITEUR,MONTANTMONEYGRAM,MONTANT,OBSERVATION,DATEVALIDATION,TEMPSVALIDATION,NATIONALITE,MOTIF FROM (MONEYGRAM LEFT OUTER JOIN ETUDIANTS ON MONEYGRAM.IDETUDIANTS=ETUDIANTS.IDETUDIANTS) LEFT OUTER JOIN SUIVRE ON MONEYGRAM.IDETUDIANTS=SUIVRE.IDETUDIANTS  WHERE DATEVALIDATION=:datevalidation AND NATIONALITE!='MG'");
            }
            $requete->bindValue(":datevalidation",$classification["datevalidation"],PDO::PARAM_STR);
            $requete->execute();
            return $requete->fetchAll(PDO::FETCH_ASSOC);
        }else{
            $requete=$this->db->prepare("SELECT MATRICULE,NOM,PRENOM,MAIL,NUMERO,DATESERVER,DATYMONEYGRAM,REFERENCE,EXPEDITEUR,MONTANTMONEYGRAM,MONTANT,OBSERVATION,DATEVALIDATION,TEMPSVALIDATION,NATIONALITE,MOTIF FROM (MONEYGRAM LEFT OUTER JOIN ETUDIANTS ON MONEYGRAM.IDETUDIANTS=ETUDIANTS.IDETUDIANTS) LEFT OUTER JOIN SUIVRE ON MONEYGRAM.IDETUDIANTS=SUIVRE.IDETUDIANTS  WHERE DATEVALIDATION=:datevalidation");
            $requete->bindValue(":datevalidation",$classification["datevalidation"],PDO::PARAM_STR);
            $requete->execute();
            return $requete->fetchAll(PDO::FETCH_ASSOC);
        }
        
    }
}

public function doClassificationVersement(array $classification){
    if(gettype($classification)!="array"){
        throw new Exception("the parameter must be a array");
    }
    if(isset($classification["datevalidation"])){
        if($classification["motif"]!='' && $classification["nationalite"]!=""){
            if($classification["nationalite"]=="MG"){
              $requete=$this->db->prepare("SELECT MATRICULE,NOM,PRENOM,MAIL,NUMERO,DATESERVER,DATEVERSEMENT,AGENCE,NBORDEREAUX,MONTANT,OBSERVATION,DATEVALIDATION,TEMPSVALIDATION,NATIONALITE,MOTIF FROM (VERSEMENT LEFT OUTER JOIN ETUDIANTS ON VERSEMENT.IDETUDIANTS=ETUDIANTS.IDETUDIANTS) LEFT OUTER JOIN SUIVRE ON VERSEMENT.IDETUDIANTS=SUIVRE.IDETUDIANTS  WHERE DATEVALIDATION=:datevalidation AND MOTIF=:motif AND NATIONALITE='MG'");  
            }else{
                $requete=$this->db->prepare("SELECT MATRICULE,NOM,PRENOM,MAIL,NUMERO,DATESERVER,DATEVERSEMENT,AGENCE,NBORDEREAUX,MONTANT,OBSERVATION,DATEVALIDATION,TEMPSVALIDATION,NATIONALITE,MOTIF FROM (VERSEMENT LEFT OUTER JOIN ETUDIANTS ON VERSEMENT.IDETUDIANTS=ETUDIANTS.IDETUDIANTS) LEFT OUTER JOIN SUIVRE ON VERSEMENT.IDETUDIANTS=SUIVRE.IDETUDIANTS  WHERE DATEVALIDATION=:datevalidation AND MOTIF=:motif AND NATIONALITE!='MG'");  
            }
            
            $requete->bindValue(":datevalidation",$classification["datevalidation"],PDO::PARAM_STR);
            $requete->bindValue(":motif",$classification["motif"],PDO::PARAM_STR);
            $requete->execute();
            return $requete->fetchAll(PDO::FETCH_ASSOC);
        }elseif(!empty($classification["motif"])){
            $requete=$this->db->prepare("SELECT MATRICULE,NOM,PRENOM,MAIL,NUMERO,DATESERVER,DATEVERSEMENT,AGENCE,NBORDEREAUX,MONTANT,OBSERVATION,DATEVALIDATION,TEMPSVALIDATION,NATIONALITE,MOTIF FROM (VERSEMENT LEFT OUTER JOIN ETUDIANTS ON VERSEMENT.IDETUDIANTS=ETUDIANTS.IDETUDIANTS) LEFT OUTER JOIN SUIVRE ON VERSEMENT.IDETUDIANTS=SUIVRE.IDETUDIANTS  WHERE DATEVALIDATION=:datevalidation AND MOTIF=:motif");
            $requete->bindValue(":datevalidation",$classification["datevalidation"],PDO::PARAM_STR);
            $requete->bindValue(":motif",$classification["motif"],PDO::PARAM_STR);
            $requete->execute();
            return $requete->fetchAll(PDO::FETCH_ASSOC);
        }elseif(!empty($classification["nationalite"])){
            if($classification["nationalite"]=="MG"){
                $requete=$this->db->prepare("SELECT MATRICULE,NOM,PRENOM,MAIL,NUMERO,DATESERVER,DATEVERSEMENT,AGENCE,NBORDEREAUX,MONTANT,OBSERVATION,DATEVALIDATION,TEMPSVALIDATION,NATIONALITE,MOTIF FROM (VERSEMENT LEFT OUTER JOIN ETUDIANTS ON VERSEMENT.IDETUDIANTS=ETUDIANTS.IDETUDIANTS) LEFT OUTER JOIN SUIVRE ON VERSEMENT.IDETUDIANTS=SUIVRE.IDETUDIANTS  WHERE DATEVALIDATION=:datevalidation AND NATIONALITE='MG'");
            }else{
                $requete=$this->db->prepare("SELECT MATRICULE,NOM,PRENOM,MAIL,NUMERO,DATESERVER,DATEVERSEMENT,AGENCE,NBORDEREAUX,MONTANT,OBSERVATION,DATEVALIDATION,TEMPSVALIDATION,NATIONALITE,MOTIF FROM (VERSEMENT LEFT OUTER JOIN ETUDIANTS ON VERSEMENT.IDETUDIANTS=ETUDIANTS.IDETUDIANTS) LEFT OUTER JOIN SUIVRE ON VERSEMENT.IDETUDIANTS=SUIVRE.IDETUDIANTS  WHERE DATEVALIDATION=:datevalidation AND NATIONALITE!='MG'");
            }
            $requete->bindValue(":datevalidation",$classification["datevalidation"],PDO::PARAM_STR);
            $requete->execute();
            return $requete->fetchAll(PDO::FETCH_ASSOC);
        }else{
            $requete=$this->db->prepare("SELECT MATRICULE,NOM,PRENOM,MAIL,NUMERO,DATESERVER,DATEVERSEMENT,AGENCE,NBORDEREAUX,MONTANT,OBSERVATION,DATEVALIDATION,TEMPSVALIDATION,NATIONALITE,MOTIF FROM (VERSEMENT LEFT OUTER JOIN ETUDIANTS ON VERSEMENT.IDETUDIANTS=ETUDIANTS.IDETUDIANTS) LEFT OUTER JOIN SUIVRE ON VERSEMENT.IDETUDIANTS=SUIVRE.IDETUDIANTS  WHERE DATEVALIDATION=:datevalidation");
            $requete->bindValue(":datevalidation",$classification["datevalidation"],PDO::PARAM_STR);
            $requete->execute();
            return $requete->fetchAll(PDO::FETCH_ASSOC);
        }
        
    }
}

public function doClassificationVirement(array $classification){
    if(gettype($classification)!="array"){
        throw new Exception("the parameter must be a array");
    }
    if(isset($classification["datevalidation"])){
        if($classification["motif"]!='' && $classification["nationalite"]!=""){
            if($classification["nationalite"]=="MG"){
                $requete=$this->db->prepare("SELECT MATRICULE,NOM,PRENOM,MAIL,NUMERO,DATESERVER,DATEVIREMENT,NCOMPTE,TITUCOMPTE,MONTANT,OBSERVATION,DATEVALIDATION,TEMPSVALIDATION,NATIONALITE,MOTIF FROM (VIREMENT LEFT OUTER JOIN ETUDIANTS ON VIREMENT.IDETUDIANTS=ETUDIANTS.IDETUDIANTS) LEFT OUTER JOIN SUIVRE ON VIREMENT.IDETUDIANTS=SUIVRE.IDETUDIANTS  WHERE DATEVALIDATION=:datevalidation AND MOTIF=:motif AND NATIONALITE='MG'");
            }else{
                $requete=$this->db->prepare("SELECT MATRICULE,NOM,PRENOM,MAIL,NUMERO,DATESERVER,DATEVIREMENT,NCOMPTE,TITUCOMPTE,MONTANT,OBSERVATION,DATEVALIDATION,TEMPSVALIDATION,NATIONALITE,MOTIF FROM (VIREMENT LEFT OUTER JOIN ETUDIANTS ON VIREMENT.IDETUDIANTS=ETUDIANTS.IDETUDIANTS) LEFT OUTER JOIN SUIVRE ON VIREMENT.IDETUDIANTS=SUIVRE.IDETUDIANTS  WHERE DATEVALIDATION=:datevalidation AND MOTIF=:motif AND NATIONALITE!='MG'");
            }
            $requete->bindValue(":datevalidation",$classification["datevalidation"],PDO::PARAM_STR);
            $requete->bindValue(":motif",$classification["motif"],PDO::PARAM_STR);
            $requete->execute();
            return $requete->fetchAll(PDO::FETCH_ASSOC);
        }elseif(!empty($classification["motif"])){
            $requete=$this->db->prepare("SELECT MATRICULE,NOM,PRENOM,MAIL,NUMERO,DATESERVER,DATEVIREMENT,NCOMPTE,TITUCOMPTE,MONTANT,OBSERVATION,DATEVALIDATION,TEMPSVALIDATION,NATIONALITE,MOTIF FROM (VIREMENT LEFT OUTER JOIN ETUDIANTS ON VIREMENT.IDETUDIANTS=ETUDIANTS.IDETUDIANTS) LEFT OUTER JOIN SUIVRE ON VIREMENT.IDETUDIANTS=SUIVRE.IDETUDIANTS  WHERE DATEVALIDATION=:datevalidation AND MOTIF=:motif");
            $requete->bindValue(":datevalidation",$classification["datevalidation"],PDO::PARAM_STR);
            $requete->bindValue(":motif",$classification["motif"],PDO::PARAM_STR);
            $requete->execute();
            return $requete->fetchAll(PDO::FETCH_ASSOC);
        }elseif(!empty($classification["nationalite"])){
            if($classification["nationalite"]=="MG"){
                $requete=$this->db->prepare("SELECT MATRICULE,NOM,PRENOM,MAIL,NUMERO,DATESERVER,DATEVIREMENT,NCOMPTE,TITUCOMPTE,MONTANT,OBSERVATION,DATEVALIDATION,TEMPSVALIDATION,NATIONALITE,MOTIF FROM (VIREMENT LEFT OUTER JOIN ETUDIANTS ON VIREMENT.IDETUDIANTS=ETUDIANTS.IDETUDIANTS) LEFT OUTER JOIN SUIVRE ON VIREMENT.IDETUDIANTS=SUIVRE.IDETUDIANTS  WHERE DATEVALIDATION=:datevalidation AND NATIONALITE='MG'");
            }else{
                $requete=$this->db->prepare("SELECT MATRICULE,NOM,PRENOM,MAIL,NUMERO,DATESERVER,DATEVIREMENT,NCOMPTE,TITUCOMPTE,MONTANT,OBSERVATION,DATEVALIDATION,TEMPSVALIDATION,NATIONALITE,MOTIF FROM (VIREMENT LEFT OUTER JOIN ETUDIANTS ON VIREMENT.IDETUDIANTS=ETUDIANTS.IDETUDIANTS) LEFT OUTER JOIN SUIVRE ON VIREMENT.IDETUDIANTS=SUIVRE.IDETUDIANTS  WHERE DATEVALIDATION=:datevalidation AND NATIONALITE!='MG'");
            }
            $requete->bindValue(":datevalidation",$classification["datevalidation"],PDO::PARAM_STR);
            $requete->execute();
            return $requete->fetchAll(PDO::FETCH_ASSOC);
        }else{
            $requete=$this->db->prepare("SELECT MATRICULE,NOM,PRENOM,MAIL,NUMERO,DATESERVER,DATEVIREMENT,NCOMPTE,TITUCOMPTE,MONTANT,OBSERVATION,DATEVALIDATION,TEMPSVALIDATION,NATIONALITE,MOTIF FROM (VIREMENT LEFT OUTER JOIN ETUDIANTS ON VIREMENT.IDETUDIANTS=ETUDIANTS.IDETUDIANTS) LEFT OUTER JOIN SUIVRE ON VIREMENT.IDETUDIANTS=SUIVRE.IDETUDIANTS  WHERE DATEVALIDATION=:datevalidation");
            $requete->bindValue(":datevalidation",$classification["datevalidation"],PDO::PARAM_STR);
            $requete->execute();
            return $requete->fetchAll(PDO::FETCH_ASSOC);
        }
        
    }
}

public function doClassificationWestern(array $classification){
    if(gettype($classification)!="array"){
        throw new Exception("the parameter must be a array");
    }
    if(isset($classification["datevalidation"])){
        if($classification["motif"]!='' && $classification["nationalite"]!=""){
            if($classification["nationalite"]=="MG"){
                $requete=$this->db->prepare("SELECT MATRICULE,NOM,PRENOM,MAIL,NUMERO,DATESERVER,MONTANTWESTERN,MONTANT,NSUIVI,NOMEXP,OBSERVATION,DATEVALIDATION,TEMPSVALIDATION,NATIONALITE,MOTIF FROM (WESTERN LEFT OUTER JOIN ETUDIANTS ON WESTERN.IDETUDIANTS=ETUDIANTS.IDETUDIANTS) LEFT OUTER JOIN SUIVRE ON WESTERN.IDETUDIANTS=SUIVRE.IDETUDIANTS  WHERE DATEVALIDATION=:datevalidation AND MOTIF=:motif AND NATIONALITE='MG'");
            }else{
                $requete=$this->db->prepare("SELECT MATRICULE,NOM,PRENOM,MAIL,NUMERO,DATESERVER,MONTANTWESTERN,MONTANT,NSUIVI,NOMEXP,OBSERVATION,DATEVALIDATION,TEMPSVALIDATION,NATIONALITE,MOTIF FROM (WESTERN LEFT OUTER JOIN ETUDIANTS ON WESTERN.IDETUDIANTS=ETUDIANTS.IDETUDIANTS) LEFT OUTER JOIN SUIVRE ON WESTERN.IDETUDIANTS=SUIVRE.IDETUDIANTS  WHERE DATEVALIDATION=:datevalidation AND MOTIF=:motif AND NATIONALITE!='MG'");
            }
            $requete->bindValue(":datevalidation",$classification["datevalidation"],PDO::PARAM_STR);
            $requete->bindValue(":motif",$classification["motif"],PDO::PARAM_STR);
            $requete->execute();
            return $requete->fetchAll(PDO::FETCH_ASSOC);
        }elseif(!empty($classification["motif"])){
            $requete=$this->db->prepare("SELECT MATRICULE,NOM,PRENOM,MAIL,NUMERO,DATESERVER,MONTANTWESTERN,MONTANT,NSUIVI,NOMEXP,OBSERVATION,DATEVALIDATION,TEMPSVALIDATION,NATIONALITE,MOTIF FROM (WESTERN LEFT OUTER JOIN ETUDIANTS ON WESTERN.IDETUDIANTS=ETUDIANTS.IDETUDIANTS) LEFT OUTER JOIN SUIVRE ON WESTERN.IDETUDIANTS=SUIVRE.IDETUDIANTS  WHERE DATEVALIDATION=:datevalidation AND MOTIF=:motif");
            $requete->bindValue(":datevalidation",$classification["datevalidation"],PDO::PARAM_STR);
            $requete->bindValue(":motif",$classification["motif"],PDO::PARAM_STR);
            $requete->execute();
            return $requete->fetchAll(PDO::FETCH_ASSOC);
        }elseif(!empty($classification["nationalite"])){
            if($classification["nationalite"]=="MG"){
            $requete=$this->db->prepare("SELECT MATRICULE,NOM,PRENOM,MAIL,NUMERO,DATESERVER,MONTANTWESTERN,MONTANT,NSUIVI,NOMEXP,OBSERVATION,DATEVALIDATION,TEMPSVALIDATION,NATIONALITE,MOTIF FROM (WESTERN LEFT OUTER JOIN ETUDIANTS ON WESTERN.IDETUDIANTS=ETUDIANTS.IDETUDIANTS) LEFT OUTER JOIN SUIVRE ON WESTERN.IDETUDIANTS=SUIVRE.IDETUDIANTS  WHERE DATEVALIDATION=:datevalidation AND NATIONALITE='MG'");
            }else{
            $requete=$this->db->prepare("SELECT MATRICULE,NOM,PRENOM,MAIL,NUMERO,DATESERVER,MONTANTWESTERN,MONTANT,NSUIVI,NOMEXP,OBSERVATION,DATEVALIDATION,TEMPSVALIDATION,NATIONALITE,MOTIF FROM (WESTERN LEFT OUTER JOIN ETUDIANTS ON WESTERN.IDETUDIANTS=ETUDIANTS.IDETUDIANTS) LEFT OUTER JOIN SUIVRE ON WESTERN.IDETUDIANTS=SUIVRE.IDETUDIANTS  WHERE DATEVALIDATION=:datevalidation AND NATIONALITE!='MG'");
            }
            $requete->bindValue(":datevalidation",$classification["datevalidation"],PDO::PARAM_STR);
            $requete->execute();
            return $requete->fetchAll(PDO::FETCH_ASSOC);
        }else{
            $requete=$this->db->prepare("SELECT MATRICULE,NOM,PRENOM,MAIL,NUMERO,DATESERVER,MONTANTWESTERN,MONTANT,NSUIVI,NOMEXP,OBSERVATION,DATEVALIDATION,TEMPSVALIDATION,NATIONALITE,MOTIF FROM (WESTERN LEFT OUTER JOIN ETUDIANTS ON WESTERN.IDETUDIANTS=ETUDIANTS.IDETUDIANTS) LEFT OUTER JOIN SUIVRE ON WESTERN.IDETUDIANTS=SUIVRE.IDETUDIANTS  WHERE DATEVALIDATION=:datevalidation");
            $requete->bindValue(":datevalidation",$classification["datevalidation"],PDO::PARAM_STR);
            $requete->execute();
            return $requete->fetchAll(PDO::FETCH_ASSOC);
        }
        
    }
}

}

?>