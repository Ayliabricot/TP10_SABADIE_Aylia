<?php
      ob_start();
    
    require_once("../Model/pdo.php");

    if (isset($_POST['libelle'])){
      $resultat = $dbPDO->prepare("INSERT INTO matiere(lib) VALUES (:lib)");
      $resultat->execute([
        "lib"=>strip_tags($_POST["libelle"])
      ]);

      echo "<br>Requête effectuée.";
    }
    else{
      echo "<br>Échec de la requête : champ vide.";
    }
?>

<form action="../index.php" method="post">
      <input type="submit" value="Retourner à l'index" />
</form>

<?php $content = ob_get_clean(); ?>

<?php require('../template.php'); ?>