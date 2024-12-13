<?php
    use App\Accesseur\AccesseurCategorieProduit;
    require "configuration.php";
    require CHEMIN_ACCESSEUR . "AccesseurCategorieProduit.php";

    $accesseur =  new AccesseurCategorieProduit();
    $lesCategoriesProduit = $accesseur->getLesCategoriesProduits();

    $titre = "Ajouter d'un produit";
    $lien = "AjoutProduit";

    require "header.php";
?>
  <div>
    <main>
      <h2><em>Créez votre annonce</em></h2>
        <form class="annonce-form" action="/action/actionAjoutProduit.php" method="post" enctype="multipart/form-data">
          <div class="left-section">
            <div class="form-group">
              <label for="titre-annonce">Titre de votre annonce</label>
              <input type="text" id="titre-annonce" value="" name="titre" placeholder="Titre du produit">
            </div>

            <div class="form-group">
              <label for="prix">Prix</label>
              <input type="text" id="prix" value="" name="prix" placeholder="prix">
            </div>

            
            <div class="form-group">
              <label for="categorie-produit">Catégorie du produit</label>
              <select id="categorie-produit" name="Id_Categorie_Produit">
                <?php foreach ($lesCategoriesProduit as $uneCategorie){ ?>
                  <option value ="<?php echo $uneCategorie->getId()?>"> <?php echo $uneCategorie->getLibelle()?></option>
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
          <!-- Ajout de la balise <img> pour la prévisualisation de l'image -->
          <div class="form-group">
              <label>Aperçu de l'image</label>
              <img id="image-preview" src="" alt="Aperçu de l'image" style="display:none; max-width: 200px; max-height: 200px;" />
          </div>

          <div class="right-section">
            <div class="form-group">
              <label for="description-annonce">Description de votre annonce</label>
              <textarea id="description-annonce" value="" name="description" placeholder=""></textarea>
            </div>

            <button class="submit-btn" type = "submit">Déponser l'annonce</button> <!-- Bouton ajouté ici -->
          </div>
      </form>
    </main>
  </div>
