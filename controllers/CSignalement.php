<?php
class CSignalement extends \BaseController {
	
	public function index() {
		// TODO Auto-generated method stub
	}
	
	/**
	 * Ajout d'unsignalement
	 * @param $problem id du problem choisi
	 * @param $question id de la question posée
	 * @return boolean
	 */
	public function addSignal($problem, $question){
		$joueur=$_SESSION['player'];
		$quest=DAO::getOne("Question", $question);
		$probleme=DAO::getOne("Probleme", $problem);
			
		$date = new DateTime();
		$e=$date->format('Y-m-d H:i:s');
		$signal= new Signalement();
		$signal->setDateS($e);
		$signal->setProblem($probleme);
		$signal->setQuestion($quest);
		$signal->setJoueur($joueur);
		
		if(DAO::insert($signal)==1){
			return true; 
			
		}
		
	}
}