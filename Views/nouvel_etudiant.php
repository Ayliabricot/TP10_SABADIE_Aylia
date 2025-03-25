<?php
      ob_start();
    
    require_once("../Model/pdo.php");
    if (isset($_POST['prenom']) && isset($_POST['nom'])){
      $resultat = $dbPDO->prepare("INSERT INTO etudiants(prenom,nom,classe_id) VALUES (:prenom,:nom,:classe_id)");
      $resultat->execute([
        "prenom"=>strip_tags($_POST["prenom"]),
        "nom"=>strip_tags($_POST["nom"]),
        "classe_id"=>"1"
      ]);

      echo "<br>Requête effectuée.";
    }
    else{
      echo "<br>Echec de la requête : champ vide.";
    }
    

?>

<form action="../index.php" method="post">
      <input type="submit" value="Retourner à l'index" />
</form>

<?php $content = ob_get_clean(); ?>

<?php require('../template.php'); ?>