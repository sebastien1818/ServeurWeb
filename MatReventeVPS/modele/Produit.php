<?php

namespace App\Modele;


class Produit{

    public static $filtres = [
        'Id_Produit' => FILTER_VALIDATE_INT,
        'titre' => FILTER_SANITIZE_STRING,
        'description' => FILTER_SANITIZE_STRING,
        'prix' => FILTER_VALIDATE_FLOAT,
    ];
    private ?int $id;
    private ?string $titre;
    private ?string $description;
    private ?float $prix;
	private ?CategorieProduit $categProduit;
    private ?Image $image;

    private ?array $erreurs = [];


    public function __construct($tableaux){
        $tableau = filter_var_array($tableaux, self::$filtres);
        // Vérification des erreurs
        if (isset($tableaux['Id_Produit'])) {
            if ($tableaux['Id_Produit'] !== null && $tableau['Id_Produit'] === false) {
                $this->erreurs["Id_Produit"] = "L'ID du produit n'est pas valide.";
            }
        }
        if (isset($tableaux['titre'])) {
            if ($tableaux['titre'] !== null && $tableau['titre'] === '') {
                $this->erreurs["titre"] = "Le titre ne peut pas être vide.";
            }
        }
        if (isset($tableaux['description'])) {
            if ($tableaux['description'] !== null) {
                if (strlen($tableau['description']) > 200) {
                    $this->erreurs["description"] = "La description ne doit pas dépasser 200 caractères.";
                }
            }
        }
        if (isset($tableaux['prix'])) {
            if ($tableaux['prix'] !== null) {
                if ($tableau['prix'] === false) {
                    $this->erreurs["prix"] = "Le prix n'est pas valide.";
                } elseif ($tableau['prix'] < 0) {
                    $this->erreurs["prix"] = "Le prix ne peut pas être négatif.";
                }
            }
        }
        $this->id = $tableau["Id_Produit"];
        $this->titre = $tableau["titre"];
        $this->description = $tableau["description"];
        $this->prix = $tableau["prix"];
        $this->categProduit = new CategorieProduit($tableaux);
        $this->image = new Image($tableaux);
    }

    public function getId() : int {
        return $this->id;
    }

    public function setId(int $id){
        $this->id = $id;
    }

    public function getTitre() : string {
        return $this->titre;
    }

    public function setTitre(string $titre){
        $this->titre = $titre;
    }

    public function getDescription() : string {
        return $this->description;
    }

    public function setDescription(string $description){
        $this->description = $description;
    }

    public function getPrix() : float {
        return $this->prix;
    }

    public function setPrix(float $prix){
        $this->prix = $prix;
    }

    public function getCategorieProduit() : CategorieProduit {
        return $this->categProduit;
    }
    public function getImage() : Image {
        return $this->image;
    }
    public function getErreurs(): array {
        return $this->erreurs;
    }
}

?>