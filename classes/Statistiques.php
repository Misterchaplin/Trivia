<?php
class Statistiques extends \BaseObject {
	
	/**
	 * @Id
	 */
	private $idDomaine;
	
	/**
	 * @Id
	 */
	private $idJoueur;
	/**
	 * @ManyToOne
	 * @JoinColumn(name="idDomaine",className="Domaine")
	 */
	private $domaine;
	
	/**
	 * @ManyToOne
	 * @JoinColumn(name="idJoueur",className="Joueur")
	 */
	private $joueur;
	private $nbBonnesReponses;
	private $nbReponses;
	
	public function incReponses() {
		$this->nbReponses++;
	}
	
	public function incBonnesReponses() {
		$this->nbBonnesReponses++;
		$this->nbReponses++;
	}
	public function getIdDomaine() {
		return $this->idDomaine;
	}
	public function setIdDomaine($idDomaine) {
		$this->idDomaine = $idDomaine;
		return $this;
	}
	public function getIdJoueur() {
		return $this->idJoueur;
	}
	public function setIdJoueur($idJoueur) {
		$this->idJoueur = $idJoueur;
		return $this;
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
	public function getNbBonnesReponses() {
		return $this->nbBonnesReponses;
	}
	public function setNbBonnesReponses($nbBonnesReponses) {
		$this->nbBonnesReponses = $nbBonnesReponses;
		return $this;
	}
	public function getNbReponses() {
		return $this->nbReponses;
	}
	public function setNbReponses($nbReponses) {
		$this->nbReponses = $nbReponses;
		return $this;
	}
	
		
}