<?php
	//print_r($_POST);
require "../configuration.php";
require CHEMIN_ACCESSEUR . "AccesseurProduit.php";
require CHEMIN_ACCESSEUR . "AccesseurCategorieProduit.php";
require CHEMIN_ACCESSEUR . "AccesseurImage.php";
require_once "gererImage.php";

use App\Modele\Produit;
use App\Accesseur\AccesseurImage;
use App\Accesseur\AccesseurProduit;
use App\Accesseur\AccesseurCategorieProduit;

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
    $action = true;
    $titre = "Modifier d'un produit";
    $lien = "ModifierProduit";

    require ROOT."header.php";
?>
  <div>
    <main>
      <h2><em>Modifiez votre annonce</em></h2>
        <form class="annonce-form" action="/action/actionModifProduit.php" method="post" enctype="multipart/form-data">
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

          <div class="right-section">
            <div class="form-group">
              <label for="description-annonce">Description de votre annonce</label>
              <label><?php if (isset($erreurs["description"])) echo  $erreurs["description"]  ?></label>
              <textarea id="description-annonce" value="" name="description" placeholder=""><?php if (isset($_POST["description"]))  echo $_POST["description"]; ?></textarea>
            </div>
			<label><?php if (isset($erreurs["Id_Produit"])) echo  $erreurs["Id_Produit"]  ?></label>
            <button class="submit-btn" type = "submit"> l'annonce</button> <!-- Bouton ajouté ici -->
          </div>
      </form>
    </main>
  </div>
  <?php }else{
	$accesseurImage = new AccesseurImage();
	$image = $accesseurImage->getImage($produit);
	$accesseur = new AccesseurProduit();
	$messageDerreur = $accesseur->modifierProduit($produit);
	$dossier = $image->GetLibelle();

	if($messageDerreur == ""){
		$image = new gererImage();
		$image->gererImage("modifier",$dossier.".png");
		?> <script> alert ("La modification du produit a été effectué")        
			 window.location.href = '../index.php';
			</script> <?php
	}
	else {
		?> <script> alert ("Erreur lors de la modification du produit")
			window.location.href = '../modifProduit.php';
		</script> <?php
	}
}
