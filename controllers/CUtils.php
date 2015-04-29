<?php
class CUtils extends \BaseController {
	public function index() {
		// TODO Auto-generated method stub
	}
	
	public function notification($partie, $joueur){
		$partie = DAO::getOne("Partie", "id=".$partie->getId());
		$score = DAO::getAll("Score","idjoueur=".$joueur->getId()." AND idpartie=".$partie->getId());
		$point=DAO::getOne("Point", "idjoueur=".$joueur->getId()." AND idpartie=".$partie->getId());
		$notif=array("partie"=>$partie,
					"score"=>$score,
					"point"=>$point
		);
		$this->loadView("vNotif",$notif);
	}
	
		
	
	/**
	 *Retourne le joueur qui a gagné
	 */
	public function whoWin($partie,$joueur){
		
		$score=new CScore();
		$scoreJoueur1=$score->domaineDone($partie, $partie->getJoueur1());
		$scoreJoueur2=$score->domaineDone($partie, $partie->getJoueur2());
		$CountScoreJoueur1=count($scoreJoueur1);
		$CountScoreJoueur2=count($scoreJoueur2);
		
		if($CountScoreJoueur1 > $CountScoreJoueur2){
			foreach ($scoreJoueur1 as $joueur1){
				$win=$joueur1->getIdJoueur()->getLogin();
			}
		}elseif ($CountScoreJoueur2 > $CountScoreJoueur1){
			foreach ($scoreJoueur2 as $joueur2){
				$win=$joueur2->getIdJoueur()->getLogin();
			}
		}else{
			$pointJoueur1=DAO::getOne("Point", "idpartie=".$partie->getId()." AND idjoueur=".$partie->getJoueur1()->getId());
			$pointJoueur2=DAO::getOne("Point", "idpartie=".$partie->getId()." AND idjoueur=".$partie->getJoueur2()->getId());
			if(!isset($pointJoueur1) || !isset($pointJoueur2)){
				$win="Pas de point";
			}
			elseif($pointJoueur1->getNbpoint() > $pointJoueur2->getNbpoint()){
				$win=$partie->getJoueur1()->getLogin();
			}elseif ($pointJoueur2->getNbpoint() >$pointJoueur1->getNbpoint()){
				$win=$partie->getJoueur2()->getLogin();
			}else{
				$win="Egalité";
			}
		
		}
		return $win;
	
	}
	
	
}