<?php

class CQuestion extends \BaseController {
	
	public function index() {
		$this->loadView("vHeader");
		$this->refresh();	
	
	}
	
	public function refresh(){
		$reponse = new CReponse();
		$problem=new CProblem();
		$reponses= $reponse->afficherReponses();
		$problems=$problem->listPoblem();
		shuffle($reponses);
		
		$this->loadView("vQuestion",array("question"=>$reponses,"probleme"=>$problems));
		
		foreach ($reponses as $reponse){
			$rep=$reponse->getQuestion()->getId();
		}
		echo JsUtils::getAndBindTo(".reponse", "click", "/Trivia/CQuestion/checkAnswer","{}","#message");
		//echo JsUtils::getAndBindTo(".textProblem", "click", "/Trivia/CProblem/problem/".$rep,"{}","#problem");
		
	}
	
	/**
	 * Récupère une question pour une couronne ou non
	 * @return $aQuestion
	 */
	public function nouvelleQuestion () {
		if(!empty($_SESSION['couronne'])){
			$domaine=$_SESSION['couronne']->getId();
		}else{
			$domaine = $_SESSION['domaine']->getId();
		}
		$aQuestion=DAO::getOne("Question", "iddomaine =".$domaine." AND validation =1 order by rand() limit 1");
		return $aQuestion;
	}

	
	/**
	 * Test la réponse choisie
	 * @param $reponse
	 */
	public function checkAnswer($reponse){
		$params=implode("_",$reponse);
		$param=explode("_",substr($params,1));
		$reponse=new CReponse();
		$estBonne=$reponse->getReponse($param[0], $param[1]);
		$partie=$_SESSION['partie'];
		$player=$_SESSION['player'];
		$domaine=$_SESSION['domaine'];
		$date = new DateTime();
		$dateTime=$date->format('Y-m-d H:i:s');
		$partie->setDernierCoup($dateTime);
		
		$this->addPlayerPoint($partie, $player);
		
		if($estBonne->getEstBonne()=="1"){
			echo JsUtils::doSomethingOn("#_".$param[0]."_".$param[1], "addClass", "'vrai'");
			if(DAO::update($partie)==1){
				$this->point($partie, $player);
			}
		}else{
			$rep = $reponse->rep($param[0]);
			foreach ($rep as $aRep){
				if ($aRep->getEstBonne()==1){
					echo JsUtils::doSomethingOn("#_".$param[0]."_".$aRep->getId(), "addClass", "'true'");
				}
			}
			if(!empty($_SESSION['couronne'])){
				unset($_SESSION['couronne']);
			}else{
				$stat=new CStat();
				$stat->answer($player, $domaine);
			}
			
			if(DAO::update($partie)==1){
				$aJoueurPartieEnCours=new CPartie();
				if($aJoueurPartieEnCours->partFinished($partie->getId())==1){
					echo JsUtils::doSomethingOn("#etat", "val","1");
					echo JsUtils::doSomethingOn("#answer", "append","'<p>Partie terminée<br> Nombre de manche atteinte.</p>'");
					$win=$this->whoWin($partie);
					if($win!="Egalité"){
						echo JsUtils::doSomethingOn("#answer", "append","'<p>'.$win.' à gagné</p>'");
					
						echo JsUtils::dialogPlus("/trivia/CProblem/addproblem","#frmSport","#answer","#sp", "btn-close", "btn-signal","btn-add", "Fermer", "Signaler","Ajouter","#contain");
						echo JsUtils::getAndBindTo(".btn-close", "click", "/trivia/CPartie/index","{}","#contain");
						echo JsUtils::getAndBindTo(".btn-signal", "click", "/trivia/CProblem/addproblem","{}","#contain");
					}else{
						echo JsUtils::doSomethingOn("#answer", "append","'<p>Egalité</p>'");
					
						echo JsUtils::dialogPlus("/trivia/CProblem/addproblem","#frmSport","#answer","#sp", "btn-close", "btn-signal","btn-add", "Fermer", "Signaler","Ajouter","#contain");
						echo JsUtils::getAndBindTo(".btn-close", "click", "/trivia/CPartie/index","{}","#contain");
						//echo JsUtils::getAndBindTo(".btn-signal", "click", "/trivia/CProblem/addproblem","{}","#contain");
					}
				
				}elseif($aJoueurPartieEnCours->joueurPartieEnCours($partie->getId(), $player)==1){
					echo JsUtils::doSomethingOn("#etat", "val","1");
					echo JsUtils::doSomethingOn("#_".$param[0]."_".$param[1], "addClass", "'false'");
					echo JsUtils::doSomethingOn("#answer", "append","'<p>Mauvaise réponse</p>'");
					
					//echo JsUtils::dialogPlus("/trivia/CProblem/addproblem","#frmSignalement","#message","#signalement", "btn-close", "btn-signal","btn-add", "Fermer", "Signaler","Ajouter","#contain");
					echo JsUtils::dialogPlus("/trivia/CProblem/addproblem","#frmSport","#answer","#sp", "btn-close", "btn-signal","btn-add", "Fermer", "Signaler","Ajouter","#contain");
					echo JsUtils::getAndBindTo(".btn-close", "click", "/trivia/CPartie/index","{}","#contain");
					//echo JsUtils::getAndBindTo(".btn-signal", "click", "/trivia/CProblem/addproblem","{}","#contain");

				}
			}
		}
	}
	
