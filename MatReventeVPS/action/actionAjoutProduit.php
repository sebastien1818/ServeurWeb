<?php
	//print_r($_POST);
require "../configuration.php";
require CHEMIN_ACCESSEUR . "AccesseurProduit.php";
require CHEMIN_ACCESSEUR . "AccesseurCategorieProduit.php";
require "gererImage.php";


use App\Modele\Image;
use App\Modele\Produit;
use App\Modele\CategorieProduit;
use App\Accesseur\AccesseurProduit;
use App\Accesseur\AccesseurCategorieProduit;


//mettre l'image d'un le fichier

$_POST ["libelle"]= pathinfo($_FILES['libelle']['name'], PATHINFO_FILENAME); //enlever l'extension exemple .png
$produit = new Produit (
	$_POST		
);

// Collecter les erreurs
$erreurs = $produit->getErreurs();

// Vérifier s'il y a des erreurs
if (!empty($erreurs)) {

    // Rediriger avec un message d'erreur
    $accesseur =  new AccesseurCategorieProduit();
    $lesCategoriesProduit = $accesseur->getLesCategoriesProduits();

    $fichierTemporaire = $_FILES['libelle']['tmp_name'];
    $action = true;
    $titre = "Ajout d'un produit";
    $lien = "AjoutProduit";

    require ROOT."header.php";
?>
  <div>
    <main>
      <h2><em>Créez votre annonce</em></h2>
        <form class="annonce-form" action="/action/actionAjoutProduit.php" method="post" enctype="multipart/form-data">
          <div class="left-section">
            <div class="form-group">
              <label for="titre-annonce">Titre de votre annonce</label>
              <label><?php if (isset($erreurs["titre"])) echo  $erreurs["titre"] ?></label>
              <input type="text" id="titre-annonce" value="<?php if (isset($_POST["titre"]))  echo $_POST["titre"]; ?>" name="titre" placeholder="Titre du produit">
            </div>

            <div class="form-group">
              <label for="prix">Prix</label>
              <label><?php if (isset($erreurs["prix"])) echo  $erreurs["prix"] ?></label>
              <input type="text" id="prix" value="<?php if (isset($_POST["prix"]))  echo $_POST["prix"]; ?>" name="prix" placeholder="prix">
            </div>

            
            <div class="form-group">
              <label for="categorie-produit">Catégorie du produit</label>
              <select id="categorie-produit" name="Id_Categorie_Produit">
                <?php foreach ($lesCategoriesProduit as $uneCategorie){ ?>
                  <option value ="<?php echo $uneCategorie->getId()?>"> <?php echo $uneCategorie->GetLibelle()?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <label for="image-upload">Importer une image</label>
              <div class="image-upload">
                <input type="file" id="image-upload" name="libelle"  hidden><!-- multiple required -->
                <label for="image-upload" class="image-placeholder">
                  <img src="upload-icon.png" alt="Importer une image"><!-- RESTE IMAGE A FAIRE -->
                </label>
              </div>
            </div>
          </div>

          <div class="form-group">
              <label>Aperçu de l'image</label>
              <img id="image-preview" src="" alt="Aperçu de l'image" style="display:none; max-width: 200px; max-height: 200px;" />
          </div>

          <div class="right-section">
            <div class="form-group">
              <label for="description-annonce">Description de votre annonce</label>
              <label><?php if (isset($erreurs["description"])) echo  $erreurs["description"]  ?></label>
              <textarea id="description-annonce" value="<?php if (isset($_POST["description"]))  echo $_POST["description"]; ?>" name="description" placeholder=""></textarea>
            </div>

            <button class="submit-btn" type = "submit"> l'annonce</button> <!-- Bouton ajouté ici -->
          </div>
      </form>
    </main>
  </div>
  <?php }else{

    $accesseur = new AccesseurProduit();
    $messageDerreur = $accesseur->ajouterProduit($produit);
    if($messageDerreur == ""){
      $image = new gererImage();
      $test=$image->gererImage("ajouter");
      ?> <script> alert ("L'ajout du produit a été effectué")
         window.location.href = '../index.php';
        </script><?php
    }
    else {
      ?> <script> alert ("Erreur lors de l'ajout du produit")
        window.location.href = '../ajoutProduit.php';
      </script> <?php
    }
  }
