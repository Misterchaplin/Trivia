<?php

class Score extends \BaseObject {
	
	/**
	* @ManyToOne
	* @JoinColumn(name="idpartie",className="Partie")
	*/
	private $idPartie;
	/**
	 * @ManyToOne
	 * @JoinColumn(name="idjoueur",className="Joueur")
	 */
	private $idJoueur;
	/**
	 * @ManyToOne
	 * @JoinColumn(name="iddomaine",className="Domaine")
	 */
	private $idDomaine;
	
	public function getIdPartie() {
		return $this->idPartie;
	}
	public function setIdPartie($idPartie) {
		$this->idPartie = $idPartie;
		return $this;
	}
	public function getIdJoueur() {
		return $this->idJoueur;
	}
	public function setIdJoueur($idJoueur) {
		$this->idJoueur = $idJoueur;
		return $this;
	}
	public function getIdDomaine() {
		return $this->idDomaine;
	}
	public function setIdDomaine($idDomaine) {
		$this->idDomaine = $idDomaine;
		return $this;
	}
		
	
}