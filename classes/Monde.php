<?php
class Monde extends \BaseObject {
	private $libelle;
	
	public function getLibelle() {
		return $this->libelle;
	}
	public function setLibelle($libelle) {
		$this->libelle = $libelle;
		return $this;
	}

	public function toString() {
		return $this->id;

	}

	

}