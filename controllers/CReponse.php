<?php

class CReponse extends \BaseController {
	
	public function index() {
		$this->refresh();
	}
	
	public function refresh() {
		
	}
	
	/**
	 * Va chercher les réponses après avoir récupèré une question aléatoire
	 * @return réponses
	 */
	public function afficherReponses () {
		$question = new CQuestion();
		$aQuestion=$question->nouvelleQuestion();
		$reponses = DAO::getAll("Reponse", "idquestion =".$aQuestion->getId());
	
		return $reponses;
	}
	
	/**
	 * Récupère une liste de réponses 
	 * @param $question
	 * @return reponses
	 */
	public function rep($question){
		$reponses = DAO::getAll("Reponse", "idquestion =".$question);
		return $reponses;
	}
	
	/**
	 * Récupère une reponse avec les paramètres données
	 * @param $idQuestion
	 * @param $idReponse
	 * @return reponse
	 */
	public function getReponse($idQuestion, $idReponse){
		$reponse = DAO::getOne("Reponse", "idquestion='".$idQuestion."' AND id='".$idReponse."'");
		return $reponse;
	}
	
	/**
	 * Insère une réponse
	 * @param $question
	 * @param $reponse
	 * @param $estBonne 
	 */
	public function addReponse($question, $reponse, $estBonne){
		$aReponse=new Reponse();
		$aReponse->setEstBonne($estBonne);
		$aReponse->setLibelle($reponse);
		$aReponse->setQuestion($question);
		
		return DAO::insert($aReponse);
	}
}