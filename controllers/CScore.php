<?php
class CScore extends \BaseController {
	
	public function index() {
		
	}
	
	/**
	 * Ajoute une couronne
	 * @param $domaine
	 * @param $joueur
	 * @param $partie
	 * @return insertion d'une nouvelle couronne
	 */
	public function newCrown($domaine, $joueur, $partie){
		$score = new Score();
		$score->setIdDomaine($domaine);
		$score->setIdJoueur($joueur);
		$score->setIdPartie($partie);
		$result=DAO::insert($score);
		
		$point = new CPoint();
		$initPoint=$point->checkPlayerPoint($partie, $joueur);
		$point->resetPoint($initPoint);
		
		return $result;
	}
	
	/**
	 * Retourne le nombre de couronne effectuées
	 */
	public function domaineDone($partie,$joueur){
		$domaine=DAO::getAll("Score"," idpartie=".$partie->getId()." AND idjoueur=".$joueur->getId());
		
		return $domaine;
	}
	
	/**
	 * Compte le nombre de couronne restantes
	 * @param $partie
	 * @param $joueur
	 * @return entier
	 */
	public function remainingCrown($partie, $joueur){
		$nbDomaine=$this->domaineDone($partie, $joueur);
		$count=count($nbDomaine);
		
		return $count;
	}
}