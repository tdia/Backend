<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
include_once "../connexion_base.php";
$data = json_decode( file_get_contents('php://input'),true );
$file_parrains =  $data['nom_fichier'];
$type =  $data['type'];
$id =  $data['id'];
//insertion fichiers joints fiche
$con=new connexion_base();
$con->connexionBDD();
$con->where['nom_fichier']=$file_parrains;
$con->where['type_fichier']=$type;
$con->where['fiche_id']=intval($id);
$con->where['validite']=1;
$con->MyExecuteInsert('fichiersfiche');
$con=null;
echo true;