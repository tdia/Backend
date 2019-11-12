<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
include_once "../connexion_base.php";
$data = json_decode( file_get_contents('php://input'),true );

$type =  $data['type'];
$registration =  $data['registration'];
$exploitant =  $data['exploitant'];
$con=new connexion_base();
$con->connexionBDD();
$con->where['type']=$type;
$con->where['exploitant']=$exploitant;
$con->where['registration']=$registration;
$con->MyExecuteInsert('avion');
$con=null;
echo true;