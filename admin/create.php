<?php
include("../assets/db.php");

if(!isset($bdd))
$bdd = bdd();
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

<div class="page">
  <form action="create.php" method="post">
    <h3>Nouvelle carte</h3>
    <br>

    <label for="name">Nom de la carte</label>
    <input type="text" name="name" required></input>
    <br>

    <label for="thumbnail">Image d'aperçu</label>
    <input type="file" name="thumbnail" required></input>
    <br>

    <label for="background">Fond de carte</label>
    <input type="file" name="background" required></input>
    <br>

    <label for="description">Courte description</label>
    <textarea name="description" required></textarea>
    <br>

    <label for="autor">Auteur</label>
    <input type="text" name="autor" required></input>
    <br>

    <label for="date">Date</label>
    <input type="date" name="date" required></input>
    <br>

    <label for="htmlcontent">(HTML custom)</label>
    <textarea name="htmlcontent"></textarea>
    <br>

    <button type="submit">Envoyer</button>

  </form>
</div>



<?php
//Si il y a des données on les traites
if (isset($_POST["submit"])){

$data["name"] = htmlspecialchars($_POST["name"]);

if (checkImg($_FILES['thumbnail']["tmp_name"]) == true){
  $target_dir = "../uploads/thumbnails/";
  $target_file = $target_dir . basename($_FILES["thumbnail"]["name"]);
  move_uploaded_file($_FILES['thumbnail']["tmp_name"], $target_file);
  $data["thumbnail"] = $target_file;
}else{
  header("Location: create.php?e=Thumbnail incorrect");
}

if (checkImg($_FILES['background']["tmp_name"]) == true){
  $target_dir = "../uploads/background/";
  $target_file = $target_dir . basename($_FILES["background"]["name"]);
  move_uploaded_file($_FILES['background']["tmp_name"], $target_file);
  $data["background"] = $target_file;
}else{
  header("Location: create.php?e=Fond de carte incorrect");
}



}
