<?php
class connexion_base
{
  public $bdd, $serveur, $utilisateur, $motDePasse, $dataBase,$where=array(),$set=array(),$order=array();
 
  public function __construct($serveur='localhost', $utilisateur='root', $motDePasse='',
$dataBase='babs')
  {
    $this->serveur = $serveur;
    $this->utilisateur = $utilisateur;
    $this->motDePasse = $motDePasse;
    $this->dataBase = $dataBase;
    //$this->bdd=$this->connexionBDD();
  }
 
 function connexionBDD()
  {
      try{
$this->bdd = new PDO('mysql:host='.$this->serveur.';dbname='.$this->dataBase,
$this->utilisateur,$this->motDePasse);
return $this->bdd;

}catch(Exception $e){

  die('Erreur : ' . $e->getMessage());

}
}
function generer(){
  $gen=new GenererClasse();
  $gen->showTable($this->bdd);
}

/**
methode pour générer des classes a partir de la base de la base de données avec comme attribut les champ
de la base 
**/




/**
// fonction pour lire les donnees d'une base de donnnes

**/
function MyExecuteReader($table,$option){
  try{
  if($option==0) {
    $sql="SELECT * from ".$table."";
    if(count($this->order)!=0){
      foreach ($this->order as $key => $value) {
        $i++;
        if($i==count($this->where)) $sql=$sql."$value $key ";
        else $sql=$sql." $value $key, ";
      }
    }
    $pre=$this->bdd->query($sql);
   array_splice($this->order,0);

}
  else {
    $sql="SELECT * from $table where ";
   $i=0;
      foreach ($this->where as $key => $value) {
        $i++;
        if($i==count($this->where)) $sql=$sql.$key."=:$key ";
        else $sql=$sql.$key."=:$key and ";
      }
      if(count($this->order)!=0){
        $i=0;
      foreach ($this->order as $key => $value) {
        $i++;
        if($i==count($this->where)) $sql=$sql."$value $key ";
        else $sql=$sql." $value $key, ";
      }
    }
    $pre=$this->bdd->prepare($sql);
     $pre->execute($this->where);
    array_splice($this->where,0);
    array_splice($this->order,0);
   
  }
return $pre;
}catch(Exception $e){
   die('Erreur : ' . $e->getMessage());
}
}

/**
fonction pour execute requete
**/
/*function MyExecuteRequet($sql,$option){
  try{
  if($option==0) {
 $pre=$this->bdd->query("$sql");
 
}
  else {
    
    $pre=$this->bdd->prepare("$sql");
     $pre->execute($this->where);
    array_splice($this->where,0);
   
  }
return $pre;
}catch(Exception $e){
   die('Erreur : ' . $e->getMessage());
}
}
*/
/**
// fonction pour faire de jointure avec ou sans paramétre
**/

    function MyExecuteJointure($table1,$table2,$option,$l1=-1,$l2=-1){
        try{

            if($option==0) {
                $sql="SELECT * from $table1,$table2 where";
                foreach ($this->where as $key => $value) {
                    $sql="$sql $table1.$key = $table2.$value ";
                  }

                  if(count($this->order)!=0){
                      $i=0;
                      $sql=$sql.'ORDER BY ';
                    foreach ($this->order as $key => $value) {
                      $i++;
                      if($i==count($this->order)) $sql=$sql."$value $key ";
                      else $sql=$sql." $value $key, ";
                    }
                  }
                  if($l1!=-1){
                    $sql=$sql.'Limit '.$l1.','.$l2;
                  }
                $pre=$this->bdd->query("$sql");
                array_splice($this->where,0);
                array_splice($this->order,0);
            }
            else {
                $sql="SELECT * from $table1,$table2 where ";
                $i=0;
                foreach($this->where as $key => $value) {
                    $i++;
                    if($i==1) {
                        $sup=$key;
                        $sql="$sql $table1.$key = $table2.$value and ";
                    }
                    else{
                        if($i==count($this->where)) $sql=$sql.$key."=$value ";
                        else $sql=$sql.$key."=$value and ";
                    }
                }

                if(count($this->order)!=0){
                      $i=0;
                      $sql=$sql.'ORDER BY ';
                    foreach ($this->order as $key => $value) {
                      $i++;
                      if($i==count($this->order)) $sql=$sql."$value $key ";
                      else $sql=$sql." $value $key, ";
                    }
              
                  }
                   if($l1!=-1){
                    $sql=$sql.'Limit '.$l1.','.$l2;
                  }
                  
                array_splice($this->where,0,1);
                $pre=$this->bdd->query($sql);
                //$pre->execute($this->where);
                array_splice($this->where,0);
                 array_splice($this->order,0);

            }

            return $pre;
        }catch(Exception $e){
            die('Erreur : ' . $e->getMessage());
        }
    }




