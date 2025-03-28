<?php
      ob_start();
    
    require_once("Model/pdo.php");

    $resultat = $dbPDO->prepare("SELECT etudiants.id AS id, etudiants.prenom AS prenom, etudiants.nom AS nom, classes.libelle AS classe FROM etudiants INNER JOIN classes ON etudiants.classe_id = classes.id");
    $resultat->execute();

    $etudiants=$resultat->fetchAll();


    $resultat = $dbPDO->prepare("SELECT professeurs.id AS id,professeurs.prenom AS prenom,professeurs.nom AS nom,matiere.lib AS matiere,classes.libelle AS classe FROM professeurs INNER JOIN matiere ON professeurs.id_matiere=matiere.id INNER JOIN classes ON professeurs.id_classe=classes.id");
    $resultat->execute();

    $professeurs=$resultat->fetchAll();

    $resultat = $dbPDO->prepare("SELECT * FROM classes");
    $resultat->execute();

    $classes=$resultat->fetchAll();

    $resultat = $dbPDO->prepare("SELECT * FROM matiere");
    $resultat->execute();

    $matieres=$resultat->fetchAll();

?>


<form class="max-w-sm mx-auto">
  <div class="mb-5">
    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
    <input type="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="nom@gmail.com" required />
  </div>
  <div class="mb-5">
    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your password</label>
    <input type="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
  </div>
  <div class="flex items-start mb-5">
    <div class="flex items-center h-5">
      <input id="remember" type="checkbox" value="" class="w-4 h-4 border border-gray-300 rounded-sm bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800" required />
    </div>
    <label for="remember" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Remember me</label>
  </div>
  <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
</form>

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

<br><h3>Les classes :</h3>
<div class="relative overflow-x-auto">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    ID
                </th>
                <th scope="col" class="px-6 py-3">
                    Libellé
                </th>
            </tr>
        </thead>

        <tbody>
          <?php
          foreach ($classes as $classe){
            echo'<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">'.$classe["id"].'</th>
                <td class="px-6 py-4">'.$classe["libelle"].'</td>
            </tr>';
          } 
          ?>
        </tbody>
    </table>
</div>

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

<br><h3>Les matières :</h3>
<div class="relative overflow-x-auto">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    ID
                </th>
                <th scope="col" class="px-6 py-3">
                    Libellé
                </th>
            </tr>
        </thead>

        <tbody>
          <?php
          foreach ($matieres as $matiere){
            echo'<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">'.$matiere["id"].'</th>
                <td class="px-6 py-4">'.$matiere["lib"].'</td>
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