<?php

class Reponse extends \BaseObject {
	
	/**
	* @ManyToOne
	* @JoinColumn(name="idquestion",className="Question")
	*/
	private $question;
	private $libelle;
	private $estBonne;
	
	public function getQuestion() {
		return $this->question;
	}
	public function setQuestion($question) {
		$this->question = $question;
		return $this;
	}
	public function getLibelle() {
		return $this->libelle;
	}
	public function setLibelle($libelle) {
		$this->libelle = $libelle;
		return $this;
	}
	public function getEstBonne() {
		return $this->estBonne;
	}
	public function setEstBonne($estBonne) {
		$this->estBonne = $estBonne;
		return $this;
	}
	
	
	public function toString() {
		return $this->question."<br>".$this->libelle;

	}

}