<?php

class CReponse extends \BaseController {
	
	public function index() {
		$this->refresh();
	}
	
	public function refresh() {
		
	}
	
	/**
	 * Va chercher les r�ponses apr�s avoir r�cup�r� une question al�atoire
	 * @return r�ponses
	 */
	public function afficherReponses () {
		$question = new CQuestion();
		$aQuestion=$question->nouvelleQuestion();
		$reponses = DAO::getAll("Reponse", "idquestion =".$aQuestion->getId());
	
		return $reponses;
	}
	
	/**
	 * R�cup�re une liste de r�ponses 
	 * @param $question
	 * @return reponses
	 */
	public function rep($question){
		$reponses = DAO::getAll("Reponse", "idquestion =".$question);
		return $reponses;
	}
	
	/**
	 * R�cup�re une reponse avec les param�tres donn�es
	 * @param $idQuestion
	 * @param $idReponse
	 * @return reponse
	 */
	public function getReponse($idQuestion, $idReponse){
		$reponse = DAO::getOne("Reponse", "idquestion='".$idQuestion."' AND id='".$idReponse."'");
		return $reponse;
	}
	
	/**
	 * Ins�re une r�ponse
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