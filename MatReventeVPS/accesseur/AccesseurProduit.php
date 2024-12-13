<?php

namespace App\Accesseur;

require(ROOT . "modele/Produit.php");
require(ROOT . "modele/Image.php");
require(ROOT . "modele/CategorieProduit.php");
require(ROOT . "accesseur/Connexion.php");
require(ROOT . "accesseur/ProduitSQL.php");


use PDO;
use ProduitSQL;
use PDOEXCEPTION;

use App\Modele\Image;
use App\Modele\Produit;
use App\Accesseur\Connexion;
use App\Modele\CategorieProduit;


class AccesseurProduit implements ProduitSQL
{   
    public function getLesProduits(){
        $connexion = new Connexion();
        $lesProduitRevois = array();
        $db = $connexion->dbConnect();
        $requette = $db->prepare(AccesseurProduit::SQL_LISTE_PRODUIT);
        // on demande l'exécution de la requête 
        $requette->execute();
        $lesProduit = $requette->fetchAll();
        foreach ($lesProduit  as $unProduitSelection) {
            $array = json_decode(json_encode($unProduitSelection), true);
            $unProduit = new Produit(
                $array
                );
            array_push($lesProduitRevois, $unProduit);
        }
        return $lesProduitRevois;
    }
    public function getUnProduit($id){
        $connexion = new Connexion();
        $db = $connexion->dbConnect();
        $requette = $db->prepare(AccesseurProduit::SQL_LISTE_DUNPRODUIT);
        $requette->bindValue(':par_id', $id, PDO::PARAM_INT);
        $requette->execute();
        $unProduitSelection = $requette->fetch();
        $array = json_decode(json_encode($unProduitSelection), true);
        $unProduit = new Produit(
            $array
            );
        return $unProduit;
    }

    public function ajouterProduit($produit){
        $connexion = new Connexion();
        $db = $connexion->dbConnect();
        $messageDerreur ="";
        $db->beginTransaction();

        try 
        {

            $req = $db->prepare(AccesseurProduit::SQL_INSERT_PRODUIT);

            $req->bindValue(':titre', $produit->getTitre(), PDO::PARAM_STR);
            $req->bindValue(':description', $produit->getDescription(), PDO::PARAM_STR);
            $req->bindValue(':prix', $produit->getPrix(), PDO::PARAM_STR);
            $req->bindValue(':lstCategorie', $produit->getCategorieProduit()->getId(), PDO::PARAM_INT);
            $req->execute();

            $id_Produit = $db->lastInsertId();

            $req = $db->prepare(AccesseurProduit::SQL_INSERT_PRODUIT_IMAGE);
            $req->bindValue(':libelle', $produit->getImage()->getLibelle(), PDO::PARAM_STR);
            $req->bindValue(':Id_Produit', $id_Produit, PDO::PARAM_INT);
            $req->execute();
            $db->commit();


        } 
        catch (PDOException $e) 
        {
            $db->rollback();
            $messageDerreur = $e->getMessage();
        }
        return $messageDerreur;
    }

    public function modifierProduit($produit){
        $connexion = new Connexion();
        $db = $connexion->dbConnect();

        $db->beginTransaction();
        $messageDerreur ="";

        try
        {

            $req = $db->prepare(AccesseurProduit::SQL_UPDATE_PRODUIT);

            $req->bindValue(':idValue', $produit->getId(), PDO::PARAM_INT);
            $req->bindValue(':titre', $produit->getTitre(), PDO::PARAM_STR);
            $req->bindValue(':description', $produit->getDescription(), PDO::PARAM_STR);
            $req->bindValue(':prix', $produit->getPrix(), PDO::PARAM_STR);
            $req->bindValue(':lstCategorie', $produit->getCategorieProduit()->getId(), PDO::PARAM_INT);
            $req->execute();

            $req = $db->prepare(AccesseurProduit::SQL_UPDATE_PRODUIT_IMAGE);
            $req->bindValue(':titre', $produit->getImage() -> getLibelle(), PDO::PARAM_STR);
            $req->bindValue(':Id_Produit', $produit->getId(), PDO::PARAM_INT);
            $req->execute();
            $db->commit();


        }
        catch (PDOException $e)
        {
            $db->rollback();
            $messageDerreur = $e->getMessage();
        }
        return $messageDerreur;
    }
    public function suppProduit($produit){
        $connexion = new Connexion();
        $db = $connexion->dbConnect();
        $messageDerreur ="";
        $db->beginTransaction();

        try {
            $req = $db->prepare(AccesseurProduit::SQL_DELETE_PRODUIT_IMAGE);

            $req->bindValue(':idValue', $produit->getId(), PDO::PARAM_INT);
            $req->execute();

            $req = $db->prepare(AccesseurProduit::SQL_DELETE_PRODUIT);
            $req->bindValue(':idValue', $produit->getId(), PDO::PARAM_INT);
            $req->execute();
            $db->commit();
        }
        catch (PDOException $e) {
            $db->rollback();
            $messageDerreur = $e->getMessage();
        }
        return $messageDerreur;
    }
    
}
//

