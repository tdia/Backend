<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers:Origin,X-Requested-With,Content_type");
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
include_once "../connexion_base.php";
$con=new connexion_base();
$bd=$con->connexionBDD();
$sql="SELECT * FROM utilisateur  u
        LEFT JOIN profil ON profil.id_profil = u.id_profil
        where validite='1'
        ORDER BY idU DESC";
$data=$bd->query($sql);

$user = array();

    while($rs = $data->fetch(PDO::FETCH_ASSOC)) {
        array_push($user,array(
        'id'=>$rs['idU'],
        'login'=>$rs["login"],
        'password'=>$rs["password"],
        'nom'=>$rs["nom"],
        'prenom'=>$rs["prenom"],
        'validite'=>$rs["validite"],
        'matricule'=>$rs["matricule"],
        'trigramme'=>$rs["trigramme"],
        'libelle_profil'=>$rs["libelle_profil"],
        'id_profil'=>$rs["id_profil"]));

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



