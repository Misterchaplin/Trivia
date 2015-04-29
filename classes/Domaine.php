<?php
class Domaine extends \BaseObject {
	
	/**
	 * @ManyToOne
	 * @JoinColumn(name="idmonde",className="Monde")
	 */
	private $monde;
	private $libelle;
	private $desciption;
	private $icon;
	
	public function getMonde() {
		return $this->monde;
	}
	public function setMonde($monde) {
		$this->monde = $monde;
		return $this;
	}
	public function getLibelle() {
		return $this->libelle;
	}
	public function setLibelle($libelle) {
		$this->libelle = $libelle;
		return $this;
	}
	public function getDesciption() {
		return $this->desciption;
	}
	public function setDesciption($desciption) {
		$this->desciption = $desciption;
		return $this;
	}
	public function getIcon() {
		return $this->icon;
	}
	public function setIcon($icon) {
		$this->icon = $icon;
		return $this;
	}
	
	public function toString() {
		return $this->libelle." (".$this->desciption.")";

	}

	

	
}