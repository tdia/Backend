<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers:Origin,X-Requested-With,Content_type");
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
include_once "../connexion_base.php";
$con=new connexion_base();
$bd=$con->connexionBDD();
$con->where['validite']=1;
$data=$con->MyExecuteReader("responsable",1);
$user = array();

    while($rs = $data->fetch(PDO::FETCH_ASSOC)) {
        array_push($user,array(
        'id'=>$rs['ind'],
        'email'=>$rs["email"],
        'nom'=>$rs["nom"],
        'prenom'=>$rs["prenom"],
        'function'=>$rs["function"],
        'tel1'=>$rs["phone1"],
        'tel2'=>$rs["phone2"]));

    }

    $json = json_encode($user);
    if ($json === false) {
        
        $json = json_encode(array("jsonError", json_last_error_msg()));
        if ($json === false) {
            $json = '{"jsonError": "unknown"}';
        }
        http_response_code(500);
    }
    $con=null;
    echo $json;