	/**
	 * Retourne le gagnant ou l'égalitée
	 * @param $partie
	 * @return $win
	 */
	public function whoWin($partie){
		$j=DAO::getOne("Partie","id=".$partie->getId());
	
		$score=new CScore();
		$scoreJoueur1=$score->domaineDone($partie, $j->getJoueur1());
		$scoreJoueur2=$score->domaineDone($partie, $j->getJoueur2());
		$CountScoreJoueur1=count($scoreJoueur1);
		$CountScoreJoueur2=count($scoreJoueur2);
		if($CountScoreJoueur1 > $CountScoreJoueur2){
			$win=$scoreJoueur1;
		}elseif ($CountScoreJoueur2 > $CountScoreJoueur1){
			$win=$scoreJoueur2;
		}else{
			$pointJoueur1=DAO::getOne("Point", "idpartie=".$partie->getId()." AND idjoueur=".$j->getJoueur1()->getId());
			$pointJoueur2=DAO::getOne("Point", "idpartie=".$partie->getId()." AND idjoueur=".$j->getJoueur2()->getId());
			if($pointJoueur1->getNbPoint() > $pointJoueur2->getNbPoint()){
				$win=$j->getJoueur1();
			}elseif ($pointJoueur2->getNbPoint() >$pointJoueur1->getNbPoint()){
				$win=$j->getJoueur2();
			}else{
				$win="Egalité";
			}
		}
		return $win;
	
	}
	
	/**
	 * Check les redirections suivant si on a joué pour une couronne,
	 * si on a atteint 3 points on va sur choisir un domaine
	 * sinonon continu à jouer
	 */
	public function point($partie, $player){
		$point=new CPoint();
		$stat=new CStat();
		$domaine=$_SESSION['domaine'];
	
		$ajouterPoint=$point->checkPlayerPoint($partie, $player);
		if($point->gagnerPoint($ajouterPoint)==1){
			$stat=new CStat();
			$stat->goodAnswer($player, $domaine);
			
				if(!empty($_SESSION['couronne'])){
					$this->ifCouronne($partie, $player);
				}
				elseif($point->couronne($partie, $player)>= 3){
					echo JsUtils::doSomethingOn("#etat", "val","2");
					echo JsUtils::doSomethingOn("#answer", "append","'Vous allez jouer pour une couronne'");
					echo JsUtils::dialogPlus("/trivia/CProblem/addproblem","#frmSport","#answer","#sp", "btn-close", "btn-signal","btn-add", "Fermer", "Signaler","Ajouter","#contain");
					echo JsUtils::getAndBindTo(".btn-close", "click", "/trivia/CDomaine/couronne","{}","#contain");
					echo JsUtils::getAndBindTo(".btn-signal", "click", "/trivia/CProblem/addproblem","{}","#contain");
				}else{
					echo JsUtils::doSomethingOn("#etat", "val","3");
					echo JsUtils::doSomethingOn("#answer", "append","'Bonne réponse'");
					echo JsUtils::dialogPlus("/trivia/CProblem/addproblem","#frmSport","#answer","#sp", "btn-close", "btn-signal","btn-add", "Fermer", "Signaler","Ajouter","#contain");
					echo JsUtils::getAndBindTo(".btn-close", "click", "/trivia/CDomaine/index","{}","#contain");
					echo JsUtils::getAndBindTo(".btn-signal", "click", "/trivia/CProblem/addproblem","{}","#contain");
				}
		}
	}
	
