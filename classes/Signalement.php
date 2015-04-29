<?php
class Signalement extends \BaseObject {
	
	
	
	/**
	 * @Id
	 */
	private $idProbleme;
	
	/**
	 * @Id
	 */
	private $idJoueur;
	/**
	 * @Id
	 */
	private $idQuestion;
	/**
	 * @ManyToOne
	 * @JoinColumn(name="idprobleme",className="Probleme")
	 */
	private $problem;
	/**
	 * @ManyToOne
	 * @JoinColumn(name="idjoueur",className="Joueur")
	 */
	private $joueur;
	/**
	 * @ManyToOne
	 * @JoinColumn(name="idquestion",className="Question")
	 */
	private $question;
	private $dateS;
	
	
	public function getDateS() {
		return $this->dateS;
	}
	public function setDateS($dateS) {
		$this->dateS = $dateS;
		return $this;
	}
	public function getIdProbleme() {
		return $this->idProblem;
	}
	public function setIdProbleme($idProblem) {
		$this->idProblem = $idProblem;
		return $this;
	}
	public function getIdJoueur() {
		return $this->idJoueur;
	}
	public function setIdJoueur($idJoueur) {
		$this->idJoueur = $idJoueur;
		return $this;
	}
	public function getIdQuestion() {
		return $this->idQuestion;
	}
	public function setIdQuestion($idQuestion) {
		$this->idQuestion = $idQuestion;
		return $this;
	}
	public function getProblem() {
		return $this->problem;
	}
	public function setProblem($problem) {
		$this->problem = $problem;
		return $this;
	}
	public function getJoueur() {
		return $this->joueur;
	}
	public function setJoueur($joueur) {
		$this->joueur = $joueur;
		return $this;
	}
	public function getQuestion() {
		return $this->question;
	}
	public function setQuestion($question) {
		$this->question = $question;
		return $this;
	}
	
	

}