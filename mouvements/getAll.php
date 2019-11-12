<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers:Origin,X-Requested-With,Content_type");
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
include_once "../connexion_base.php";
$con=new connexion_base();
$bd=$con->connexionBDD();
$data=$con->MyExecuteReader("mouvement",0);
$user = array();

    while($rs = $data->fetch(PDO::FETCH_ASSOC)) {
        array_push($user,array(
        'id'=>$rs['id'],
        'dateprevus'=>$rs["dateprevus"],
        'heureprevus'=>$rs["heureprevus"],
        'heure'=>$rs["heure"],
        'type'=>$rs["type"],
        'lieu'=>$rs["lieu"],
        'id_aeroport'=>$rs["id_aeroport"],
        'id_avion'=>$rs["id_avion"]));
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



