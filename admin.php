<?php
      ob_start();
    
    require_once("Model/pdo.php");


?>

<h1>Page matière</h1>
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