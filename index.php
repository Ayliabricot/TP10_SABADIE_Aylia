<?php
      ob_start();
    
    require_once("Model/pdo.php");

    $resultat = $dbPDO->prepare("SELECT etudiants.id AS id, etudiants.prenom AS prenom, etudiants.nom AS nom, classes.libelle AS classe FROM etudiants INNER JOIN classes ON etudiants.classe_id = classes.id");
    $resultat->execute();

    $etudiants=$resultat->fetchAll();

    echo "<br><h3>Les élèves :</h3><ul>";

    foreach ($etudiants as $etudiant){
      $id=$etudiant['id'];
      echo "<li>".$etudiant["prenom"]." ".$etudiant["nom"]." ".$etudiant["classe"]."-> <a href='Views/modif_etudiant.php?id=$id'>Modifier</a> | <a href='Views/suppression_etudiant.php?id=$id'>Supprimer</a></li>";
    }

    echo "</ul>";

    $resultat = $dbPDO->prepare("SELECT * FROM professeurs INNER JOIN matiere ON professeurs.id_matiere=matiere.id INNER JOIN classes ON professeurs.id_classe=classes.id");
    $resultat->execute();

    $professeurs=$resultat->fetchAll();

    echo "<h3>Les professeurs :</h3><ul>";

    foreach ($professeurs as $professeur){
      echo "<li>".$professeur["prenom"]." ".$professeur["nom"]." ".$professeur["lib"]." ".$professeur["libelle"]."</li>";
    }

    echo "</ul>";


?>

<h3>Nouvelle matière : </h3>
<form action="./Views/nouvelle_matiere.php" method="post">
        
      Libellé : <input type="text" name="libelle" />
            
      <input type="submit" value="Valider" />
</form>

<h3>Nouvel étudiant : </h3>
<form action="./Views/nouvel_etudiant.php" method="post">
        
      Prénom : <input type="text" name="prenom" />
      Nom : <input type="text" name="nom" />
            
      <input type="submit" value="Valider" />
</form>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>