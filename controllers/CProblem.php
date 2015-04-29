<?php
class CProblem extends \BaseController {
	
	public function index() {
		$this->addproblem();
	}
	
	/*public function problem(){
		$this->loadView("vproblem");
		$question=$_GET['c'];
		$aQuestion= str_replace("CProblem/problem/", "", $question);
		//$aQuestion= str_replace("/undefined", "", $aQuestion);
		$aQuestion= str_replace("/1", "", $aQuestion);
		
		echo JsUtils::doSomethingOn("#hide", "val", "'$aQuestion'");
		echo JsUtils::postFormAndBindTo("#submitProblem", "click", "/trivia/CProblem/addproblem/", "frmProblem","#problem");
	
	}*/
	
	/**
	 * 
	 * @return Liste des problémes
	 */
	public function listPoblem(){
		$problem=DAO::getAll("Probleme");
		
		return $problem;
	}
	
	/**
	 * Ajout d'un probleme
	 */
	public function addproblem(){
		
	if(!empty($_POST['sport']) && !empty($_POST['question']) && !empty($_POST['etat'])){
		$libelle=htmlspecialchars($_POST['sport']);
		$question=htmlspecialchars($_POST['question']);
		$etat=$_POST['etat'];
		$signal = new CSignalement();
			if($signal->addSignal($libelle, $question)==1){
				if($etat=="1"){
					echo JsUtils::get("/trivia/CPartie/index","{}","#contain");
				}
				elseif($etat=="2"){
					echo JsUtils::get("/trivia/CDomaine/couronne","{}","#contain");
				}
				elseif($etat=="3"){
					echo JsUtils::get("/trivia/CDomaine/index","{}","#contain");
				}
			}
		
		}

	}
	

}