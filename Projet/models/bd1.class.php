<?php
class albumbd1{
	public $isbn;
	public $titre;
	public $serie;
	public $scenariste;
	public $dessinateur;
	public $coloriste;
	public $editeur;
	public $pays;
	public $annee_edition;
	public $prix;
	
	function album_bd1($isbn='', $titre='', $serie='', $scenariste='', $dessinateur='', $coloriste='', $editeur='', $pays='', $annee_edition='', $prix=''){
		$this->isbn = $isbn;
		$this->titre = $titre;
		$this->serie = $serie;
		$this->scenariste = $scenariste;
		$this->dessinateur = $dessinateur;
		$this->coloriste = $coloriste;
		$this->editeur = $editeur;
		$this->pays = $pays;
		$this->annee_edition = $annee_edition;
		$this->prix = $prix;
	}
}