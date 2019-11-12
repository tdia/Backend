<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
include_once "../connexion_base.php";
$data = json_decode( file_get_contents('php://input'),true );
$id =  $data['id'];
$con=new connexion_base();
$con->connexionBDD();
$con->where['ind']=$id;
$con->set['validite']=0;
$con->MyExecuteUpdate('responsable');
$con=null;