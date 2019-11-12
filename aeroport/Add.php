<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
include_once "../connexion_base.php";
$data = json_decode( file_get_contents('php://input'),true );

$name =  $data['name'];
$code_pays =  $data['code_pays'];
$code_aeroport =  $data['code_aeroport'];
$con=new connexion_base();
$con->connexionBDD();
$con->where['name']=$name;
$con->where['code_pays']=$code_pays;
$con->where['code_aeroport']=$code_aeroport;
$con->MyExecuteInsert('aeroport');
$con=null;
echo true;