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

    $resultat = $dbPDO->prepare("SELECT professeurs.id AS id,professeurs.prenom AS prenom,professeurs.nom AS nom,matiere.lib AS matiere,classes.libelle AS classe FROM professeurs INNER JOIN matiere ON professeurs.id_matiere=matiere.id INNER JOIN classes ON professeurs.id_classe=classes.id");
    $resultat->execute();

    $professeurs=$resultat->fetchAll();

    echo "<h3>Les professeurs :</h3><ul>";

    foreach ($professeurs as $professeur){
      echo "<li>".$professeur["prenom"]." ".$professeur["nom"]." ".$professeur["lib"]." ".$professeur["libelle"]."</li>";
    }

    echo "</ul>";


?>


<br><h3>Les professeurs :</h3>
<div class="relative overflow-x-auto">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    ID
                </th>
                <th scope="col" class="px-6 py-3">
                    Prénom
                </th>
                <th scope="col" class="px-6 py-3">
                    Nom
                </th>
                <th scope="col" class="px-6 py-3">
                    Matière
                </th>
                <th scope="col" class="px-6 py-3">
                    Classe
                </th>
            </tr>
        </thead>

        <tbody>
          <?php
          foreach ($professeurs as $professeur){
            echo'<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">'.$professeur["id"].'</th>
                <td class="px-6 py-4">'.$professeur["prenom"].'</td>
                <td class="px-6 py-4">'.$professeur["nom"].'</td>
                <td class="px-6 py-4">'.$professeur["matiere"].'</td>
                <td class="px-6 py-4">'.$professeur["classe"].'</td>
            </tr>';
          } 
          ?>
        </tbody>
    </table>
</div>

<br><h3>Les élèves :</h3>
<div class="relative overflow-x-auto">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    ID
                </th>
                <th scope="col" class="px-6 py-3">
                    Prénom
                </th>
                <th scope="col" class="px-6 py-3">
                    Nom
                </th>
                <th scope="col" class="px-6 py-3">
                    Classe
                </th>
            </tr>
        </thead>

        <tbody>
          <?php
          foreach ($etudiants as $etudiant){
            $id=$etudiant['id'];
            echo'<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">'.$etudiant["id"].'</th>
                <td class="px-6 py-4">'.$etudiant["prenom"].'</td>
                <td class="px-6 py-4">'.$etudiant["nom"].'</td>
                <td class="px-6 py-4">'.$etudiant["classe"].'</td>
            </tr>';
          } 
          ?>
        </tbody>
    </table>
</div>

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