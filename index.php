<?php
include("utils/db.php");
/**
 * Created by PhpStorm.
 * User: raf
 * Date: 14/12/2018
 * Time: 12:20
 */

// On vérifie si une carte est sélectionné sinon on affiche la sélection des cartes
 if (!isset($_POST['map']) || isEmpty($_POST['map'])){


 }
 else
 {
   //On vérifie si la liste des cartes existe et si la carte selectionné existe aussi
   if (tableExists("maps") == true && tableExists($_POST['map'])){

   }
 }
