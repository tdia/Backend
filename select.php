<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers:Origin,X-Requested-With,Content_type");
include_once "connexion_base.php";
$con=new connexion_base();
if ($bd=$con->connexionBDD()){
	
	$data=$con->MyExecuteReader("bvotes",0);
	echo json_encode($data->fetchAll());
}


