<?php
      ob_start();
    
    require_once("../Model/pdo.php");

    if (isset($_GET['id'])){
      $id=$_GET["id"];
      $resultat = $dbPDO->prepare("SELECT * FROM etudiants WHERE id=:id");
      $resultat->execute([
      "id"=>$_GET["id"]
      ]);

      $etudiant=$resultat->fetch();
    }
    else{
      echo "<br>Échec de la modification : ID invalide.";
    }
?>


<?php
  if(isset($_POST['prenom']) && isset($_POST['nom'])){
    $resultat = $dbPDO->prepare("UPDATE etudiants SET prenom=:prenom,nom=:nom,classe_id=:classe_id WHERE id=:id");
    $resultat->execute([
      "prenom"=>$_POST['prenom'],
      "nom"=>$_POST['nom'],
      "classe_id"=>'1',
      "id"=>"$id"
    ]);
    echo "<br>Modifications effectuées.";
  }
  else{
    echo '<br>Aucune modification enregistrée.';
  }
  
?>

<h3>Modification de l'étudiant : </h3>
<form action="" method="post">
    
  Prénom : <input type="text" name="prenom" value="<?= $_POST['prenom'] ?? $etudiant['prenom'] ?>" />
  Nom : <input type="text" name="nom" value="<?= $_POST['nom'] ?? $etudiant['nom'] ?>" />
    
  <input type="submit" value="Valider" />
</form>

<form action="../index.php" method="post">
  <input type="submit" value="Retourner à l'index" />
</form>


<?php $content = ob_get_clean(); ?>

<?php require('../template.php'); ?>