<?php
interface ProduitSQL
{
	
		public const SQL_LISTE_PRODUIT = "SELECT produit.Id_Produit as Id_Produit, titre,description,prix, libelle, image.Id_Image as Id_Image
                            FROM produit LEFT JOIN image ON produit.Id_Produit = image.Id_Produit";
		public const SQL_LISTE_DUNPRODUIT = "SELECT produit.Id_Produit as Id_Produit,titre,description,prix,image.libelle as libelle,categorie_produit.libelle AS libelleCategorie ,produit.Id_Categorie_Produit as Id_Categorie_Produit FROM produit LEFT JOIN image ON produit.Id_Produit = image.Id_Produit JOIN categorie_produit ON categorie_produit.Id_Categorie_Produit = produit.Id_Categorie_Produit WHERE produit.Id_Produit = :par_id;";
		//Requete ajout produit
		public const SQL_INSERT_PRODUIT = "INSERT INTO produit(titre,description,prix,Id_Categorie_Produit,Id_Utilisateur) VALUES (:titre, :description, :prix, :lstCategorie,null)";
										
	    public const SQL_INSERT_PRODUIT_IMAGE =  "INSERT INTO image(libelle, Id_Produit) VALUES (:libelle, :Id_Produit)";

		public const SQL_UPDATE_PRODUIT = "UPDATE produit SET titre = :titre, description = :description ,prix = :prix ,Id_Categorie_Produit = :lstCategorie WHERE Id_Produit = :idValue";

	    public const SQL_UPDATE_PRODUIT_IMAGE =  "UPDATE image SET libelle = :titre WHERE Id_Produit = :Id_Produit";
		
		public const SQL_DELETE_PRODUIT = "DELETE FROM  produit WHERE Id_Produit = :idValue";

		public const SQL_DELETE_PRODUIT_IMAGE = "DELETE FROM  image WHERE Id_Produit = :idValue";
}
?>
