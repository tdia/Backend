<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
include_once "connexion_base.php";
$data = json_decode( file_get_contents('php://input'),true );

$nom =  $data['nom'];
$prenom =  $data['prenom'];
$login =  $data['login'];
$password =  $data['password'];
$id_profil =  $data['id_profil'];
$con=new connexion_base();
$con->connexionBDD();
$con->where['nom']=$nom;
$con->where['prenom']=$prenom;
$con->where['login']=$login;
$con->where['password']=$password;
$con->where['id_profil']=$id_profil;
$con->where['validite']=1;
$con->MyExecuteInsert('utilisateur');