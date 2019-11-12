<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
include_once "../connexion_base.php";
$data = json_decode( file_get_contents('php://input'),true );

$date =  $data['date'];
$heureDebut =  $data['heureDebut'];
$heureFin =  $data['heureFin'];
$departement =  $data['departement'];
$commune =  $data['commune'];
$responsable_id =  $data['responsable_id'];
$demembrement_id =  $data['demembrement_id'];
$mouvement_id =  $data['mouvement_id'];
$nbre_volontaires =  $data['nbre_volontaires'];
$nbre_volontaireRecrute =  $data['nbre_volontaireRecrute'];
$type_activite =  $data['type_activite'];
$nbreMaisonVisites =  $data['nbreMaisonVisites'];
$NbrePersonnesTouchees =  $data['NbrePersonnesTouchees'];
$NbreParrains =  $data['NbreParrains'];
$NbreIndecis =  $data['NbreIndecis'];
$NbreRefus =  $data['NbreRefus'];
$NbrePP =  $data['NbrePP'];
$NbreSI =  $data['NbreSI'];

/*$file_parrains =  $data['file_parrains'];
$file_present =  $data['file_present'];
$file_binome =  $data['file_binome'];
$file_crq =  $data['file_crq'];
*/
//file_put_contents($payload['parrains']['filename'], base64_decode($payload['parrains']['value']));

$con=new connexion_base();
$bd=$con->connexionBDD();
$con->where['date']=$date;
$con->where['heureDebut']=$heureDebut;
$con->where['heureFin']=$heureFin;
$con->where['departement']=$departement;
$con->where['commune']=$commune;
$con->where['responsable_id']=intval($responsable_id);
$con->where['demembrement_id']=intval($demembrement_id);
$con->where['mouvement_id']=intval($mouvement_id);
$con->where['nbre_volontaires']=$nbre_volontaires;
$con->where['nbre_volontaireRecrute']=$nbre_volontaireRecrute;
$con->where['type_activite']=$type_activite;
$con->where['nbreMaisonVisites']=$nbreMaisonVisites;
$con->where['NbrePersonnesTouchees']=$NbrePersonnesTouchees;
$con->where['NbreParrains']=$NbreParrains;
$con->where['NbreRefus']=$NbreRefus;
$con->where['NbreIndecis']=$NbreIndecis;
$con->where['NbrePP']=$NbrePP;
$con->where['NbreSI']=$NbreSI;
$con->where['validite']=1;
$con->MyExecuteInsert('fiches');
$id=$bd->lastInsertId();
$con=null;
/*//insertion fichiers joints fiche
$con=new connexion_base();
$con->connexionBDD();
$con->where['nom_fichier']=$file_parrains;
$con->where['type_fichier']='Fiche Parrainages';
$con->where['fiche_id']=$id;
$con->where['validite']=1;
$con->MyExecuteInsert('fichiersfiche');
$con=null;
//
$con=new connexion_base();
$con->connexionBDD();
$con->where['nom_fichier']=$file_present;
$con->where['type_fichier']='Fiche Presents';
$con->where['fiche_id']=$id;
$con->where['validite']=1;
$con->MyExecuteInsert('fichiersfiche');
$con=null;
//
$con=new connexion_base();
$con->connexionBDD();
$con->where['nom_fichier']=$file_binome;
$con->where['type_fichier']='Fiche Binomes';
$con->where['fiche_id']=$id;
$con->where['validite']=1;
$con->MyExecuteInsert('fichiersfiche');
$con=null;
//
$con=new connexion_base();
$con->connexionBDD();
$con->where['nom_fichier']=$file_crq;
$con->where['type_fichier']='Fiche CRQ';
$con->where['fiche_id']=$id;
$con->where['validite']=1;
$con->MyExecuteInsert('fichiersfiche');
$con=null;*/
echo ($id);
