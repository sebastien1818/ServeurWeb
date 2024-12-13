<?php
use App\Accesseur\AccesseurProduit;
require "configuration.php";
require CHEMIN_ACCESSEUR."AccesseurProduit.php";

$accesseur =  new AccesseurProduit();
$unProduit = $accesseur->getUnProduit($_POST["Id_Produit"]);

$titre = "Suppression du produit";
$lien = "SupprimerProduit";


require "header.php";

?>
<main>
      <h2><em>Supprimez votre annonce</em></h2>
      <form class="annonce-form">
        <div class="left-section">
          <div class="form-group">
            <label for="titre-annonce">Titre de votre annonce</label>
            <input type="text" id="titre-annonce" placeholder="<?=$unProduit->getTitre(); ?>" readonly>
          </div>

          <div class="form-group">
            <label for="prix">Prix</label>
            <input type="text" id="prix" placeholder="<?=$unProduit->getPrix(); ?>$" readonly>
          </div>

          <div class="form-group">
            <label for="categorie-produit">Catégorie du produit</label>
            <select id="categorie-produit" disabled>
              <option><?=$unProduit->getCategorieProduit()->getLibelle() ?></option>
            </select>
          </div>

          <div class="form-group">
            <div class="image-upload">
              <label for="image-upload" class="image-placeholder" aria-readonly="true">
                <img src="image/<?=$unProduit->getImage()->getLibelle(); ?>.png" alt="Image">
              </label>
            </div>
          </div>
        </div>

        <div class="right-section">
          <div class="form-group">
            <label for="description-annonce">Description de votre annonce</label>
            <textarea id="description-annonce" placeholder="<?=$unProduit->getDescription(); ?>" readonly></textarea>
          </div>
        </div>

      </form>

      <button id="boutonSupprimer" type="submit" class="submit-btn">Supprimer</button>

      <div id="overlay"></div>
      <div id="popup">
          <div id="popup-content">
              <p>Souhaitez-vous vraiment la suppression de ce produit ?</p>
              <form action="/action/actionSuppProduit.php" method="post">
                  <button type="submit" id="boutonSupp" name="Id_Produit" value="<?=$unProduit->getId() ?>">Confirmer la suppression</button>
              </form>
              <button id="boutonAnnuler">Annuler</button>
          </div>
      </div>
    </main>
