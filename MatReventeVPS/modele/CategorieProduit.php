<?php

namespace App\Modele;

class CategorieProduit{

    public static $filtres = 
    array(
        'libelleCategorie' => FILTER_SANITIZE_STRING,
        'Id_Categorie_Produit' => FILTER_VALIDATE_INT,
    );

    private ?int $idCategorieProduit;
    private ?string $libelle;
    private ?array $erreurs = [];


    public function __construct($tableaux){
        $this->erreurs = null;
        $tableau = filter_var_array($tableaux, self::$filtres);
        // Vérification des erreurs
        /*if ($tableaux['Id_Categorie_Produit'] !== null && $tableau['Id_Categorie_Produit'] === false) {
            $this->erreurs[] = "L'ID de la catégorie produit n'est pas valide.";
        }*/

        /*if ($tableaux['libelleCategorie'] !== null && $tableau['libelleCategorie'] === '') {
            $this->erreurs[] = "Le libellé ne peut pas être vide.";
        }*/

        $this->idCategorieProduit = $tableau["Id_Categorie_Produit"];
        $this->libelle = $tableau["libelleCategorie"];
    }

    public function getId() : int {
        return $this->idCategorieProduit;
    }

    public function setId(int $idCategorieProduit){
        $this->idCategorieProduit = $idCategorieProduit;
    }

    public function getLibelle() : string {
        return $this->libelle;
    }

    public function setLibelle(string $libelle){
        $this->libelle = $libelle;
    }

    public function getErreurs(): array {
        return $this->erreurs;
    }
}

?>