<?php
class CDomaine extends \BaseController {
	
	public function index() {
		$joueur = $_SESSION['player'];
		$partie = $_SESSION['partie'];
		$this->loadView("vHeader");
		
		$this->selectDomaine($joueur);
		$domains = $this->selectDomaines($joueur);
		$this->loadView("vDomaine",$domains);
		$notif=new CUtils();
		$notif->notification($partie, $joueur);
		echo JsUtils::getAndBindTo("#trivia", "click", "/Trivia/CPartie/index","{}","body");
		echo JsUtils::getAndBindTo(".nextQuestion", "click", "/Trivia/CDomaine/redir","{}","body");
	}
	
	/**
	 * Redirection si on joue jour une couronne ou non 
	 * @param $couronne
	 */
	public function redir($couronne){
	
		if($couronne["0"]==1){
			echo JsUtils::get("/Trivia/CDomaine/couronne","{}","body");
		}else{
			echo JsUtils::get("/Trivia/CQuestion/index","{}","body");
		}
	}
	
	/**
	 * Retourne un domaine aléatoire
	 * @param unknown $joueur
	 * @return $domaine
	 */
	public function selectDomaine($joueur){	
		$domaine = DAO::getOne("Domaine","idMonde =".$joueur->getMonde()->getId()." ORDER BY rand() limit 1");
		//$domaine = DAO::getOne("Domaine","idMonde =".$joueur->getMonde()->getId()." AND libelle like 'Couronne'");
		$_SESSION['domaine'] = $domaine;
	
		return $domaine;
	}
	
	/**
	 * Récupère tous les domaines qui font partie du monde du joueur
	 * @param unknown $joueur
	 * @return $domaine
	 */
	public function selectDomaines($joueur){
		$domaine = DAO::getAll("Domaine","idMonde =".$joueur->getMonde()->getId());

		return $domaine;
	}
	
	/**
	 * les domaines qui ne sont pas encore des couronnes
	 * @param unknown $partie
	 * @param unknown $joueur
	 * @return $domains
	 */
	public function selectDomaineToCrown($partie,$joueur){
		$score=new CScore();
		$checkedDomain=$score->domaineDone($partie,$joueur);
		$aChecked=array();
		foreach ($checkedDomain as $aCheckedDomain){
			$aChecked[]=$aCheckedDomain->getIdDomaine()->getId();
		}
		$domaines=$this->selectDomaines($joueur);
		$domains=array();
		foreach ($domaines as $aDomaine){
			if(!in_array($aDomaine->getId(), $aChecked)){
				if($aDomaine->getLibelle()!="Couronne"){
					$domains[]=$aDomaine;
				}
			}
		}
		
		return $domains;
	}
	
	/**
	 * Affiche les domaines restant pour la couronne
	 */
	public function couronne(){
		$joueur = $_SESSION['player'];
		$partie = $_SESSION['partie'];
		$this->loadView("vHeader");
		$domaine=$this->selectDomaineToCrown($partie, $joueur);
		$this->loadView("vCouronne",$domaine);
		echo JsUtils::doSomethingOn("#linkCouronneQuestion", "hide");
		echo JsUtils::getAndBindTo(".imgDomaine", "click", "/Trivia/CDomaine/addDomaineCouronne","{}","#message");
	
		
	}
	
	/**
	 * On récupère le domaine choisi pour jouer la couronne
	 */
	public function addDomaineCouronne($domaine){
		
		$_SESSION['couronne']=DAO::getOne("Domaine", $domaine["0"]); 
		echo JsUtils::doSomethingOn("#linkCouronneQuestion", "show");
		echo JsUtils::getAndBindTo("#linkCouronneQuestion", "click","/trivia/CQuestion/index","{}","body");
	}
	
	
}