	/**
	 * On verifie s'il y a une couronne
	 * @param $partie
	 * @param $player
	 */
	public function ifCouronne($partie, $player){
		$score=new CScore();
		$part=new CPartie();
		
		if($score->newCrown($_SESSION['couronne'], $player, $partie)==1){
			if($score->remainingCrown($partie, $player)=="3"){
				$part->updatePartFinished($partie);
				unset($_SESSION['couronne']);
				echo JsUtils::doSomethingOn("#frmSignal", "append","'<input type=\'hidden\' id=\'etat\' name=\'etat\' value=\'1\'>'");
				echo JsUtils::doSomethingOn("#answer", "append","'Vous avez gagné la partie!!'");
				echo JsUtils::dialogPlus("/trivia/CProblem/addproblem","#frmSport","#answer","#sp", "btn-close", "btn-signal","btn-add", "Fermer", "Signaler","Ajouter","#contain");
				echo JsUtils::getAndBindTo(".btn-close", "click", "/trivia/CPartie/index","{}","#contain");
				echo JsUtils::getAndBindTo(".btn-signal", "click", "/trivia/CProblem/addproblem","{}","#contain");
				
			}else{
				unset($_SESSION['couronne']);
				echo JsUtils::doSomethingOn("#frmSignal", "append","'<input type=\'hidden\' id=\'etat\' name=\'etat\' value=\'2\'>'");
				echo JsUtils::doSomethingOn("#answer", "append","'Bonne réponse.<br>Nouvelle couronne'");
				echo JsUtils::dialogPlus("/trivia/CProblem/addproblem","#frmSport","#answer","#sp", "btn-close", "btn-signal","btn-add", "Fermer", "Signaler","Ajouter","#contain");
				echo JsUtils::getAndBindTo(".btn-close", "click", "/trivia/CDomaine/index","{}","#contain");
				echo JsUtils::getAndBindTo(".btn-signal", "click", "/trivia/CProblem/addproblem","{}","#contain");
			}
		}
	}
	
	/**
	 * Ajoute un point à l'utilisateur
	 */
	public function addPlayerPoint(){
		$playerPoint=new CPoint();
		$partie=$_SESSION['partie'];
		$joueur=$_SESSION['player'];
		if($playerPoint->checkPlayerPoint($partie, $joueur)instanceof Point){
			$_SESSION['point']=$playerPoint->checkPlayerPoint($partie, $joueur);
		}
		else{
			$playerPoint->newScore($partie, $joueur);
		}
	}
	
	/**
	 * Si time out alors redirection
	 */
	public function timeOut(){
		$partie=$_SESSION['partie'];
		$joueur=$_SESSION['player'];
		$manche=$partie->getManche();
		
		$partie->setManche($manche+1);
		
		if(DAO::update($partie)==1){
			$aJoueurPartieEnCours=new CPartie();
			if($aJoueurPartieEnCours->joueurPartieEnCours($partie->getId(),$joueur)==1){
				echo JsUtils::execute('window.location = "/trivia/CPartie"');
				//echo JsUtils::get("/trivia/CPartie/index","{}","#contain");
			}
		}
	}

	/**
	 * Ajouter une question
	 * @param $domaine
	 * @param $joueur
	 * @param $libelle
	 * @return unknown
	 */
	public function addQuestion($domaine, $joueur, $libelle){
		$question=new Question();
		$question->setDomaine($domaine);
		$question->setJoueur($joueur);
		$question->setLibelle($libelle);
		$question->setValidation("0");
		$quest=DAO::insert($question);
		return $quest;
	}
}