    /**
//fonction pour insere les donnees d'une base de donnees
**/

function MyExecuteInsert($table){
  try{
    $i=0;
    $col="";
    $val="";
      foreach ($this->where as $key => $value){
        $i++;
        if($i==count($this->where)){
          $col=$col."$key";
          $val=$val.":$key";
        } 
        else{
          $col=$col."$key,";
          $val=$val.":$key,";
        } 

      }
    $sql="INSERT INTO $table($col) values($val)";
    $pre=$this->bdd->prepare(''.$sql.'');
    $pre->execute($this->where);
    array_splice($this->where,0);
    if($pre)return 1;
    else return 0;
    
}catch(Exception $e){
   die('Erreur : ' . $e->getMessage());
}
}
/**
//function pour supprimer un ligne dans une table
**/

function MyExecuteDelete($table){
  try{
    $sql="DELETE from $table where ";
   $i=0;
      foreach ($this->where as $key => $value) {
        $i++;
        if($i==count($this->where)) $sql=$sql.$key."=:$key ";
        else $sql=$sql.$key."=:$key and ";
      }
     $pre=$this->bdd->prepare($sql);
     $pre->execute($this->where);
    array_splice($this->where,0);
   
  
 
return $pre;
}catch(Exception $e){
   die('Erreur : ' . $e->getMessage());
}
}
/**
//function pour modifier une ligne dans une table
**/
function MyExecuteUpdate($table){
  try{
    $sql="UPDATE $table  set ";
   $i=0;
      foreach ($this->set as $key => $value) {
        $i++;
        if($i==count($this->set)) $sql=$sql.$key."=:$key ";
        else $sql=$sql.$key."=:$key , ";
        
      }
       $sql=$sql." where ";
        $i=0;
      foreach ($this->where as $key => $value) {
        $i++;
        if($i==count($this->where)) $sql=$sql.$key."=:$key ";
        else $sql=$sql.$key."=:$key and ";
        $this->set["$key"]=$value;
      }
      $pre=$this->bdd->prepare($sql);
    $pre->execute($this->set);
    array_splice($this->where,0);
    array_splice($this->set,0);
    $pre->closeCursor();
  
 
return 1;
}catch(Exception $e){
   die('Erreur : ' . $e->getMessage());
}
}

 function MyLien($caption){
      if(!file_exists(BASE.DS."$caption.php")){
          $manip = fopen(BASE.DS."$caption.php", "w+");
        if($manip==false)
        die("La création du fichier a échoué");
    
       }
            
   return $caption.'.php';
    }
    function Chaine($chaine, $tailleMax)
  {
    // Variable locale
    $positionDernierEspace = 0;
    if( strlen($chaine) >= $tailleMax )
    {
      $chaine = substr($chaine,0,$tailleMax);
      $positionDernierEspace = strrpos($chaine,' ');
      $chaine = substr($chaine,0,$positionDernierEspace).'...';
    }
    return $chaine;
  }

}
?>