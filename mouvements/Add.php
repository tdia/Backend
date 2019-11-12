<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
include_once "../connexion_base.php";
$data = json_decode( file_get_contents('php://input'),true );

$dateprevus =  $data['dateP'];
$heureprevus =  $data['heureP'];
$heure =  $data['heureE'];
$type =  $data['type'];
$id_avion =  $data['avion_id'];
$id_aeroport =  $data['aeroport_id'];
$lieu =  $data['lieu'];
$type =  $data['type'];
$con=new connexion_base();
$con->connexionBDD();
$con->where['type']=$type;
$con->where['dateprevus']=$dateprevus;
$con->where['heureprevus']=$heureprevus;
$con->where['heure']=$heure;
$con->where['type']=$type;
$con->where['id_avion']=$id_avion;
$con->where['id_aeroport']=$id_aeroport;
$con->where['lieu']=$lieu;
$con->MyExecuteInsert('mouvement');
$con=null;
echo true;