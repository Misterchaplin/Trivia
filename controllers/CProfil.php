<?php
class CProfil extends \BaseController {
	
	public function index() {
		if(!isset($_SESSION['player'])){
			echo JsUtils::execute('window.location = "CLogin"');
		}
			$this->loadView("vHeader");
			$this->refresh();
	}
	
	public function refresh(){
		$this->loadView("vProfil");
		$this->changeLog();
		echo JsUtils::getAndBindTo("#backGame", "click", "/Trivia/CPartie/index","{}","#contain");
		echo JsUtils::getAndBindTo("#addQuestion", "click", "/Trivia/CProfil/addQuestion","{}","#notif");
		echo JsUtils::getAndBindTo("#checkQuestion", "click", "/Trivia/CProfil/checkQuestion","{}","#notif");
	}
	
	/**
	 * Questions pas encore validées
	 */
	public function checkQuestion(){
		echo JsUtils::doSomethingOn("#frmChangeLog", "hide");
		$question=DAO::getOne("Question","validation=0");
		if($question instanceof Question){
	
			$reponses=DAO::getAll("Reponse","idquestion=".$question->getId());
			$this->loadView("vCheckQuestion",$reponses);
			echo JsUtils::postFormAndBindTo("#btValider", "click", "/Trivia/Cprofil/updateCheckQuestion/", "frmCheckQuestion", "#notif");
		}
	}
	
	/**
	 * Validation des questions avec leur réponses
	 */
	public function updateCheckQuestion(){
		$question=htmlspecialchars($_POST['question']);
		$reponses=DAO::getAll("Reponse", "idquestion=".$question);
		$aQuestion=DAO::getOne("Question", $question);
		$libelle=htmlspecialchars($_POST['libelle']);
		$reponse1=htmlspecialchars($_POST['reponse1']);
		$reponse2=htmlspecialchars($_POST['reponse2']);
		$reponse3=htmlspecialchars($_POST['reponse3']);
		$reponse4=htmlspecialchars($_POST['reponse4']);
		$answer=array($reponse1, $reponse2, $reponse3, $reponse4);
		
		$reponse="";
		$valeur=array();
		$passed=true;
		foreach ($reponses as $aReponses){
			$passed=true;
			if($aReponses->getId()!=$reponse){	
				$reponse=$aReponses->getId();
				$eponse=DAO::getOne("Reponse", "id=".$reponse);
				foreach ($answer as $aAnswer){
					if(!in_array($aAnswer,$valeur)){	
						if($passed==true){
							$valeur[]=$aAnswer;
						 	$eponse->setLibelle($aAnswer);
							if(DAO::update($eponse)==1){
								$passed=false;
							}
						}
					}
				}
			}
			
		}
		$aQuestion->setLibelle($libelle);
		$aQuestion->setValidation("1");
		if(DAO::update($aQuestion)==1){
			echo "Modification prise.";
		}
		
		
		
	}
	
	/**
	 * Ajouter une question avec ses réponses
	 */
	public function addQuestion(){
		$player=$_SESSION['player'];
		echo JsUtils::doSomethingOn("#frmChangeLog", "hide");
		$aDomaine=new CDomaine();
		$domaine=$aDomaine->selectDomaines($player);
		$this->loadView("vAddQuestion",$domaine);
		echo JsUtils::getAndBindTo("#changeLog", "click", "/Trivia/CProfil/changeLog","{}","#notif");
		echo JsUtils::postFormAndBindTo("#btInsertQuestion", "click", "/Trivia/CProfil/addNewQuestion/", "frmAjouterQuestion","#notif");
	}
	
	/**
	 * traitement de l'ajout des questions et réponses
	 */
	public function addNewQuestion(){
		if(!empty($_POST['libelle'])
			&& !empty($_POST['reponse1'])
			&& !empty($_POST['reponse2'])
			&& !empty($_POST['reponse3'])
			&& !empty($_POST['reponse4'])
			&& !empty($_POST['iddomaine'])){
			
			$joueur=$_SESSION['player'];
			$domain=htmlspecialchars($_POST['iddomaine']);
			$libelle=htmlspecialchars($_POST['libelle']);
			$reponse1=htmlspecialchars($_POST['reponse1']);
			$reponse2=htmlspecialchars($_POST['reponse2']);
			$reponse3=htmlspecialchars($_POST['reponse3']);
			$reponse4=htmlspecialchars($_POST['reponse4']);
			$answer=array($reponse1,$reponse2, $reponse3, $reponse4);
			
			$domaine=DAO::getOne("Domaine", "id=".$domain);
			$question=new CQuestion();
			if($question->addQuestion($domaine, $joueur, $libelle)==1){
				$id=DAO::getOne("Question", "iddomaine=".$domaine->getId()." AND idjoueur=".$joueur->getId()." ORDER BY id DESC LIMIT 1");
				$rep=new CReponse();
				$i=0;
				foreach ($answer as $aAnswer){
					if($i!=3){
						$rep->addReponse($id, $aAnswer, "0");
						$i++;
					}else{
						$rep->addReponse($id, $aAnswer, "1");
						echo "insertion effectuée et en attente de modération par d'autre joueur.";
					}
				}
			}
			
		}
		else{
			echo "Veuillez compléter les informations.";
		}
	}
	
	/**
	 * Changement de mdp et login
	 */
	public function changeLog(){
		$this->loadView("vLog",$_SESSION["player"]);
		echo JsUtils::postFormAndBindTo("#btUpdateLog", "click", "/Trivia/CProfil/updateLog/", "frmChangeLog","#notif");
	}
	
	/**
	 * traitement mdp et login
	 */
	public function updateLog(){
		if(!empty($_POST['login']) && !empty($_POST['password'])){
			$joueur=$_SESSION['player'];
			$login=htmlspecialchars($_POST['login']);
			$password=$_POST['password'];
			$password=hash("sha512",$password);
			$joueur->setLogin($login);
			$joueur->setPassword($password);
			if(DAO::update($joueur)==1){
				$_SESSION['player']=$joueur;
				echo "Identifiant changé.";
			}else{
				echo "erreur dans l'opération.";
			}
		}else{
			echo JsUtils::get("/Trivia/CProfil/index","{}","#contain");
		}
	}
	
	
	
}