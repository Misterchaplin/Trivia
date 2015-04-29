<?php
class Question extends \BaseObject {
	
	/**
	*
	* @ManyToOne
	* @JoinColumn(name="iddomaine",className="Domaine")
	*/
	private $domaine;
	/**
	*
	* @ManyToOne
	* @JoinColumn(name="idJoueur",className="Joueur")
	*/
	private $joueur;
	private $libelle;
	private $validation;
	
	public function getLibelle() {
		return $this->libelle;
	}
	public function setLibelle($libelle) {
		$this->libelle = $libelle;
		return $this;
	}
	public function getValidation() {
		return $this->validation;
	}
	public function setValidation($validation) {
		$this->validation = $validation;
		return $this;
	}
	
	public function __toString() {
		return $this->libelle;
	}
	public function getDomaine() {
		return $this->domaine;
	}
	public function setDomaine($domaine) {
		$this->domaine = $domaine;
		return $this;
	}
	public function getJoueur() {
		return $this->joueur;
	}
	public function setJoueur($joueur) {
		$this->joueur = $joueur;
		return $this;
	}
	
	

	

}