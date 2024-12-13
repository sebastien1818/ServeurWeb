<?php

use App\Accesseur\AccesseurProduit;
require "configuration.php";
require CHEMIN_ACCESSEUR."AccesseurProduit.php";
$accesseur =  new AccesseurProduit();
$unProduit =  $accesseur->getUnProduit($_POST["Id_Produit"]);

$titre = "Details du produit";
$lien = "detailProduit";

require "header.php";

?>
<main>
      <h2><em>Détails du produit</em></h2>
      <form>
        <div class="annonce-form">
          <div class="left-section">
            <div class="form-group">
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
              <label for="description-annonce">Description de l'annonce</label>
              <textarea id="description-annonce" placeholder="<?=$unProduit->getDescription(); ?>" readonly></textarea>
            </div>
          </div>
        </div>
        <button type="submit" class="submit-btn">Ajouter au panier</button>
      </form>
      <div>
        <form action="modifProduit.php" method="post">
          <button type='submit' class='lien-bouton' id="Id_Produit" name="Id_Produit" value=" <?=$unProduit->getId()?>">modifier</button>
        </form>
        <form action="suppProduit.php" method="post">
        <button type='submit' class='lien-bouton' id="Id_Produit" name="Id_Produit" value=" <?=$unProduit->getId()?>">supprimer</button>

        </form>
      </div>
</main>
