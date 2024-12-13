<?php
interface ImageSQL
{	
	public const SQL_IMAGE = "SELECT libelle FROM `image` WHERE Id_Produit = :par_Id_Produit;";
}
?>