<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers:Origin,X-Requested-With,Content_type");
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
include_once "../connexion_base.php";
$con=new connexion_base();
$bd=$con->connexionBDD();
$con->where['validite']=1;
$data=$con->MyExecuteReader("fiches",1);
$parains = array();
        

    while($rs = $data->fetch(PDO::FETCH_ASSOC)) {
        array_push($parains,array(
        'id'=>$rs['id'],
        'date'=>$rs["date"],
        'heureDebut'=>$rs["heureDebut"],
        'heureFin'=>$rs["heureFin"],
        'departement'=>$rs["departement"],
        'commune'=>$rs["commune"],
        'responsable_id'=>$rs["responsable_id"],
        'demembrement_id'=>$rs["demembrement_id"],
        'nbre_volontaires'=>$rs["nbre_volontaires"],
        'nbre_volontaireRecrute'=>$rs["nbre_volontaireRecrute"],
        'type_activite'=>$rs["type_activite"],
        'nbreMaisonVisites'=>$rs["nbreMaisonVisites"],
        'NbrePersonnesTouchees'=>$rs["NbrePersonnesTouchees"],
        'NbreParrains'=>$rs["NbreParrains"],
        'NbreRefus'=>$rs["NbreRefus"],
        'NbreIndecis'=>$rs["NbreIndecis"],
        'NbrePP'=>$rs["nbrePP"],
        'NbreSI'=>$rs["nbreSI"],
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



