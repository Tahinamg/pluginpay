<?php
final class PromotionManager{
    const JSONFILE = "../JSON/Promotion.json";
    const JSONFILEUNUSED = "../JSON/UnusedPromotion.json"; 
    const JSONFILEUSED = "../JSON/UsedPromotion.json"; 
    public function createPromo(Promotion $promotion){
        $data=file_get_contents(SELF::JSONFILE);
        if($data!=false){
            $data=json_decode($data,true);
            $promotion->generatePromo();
            while($this->promoDuplicate($promotion)){
                
                $promotion->generatePromo();
            }
            $promotion->setUtilise("NON");
            array_push($data,array("codepromo"=>$promotion->getCodepromo(),"utilise"=>$promotion->getUtilise()));
            $data=json_encode($data);
            file_put_contents(SELF::JSONFILE,$data);
            return true;
        }else{
            new Exception("TThe files who store the promotion was dismiss",0);
        }
        
    }
    public function listUnusedPromo(){
        $data=file_get_contents(SELF::JSONFILE);
        if($data!=false){
            $data=json_decode($data,true);
            $data1=array();
            foreach($data as $key => $value){
                if($value['utilise']=="NON"){
                    array_push($data1,$data[$key]);
                }
            }
            $data1=json_encode($data1);
            file_put_contents(SELF::JSONFILEUNUSED,$data1);
            return $data1;
        }else{
            throw new Exception("le fichier JSON n'existe pas", 0);
        }
    }

    public function listUsedPromo(){
        $data=file_get_contents(SELF::JSONFILE);
        if($data!=false){
            $data=json_decode($data,true);
            $data1=array();
            foreach($data as $key => $value){
                if($value['utilise']=="OUI"){
                    array_push($data1,$data[$key]);
                }
            }
            $data1=json_encode($data1);
            file_put_contents(SELF::JSONFILEUSED,$data1);
            return $data1;
        }else{
            throw new Exception("le fichier JSON n'existe pas", 0);
        }
    }

    public function existPromo(Promotion $promotion){
        $file=file_get_contents(SELF::JSONFILE);
        if($file!=false){
            $file=json_decode($file,true);
            foreach($file as $value){
                if($value['codepromo']===$promotion->getCodepromo() && $value['utilise']===$promotion->getUtilise()){
                    return true;
                }   
            }
            return false;
        }else{
            new ErrorException("The files who store the promotion was dismiss");
        }
    }

    public function promoDuplicate(Promotion $promotion){
        $file=file_get_contents(SELF::JSONFILE);
        if($file!=false){
            $file=json_decode($file,true);
            foreach($file as $value){
                if($value['codepromo']===$promotion->getCodepromo()){
                    return true;
                }   
            }
            return false;
        }else{
            new ErrorException("The files who store the promotion was dismiss");
        }
    }

    public function utiliseCodePromo(Promotion $promotion){
        if($this->existPromo($promotion)){
            $file=file_get_contents(SELF::JSONFILE);
            if($file!=false){
                $file=json_decode($file,true);
                foreach($file as $key => $value){
                    if($value['codepromo']===$promotion->getCodepromo()){
                        $promotion->setUtilise("OUI");
                        $value['utilise'] = "OUI";
                        $file[$key]=$value;
                    break;
                    }
                }
               
                $file=json_encode($file);
                file_put_contents(SELF::JSONFILE,$file);
                return true;
            }
        }else{
        return false;
        }
    }
    public function unsetPromoUtilise(Promotion $promotion){
        $file=file_get_contents(SELF::JSONFILE);
        if($file!=false){
            $file=json_decode($file,true);
            foreach($file as $key => $value){
                if($value['codepromo']===$promotion->getCodepromo()&&$value['utilise']===$promotion->getUtilise()){
                   
                    unset($file[$key]);
                    $file=json_encode($file);
                    file_put_contents(SELF::JSONFILE,$file);
                    return true;
                }
            }
            return false;
        }else{
            new JsonException("The files who store the promotion was dismiss",0);
        }
    }
    public function unsetPromo(Promotion $promotion){
        $file=file_get_contents(SELF::JSONFILE);
        if($file!=false){
            $file=json_decode($file,true);
            foreach($file as $key => $value){
                if($value['codepromo']===$promotion->getCodepromo()){
                    unset($file[$key]);
                    $file=json_encode($file);
                    file_put_contents(SELF::JSONFILE,$file);
                    return true;
                }
            }
            return false;
        }else{
         throw new JsonException("The files who store the promotion was dismiss",0);
        }
    }
}

?>