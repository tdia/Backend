<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers:Origin,X-Requested-With,Content_type");
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
include_once "../connexion_base.php";
$con=new connexion_base();
$bd=$con->connexionBDD();
$data=$con->MyExecuteReader("fichiersfiche",0);
$parains = array();
    while($rs = $data->fetch(PDO::FETCH_ASSOC)) {
        array_push($parains,array(
        'id'=>$rs['id'],
        'nom_fichier'=>$rs["nom_fichier"],
        'type_fichier'=>$rs["type_fichier"],
        'fiche_id'=>$rs["fiche_id"],
        ));

    }

    $json = json_encode($parains);
    if ($json === false) {
        
        $json = json_encode(array("jsonError", json_last_error_msg()));
        if ($json === false) {
            $json = '{"jsonError": "unknown"}';
        }
        http_response_code(500);
    }
    $con=null;
    echo $json;



