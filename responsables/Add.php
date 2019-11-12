<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
include_once "../connexion_base.php";
$data = json_decode( file_get_contents('php://input'),true );

$nom =  $data['nom'];
$prenom =  $data['prenom'];
$email =  $data['email'];
$tel1 =  $data['tel1'];
$tel2 =  $data['tel2'];
$function =  $data['function'];
$con=new connexion_base();
$con->connexionBDD();
$con->where['nom']=$nom;
$con->where['prenom']=$prenom;
$con->where['email']=$email;
$con->where['phone1']=$tel1;
$con->where['phone2']=$tel2;
$con->where['function']=$function;
$con->where['validite']=1;
$con->MyExecuteInsert('responsable');
$con=null;
echo true;