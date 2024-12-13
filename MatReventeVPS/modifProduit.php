<?php
    use App\Accesseur\AccesseurProduit;
    use App\Accesseur\AccesseurCategorieProduit;

    require "configuration.php";
    require CHEMIN_ACCESSEUR . "AccesseurProduit.php";
    require CHEMIN_ACCESSEUR . "AccesseurCategorieProduit.php";

    $accesseur =  new AccesseurProduit();
    $accesseurCategorie =  new AccesseurCategorieProduit();

    $unProduit = $accesseur->getUnProduit($_POST["Id_Produit"]);
    $lesCategoriesProduit = $accesseurCategorie->getLesCategoriesProduits();
    $titre = "Modifie d'un produit";
    $lien = "ModifierProduit";

    require "header.php";

?>

<main>
      <h2><em>Modifiez votre annonce</em></h2>
      <form class="annonce-form" action="/action/actionModifProduit.php" method="post" enctype="multipart/form-data">
        <div class="left-section">
          <div class="form-group">
            <label for="titre-annonce">Titre de votre annonce</label>
            <input type="text" id="titre-annonce" name="titre" value=" <?=$unProduit->getTitre(); ?>">
          </div>

          <div class="form-group">
            <label for="prix">Prix</label>
            <input type="text" id="prix"  name="prix" value="<?=$unProduit->getPrix(); ?>">
          </div>

          <div class="form-group">
            <label for="categorie-produit">Catégorie du produit</label>
            <select id="categorie-produit" name="Id_Categorie_Produit">
                <?php foreach ($lesCategoriesProduit as $uneCategorie){ 
                  $id = $uneCategorie->getId();
                  $lib = $uneCategorie->getLibelle();
                  if (isset($unProduit) && $unProduit->getCategorieProduit()->getId() == $id){?>
                        <option selected value=<?=$id?>><?=$lib?></option>
                  <?php }else {?>
                      <option value=<?=$id?>><?=$lib?></option>
                <?php }}?>
              </select>
          </div>

          <div class="form-group">
            <label for="image-upload">Importer une image</label>
            <div class="image-upload">
              <input type="file" id="image-upload" name="libelle" hidden>
              <label for="image-upload" class="image-placeholder">
                <img src="image/<?=$unProduit->getImage()->getLibelle(); ?>.png" alt="Image">
              </label>
            </div>
          </div>
        </div>

        <div class="right-section">
          <div class="form-group">
            <label for="description-annonce">Description de votre annonce</label>
            <textarea id="description-annonce" name="description" value=""><?=$unProduit->getDescription(); ?></textarea>
          </div>

          <button type="submit" class="submit-btn"id="Id_Produit" name="Id_Produit" value=" <?=$unProduit->getId()?>">Modifier l'annonce</button> <!-- Bouton ajouté ici -->
        </div>
      </form>
    </main>
