<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
include_once "../connexion_base.php";
$data = json_decode( file_get_contents('php://input'),true );

$login =  $data['login'];
$password =  $data['password'];

$con=new connexion_base();
$bd=$con->connexionBDD();
$sql="SELECT * FROM utilisateur  u
        LEFT JOIN profil ON profil.id_profil = u.id_profil
        where validite='1' and login='".$login."' and password='".$password."'";
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