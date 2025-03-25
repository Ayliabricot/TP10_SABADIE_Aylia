<?php
      ob_start();
    
    require_once("../Model/pdo.php");

    if (isset($_GET['id'])){
      $id=$_GET["id"];
      $resultat = $dbPDO->prepare("DELETE FROM etudiants WHERE id=:id");
      $resultat->execute([
      "id"=>$_GET["id"]
      ]);
      echo "<br>Suppression de l'étudiant réussie.";
    }
    else{
      echo "<br>Échec de la suppression : ID invalide.";
    }
?>

<form action="../index.php" method="post">
  <input type="submit" value="Retourner à l'index" />
</form>


<?php $content = ob_get_clean(); ?>

<?php require('../template.php'); ?>