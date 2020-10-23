<?php
header('Content-type: application/json; charset=utf-8');
function loadclass($class){
    require "../Model/".$class.'.class.php';
}
spl_autoload_register("loadclass");

if(isset($_POST['inputdate'],$_POST['paiementstate'],$_POST['motif'],$_POST['mounth'])){
    $data=array("inputdate"=>$_POST['inputdate'],"paiementstate"=>$_POST['paiementstate'],"motif"=>$_POST['motif'],"mounth"=>$_POST['mounth']);
    $comptable=new ComptableManager(MyPDO::getMysqlConnexion());
    $datarecouvrement=$comptable->doRecovery($data);
    echo json_encode($datarecouvrement);
}else{
   $data=array("error"=>"true","cause"=>"need more post data");
   echo json_encode($data);
}
?>