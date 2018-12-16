<?php
/**
 * Created by PhpStorm.
 * User: raf
 * Date: 14/12/2018
 * Time: 12:20
 */


function bdd(){
  $db_adress = "localhost";
  $db_name = "geomappeur";
  $db_username = "root";
  $db_pass = "";


    try
    {
        $bdd = new PDO('mysql:host=' . $db_adress . ';dbname='. $db_name.';charset=utf8', $db_username, $db_pass);
        //$bdd = new PDO('mysql:host=localhost;dbname=geomappeur;charset=utf8', 'root', '');
      $bdd->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    }
    catch (Exception $e)
    {
        die('Erreur : ' . $e->getMessage());

    }
    return $bdd;
}

function tableExists($table) {
    if(!isset($bdd))
    $bdd = bdd();

    // Try a select statement against the table
    // Run it in try/catch in case PDO is in ERRMODE_EXCEPTION.
    try {
        $sql = "SELECT * FROM " . $table;
        $result = $bdd->exec($sql);

    } catch (Exception $e) {
        //echo $e->getMessage();
        return "false";
    }

    if(isset($result))
      return "true";
    else
      return "false";
}

//Rien a voir avec la bdd mais je savais pas ou le mettre
function checkImg($imgSrc){
  $imageFileType = strtolower(pathinfo($imgSrc,PATHINFO_EXTENSION));
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
    return false;
  }

  if (getimagesize($imgSrc) !== false){
    return true;
  }else{
    return false;
  }
  return true;
}
