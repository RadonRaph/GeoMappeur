<?php
include("../assets/db.php");

if(!isset($bdd))
$bdd = bdd();
/**
 * Created by PhpStorm.
 * User: raf
 * Date: 14/12/2018
 * Time: 12:20
 */
 ?>
 <!DOCTYPE html>
 <html lang='fr'>
   <head>
   	<title>GeoMappeur</title>
   	<link rel="icon" type="image/png" href="../assets/icon.png" />
   	<link href="../assets/style.css" rel="stylesheet">
   	<meta charset="utf-8">
   	<script type="text/javascript">
    if (screen.width <= 699) {
      alert("Site non adapté au mobile")
    }
   </script>
</head>
<body>
  <?php
  if (isset($_GET["e"]) || !empty($_GET["e"])){
    ?>
    <div class="error">
      <a href="index.php"><h2>X</h2></a>
      <h1><?php echo($_GET['e']) ?></h1>
    </div>
    <?php
  }
   ?>

  <div class="header">
    <a href="../index.php"><h2>Retour</h2></a>
  </div>

 <?php



if (tableExists("maps") == "true"){ //On vérifie si la liste des cartes existe
     $sql = "SELECT * FROM maps";
     $result = $bdd->query($sql);
     ?>
     <div class="mapsSelect">
     <?php
      while($row = $result->fetch()) {
          ?>

          <div class="map">
            <h3><?php echo($row['name'])?></h3>
            <img src=<?php echo "'" . $row["thumbnail"] . "'"?> >
          </div>


          <?php
      }
      ?>
      <a href="create.php">
        <div class="map">
          <h3>Ajouter une carte</h3>
          <img src="../assets/thumbnailCreate.png">
        </div>
      </a>


    </div>
      <?php

  }else{// sinon on la créer
      try {
           $sql ="CREATE TABLE `geomappeur`.`maps` ( `id` INT NOT NULL AUTO_INCREMENT ,
            `name` VARCHAR(250) NOT NULL ,
            `thumbnail` TEXT NOT NULL ,
            `background` TEXT NOT NULL ,
            `description` VARCHAR(500) NOT NULL ,
            `autor` VARCHAR(250) NOT NULL ,
            `date` DATE NOT NULL ,
            `htmlcontent` TEXT NOT NULL ,
            PRIMARY KEY (`id`)) ENGINE = InnoDB;" ;
           $bdd->exec($sql);
           header("Location: index.php");

      } catch(PDOException $e) {
          header("Location: index.php?e= erreur lors de la creation de maps");
      }
}
