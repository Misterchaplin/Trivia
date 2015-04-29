<?php
class CJoueur extends \BaseController {
	
	
	public function index() {
		$this->loadView("vHeader");
		$this->refresh();
		echo "<div id='divMessage'></div>";
	}
	
	
	public function refresh(){
		$joueurs=DAO::getAll("Joueur");
		$this->loadView("vJoueurs",$joueurs);
		echo JsUtils::getAndBindTo("#addNew", "click", "/Trivia/CJoueur/viewAddNew/","{}","#divFrm");
		echo JsUtils::getAndBindTo(".delete", "click", "/Trivia/CJoueur/delete","{}","#divMessage");
	}
	
	
	
	/**
	 * Appel de addNew au click
	 */
	public function viewAddNew(){
		$this->loadView("vAddJoueur");
		echo JsUtils::postFormAndBindTo("#btValider", "click", "/Trivia/CJoueur/addNew/", "frmAdd","#divMessage");
	}
	
	/**
	 * Ajout d'un nouveau joueur
	 */
	public function addNew(){
		$nouveau = new Joueur();
		RequestUtils::setValuesToObject($nouveau);
		$monde=DAO::getOne("Monde", $_POST["idMonde"]);
		$nouveau->setMonde($monde);
		if(DAO::insert($nouveau)==1){
			echo "Insertion de ".$nouveau." ok";
			echo JsUtils::get("/Trivia/CJoueur/refresh","{}","#divListe");
		}
	}
	

}