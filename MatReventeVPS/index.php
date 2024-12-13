<?php
    use App\Accesseur\AccesseurProduit;
    require "configuration.php";
    require CHEMIN_ACCESSEUR . "AccesseurProduit.php";

    $accesseur =  new AccesseurProduit();
    $lesProduit = $accesseur->getLesProduits();
    $titre = "Accueil";
    $lien = "Accueil";

    require "header.php";

?>
<link rel="stylesheet" href="css/accueil.css">

    <main>
        <aside>
            <h2>Filtres</h2>
                <input type="checkbox" checked> Vêtements <br>
                <input type="checkbox" checked> Affaires scolaires <br>    
                <input type="checkbox" checked> Autre <br>
                <div class="price-range">
                    <label for="price">Prix: <span class="price-indicator"></span></label>
                    <input type="range" id="price" min="0" max="300" value="300">
                </div>
        </aside>
        <form action="/detailProduit.php" method="post" class="results">
            <?php foreach ($lesProduit as $unProduit) { ?>
                <div class='card'>
                <img src='../../image/<?php echo ($unProduit->getImage()->getLibelle()) ?>.png' alt="Image de l'objet"> <br>
                <button type='submit' class='lien-bouton' id="Id_Produit" name="Id_Produit" value=" <?php echo $unProduit->getId()?>">
                    <h3><?php echo $unProduit->getTitre() ?></h3>
                </button>
                <p><?php echo $unProduit->getDescription()?></p>
                <p><?php echo$unProduit->getPrix()?>$</p>
                </div>
                <?php } ?>
        </form>
    </main>
   
