<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/fontawesome-free-6.6.0-web/css/all.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Reem+Kufi+Ink&family=Ribeye&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
    <?php
        if (isset($action)) {
            ?>
                <link rel="stylesheet" href="../css/styles.css">
                <link rel="stylesheet" href="../css/fontawesome-free-6.6.0-web/css/all.css">
            <?php
            switch ($lien) {
                case "Accueil":
                    ?>
                    <link rel="stylesheet" href="../css/accueil.css">                        
                      <script defer src="js/accueil.js"></script><?php
                    break;
                case "AjoutProduit" :
                    ?><link rel="stylesheet" href="../css/pageAjoutProduit.css">
                    <script defer src="js/ajout.js"></script><?php
                case "detailProduit" :
                    ?><link rel="stylesheet" href="../css/pageDetailProduit.css"><?php
                case "ModifierProduit" :
                    ?><link rel="stylesheet" href="../css/pageModifierProduit.css"><?php
                case "SupprimerProduit" :
                    ?><link rel="stylesheet" href="../css/pageSupprimerProduit.css">
                    <script defer src="js/suppr.js"></script><?php
                case "Mission" :
                    ?><link rel="stylesheet" href="../css/pageMission.css"><?php
                default:
                    # code...
                    break;
            }
        }else{        
        switch ($lien) {
            case "Accueil":
                ?><link rel="stylesheet" href="css/accueil.css">                        
                  <script defer src="js/accueil.js"></script><?php
                break;
            case "AjoutProduit" :
                ?><link rel="stylesheet" href="css/pageAjoutProduit.css">
                <script defer src="js/ajout.js"></script><?php
            case "detailProduit" :
                ?><link rel="stylesheet" href="css/pageDetailProduit.css"><?php
            case "ModifierProduit" :
                ?><link rel="stylesheet" href="css/pageModifierProduit.css"><?php
            case "SupprimerProduit" :
                ?><link rel="stylesheet" href="css/pageSupprimerProduit.css">
                    <script defer src="js/suppr.js"></script><?php
            case "Mission" :
                ?><link rel="stylesheet" href="css/pageMission.css"><?php
            default:
                # code...
                break;
        }}

    ?>
    <script defer src="js/header.js"></script>

    <title><?php $titre ?></title>
</head>
<body>
    

<header>
  <nav>
        <a href="/"><h1>MatRevente</h1></a>
        <a href="/ajoutProduit.php"><button class="annonce">Déposer une annonce</button></a>
        <div class="rechercher">
            <input class="rechercher-text" type="text" placeholder="Rechercher">
            <button class="fa-solid fa-magnifying-glass"></button>
        </div>
        <a href="/mission.php"><button class="annonce">Mission du site</button></a>
        <button class="connecter">Se connecter</button>
        <button id="menuToggle" class="fa-solid fa-bars"></button>
    </nav>

    <!-- Menu déroulant pour mobile -->
    <section id="menuMobile" class="menu-deroulant">
        <a class="menu-item" href="/ajoutProduit.php">Publier une annonce</a>
        <a class="menu-item" href="/mission.php">Mission du site</a>
        <button class="menu-item">Se connecter</button>
        <button class="menu-item">Rechercher</button>
    </section>
</header>