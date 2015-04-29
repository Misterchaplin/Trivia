<?php
class CPoint extends \BaseController {
	
	public function index() {
		// TODO Auto-generated method stub
	}
	
	/**
	 * Initialise une instance de point avec la partie et le joueur
	 * @param $partie
	 * @param $joueur
	 * @return Point
	 */
	public function init($partie, $joueur){
		$point = new Point();
		$point->setIdPartie($partie->getId());
		$point->setIdJoueur($joueur->getId());
		
		return $point;
	}
	
	/**
	 * Insére l'instance de point
	 * @param $partie
	 * @param $joueur
	 * @return $result
	 */
	public function newScore($partie, $joueur){
		$point=$this->init($partie, $joueur);
		$result=DAO::insert($point);
	
		return $result;
	}
	
	/**
	 * incremente le nombre de point
	 * @param $point
	 * @return $result
	 */
	public function gagnerPoint($point){
		$point->incPoints();
		$result=DAO::update($point);
	
		return $result;
	}
	
	/**
	 * Retourne une instance de point
	 * @param $partie
	 * @param $joueur
	 * @return $result
	 */
	public function checkPlayerPoint($partie, $joueur){
		$checked=DAO::getOne("Point", "idpartie=".$partie->getId()." AND idjoueur=".$joueur->getId());
		$result = false;
		if($checked != null){
			$result=$checked;
		}
		return $result;
	}
	
	
	/**
	 * Retourne une instance de point pour jouer la couronne
	 * @param $partie
	 * @param $joueur
	 */
	public function couronne($partie, $joueur){
		$nbPoint=DAO::getOne("Point", "idpartie=".$partie->getId()." AND idjoueur=".$joueur->getId());
		return $nbPoint->getNbpoint();
	}
	
	/**
	 * On initialise la valeur des points à zéros.
	 */
	public function resetPoint($point){
		$point->setNbpoint("0");
		$result=DAO::update($point);
	
	}
}