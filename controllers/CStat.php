<?php
class CStat extends \BaseController {
	
	public function index() {
		// TODO Auto-generated method stub
	}
	
	/**
	 * Liste des statistiques d'un joueur
	 * @param $joueur
	 * @return instance de Statistiques
	 */
	public function statDomaine($joueur){
		$stat=DAO::getAll("Statistiques","idjoueur=".$joueur->getId());
		return $stat;
	}
	
	/**
	 * Renvoie une statistique d'un joueur pour un domaine
	 * @param $player
	 * @param $domaine
	 * @return instance de Statistiques
	 */
	public function stats($player, $domaine){
		$stat=DAO::getOne("Statistiques", "idjoueur=".$player->getId()." AND iddomaine=".$domaine->getId());
		return $stat;
	}
	
	/**
	 * Créer une instance de statistique
	 * @param $player
	 * @param $domaine
	 * @return Statistiques
	 */
	public function initStat($player, $domaine){
		
		$statistique=new Statistiques();
		$statistique->setIdJoueur($player->getId());
		$statistique->setIdDomaine($domaine->getId());
		return $statistique;
	}
	
	/**
	 * Incremente de un une bonne réponse. Si la statistique n'existe pas encore elle est créée
	 * @param $player
	 * @param $domaine
	 * @return $result
	 */
	public function goodAnswer($player, $domaine){
		$stat=$this->stats($player, $domaine);
		
		if($stat!=null){
			
			$stat->incBonnesReponses();
			$result=DAO::update($stat);
		}else{
			$statistique=$this->initStat($player, $domaine);
			$statistique->incBonnesReponses();
			$result=DAO::insert($statistique);
			
		}
		return $result;
	}
	
	/**
	 * Increment de un le nombre de reponse
	 * @param $player
	 * @param $domaine
	 * @return result
	 */
	public function answer($player, $domaine){
		$stat=$this->stats($player, $domaine);
		if($stat!=null){
			$stat->incReponses();
			$result=DAO::update($stat);
		}else{
			$statistique=$this->initStat($player, $domaine);
			$statistique->incReponses();
			$result=DAO::insert($statistique);
		}
		return $result;
	}
}