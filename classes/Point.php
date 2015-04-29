<?php
class Point extends \BaseObject {
	
	/**
	 * @Id
	 */
	private $idPartie;
	/**
	 * @Id
	 */
	private $idJoueur;
	/**
	 * @ManyToOne
	 * @JoinColumn(name="idpartie",className="Partie")
	 */
	private $partie;
	/**
	 * @ManyToOne
	 * @JoinColumn(name="idjoueur",className="Joueur")
	 */
	private $joueur;
	private $nbpoint;
	
	public function incPoints() {
		$this->nbpoint++;
	}
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
	public function getPartie() {
		return $this->partie;
	}
	public function setPartie($partie) {
		$this->partie = $partie;
		return $this;
	}
	public function getJoueur() {
		return $this->joueur;
	}
	public function setJoueur($joueur) {
		$this->joueur = $joueur;
		return $this;
	}
	public function getNbpoint() {
		return $this->nbpoint;
	}
	public function setNbpoint($nbpoint) {
		$this->nbpoint = $nbpoint;
		return $this;
	}
	
	
}