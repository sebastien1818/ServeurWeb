<?php

namespace App\Modele;
use App\Modele\Produit;

class Image
{
    public static $filtres = 
    array(
        'Id_Image' => FILTER_VALIDATE_INT,
        'libelle' => FILTER_SANITIZE_STRING,
    );


	private ?int $id;
	private ?string $libelle;
    
	private ?array $erreurs = [];

	public function __construct($tableaux) {
        $tableau = filter_var_array($tableaux, self::$filtres);
		// Vérification des erreurs
		/*if ($tableaux['Id_Image'] !== null && $tableau['Id_Image'] === false) {
			$this->erreurs[] = "L'ID de l'image n'est pas valide.";
		}*/
		if (isset($tableaux['libelle'])) {
			if ($tableaux['libelle'] !== null && $tableau['libelle'] === '') {
				$this->erreurs[] = "Le libellé ne peut pas être vide.";
			}		}

		$this->id = $tableau["Id_Image"];
		$this->libelle = $tableau["libelle"];
	}
	public function getId(): int
	{
		return $this->id;
	}
	public function setId(int $id)
	{
		$this->id = $id;
	}
	public function getLibelle(): string
	{
		return $this->libelle;
	}
	public function setLibelle(string $libelle)
	{
		$this->libelle = $libelle;
	}

	public function getErreurs(): array
    {
        return $this->erreurs;
    }

}
