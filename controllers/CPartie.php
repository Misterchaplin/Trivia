<?php
class CPartie extends \BaseController {
		
	public function index() {
		if(!isset($_SESSION['player'])){
			echo JsUtils::execute('window.location = "CLogin"');
		}
		
			$this->loadView("vHeader");
			$this->refresh();
			$this->loadView("vFooter");
		//	unset($_SESSION['couronne']);
	}
	
	public function refresh(){
		
		$player = $_SESSION["player"];
		$myTurn = $this->showMyTurn($player->getId());
		$myParts = $this->showPartIPlay($player->getId());
		$otherParts = $this->showOtherParts($player->getId(),$player->getMonde());
		$finished = $this->finished($player->getId());
		$stat=new CStat();
		$domain=new CDomaine();
		$util=new CUtils();
		$statDomaine=$stat->statDomaine($player);
				
		$parts = array("monTour" => $myTurn,
				"mesPartiesOuJeJoue" => $myParts,
						"autreParties"=>$otherParts,
							"termine"=>$finished
		);
		
		$this->loadView("vPartie",$parts);
		$this->loadView("vStat",$statDomaine);
		
		echo JsUtils::getAndBindTo(".profil", "click", "/Trivia/CProfil/index/","{}","#contain");
		echo JsUtils::getAndBindTo("#linkAddPartie", "click", "/Trivia/CPartie/createGame/","{}","#escape");
		echo JsUtils::getAndBindTo("#trivia", "click", "/Trivia/CPartie/refresh/","{}","#contain");
		echo JsUtils::getAndBindTo(".partie", "click", "/Trivia/CPartie/checkPlayer","{}","#escape");
		echo JsUtils::getAndBindTo(".imgPartie", "click", "/Trivia/CPartie/infoPartie","{}","#escape");
		echo JsUtils::getAndBindTo(".partFinished", "click", "/Trivia/CPartie/infoPartie","{}","#escape");
		echo JsUtils::getAndBindTo("#logout", "click", "/Trivia/CLogin/logout","{}","#contain");
		
	}
	
	/**
	 * les parties où c'est mon tour
	 * @param $player instance du joueur
	 * @return $myGames
	 */
	public function showMyTurn($player){
		$myGames = DAO::getAll("Partie","idJoueurEnCours=".$player." AND finished=0 LIMIT 10");
		return $myGames;
	}
	
	/**
	 * les parties que je participe
	 * @param $player instance du joueur
	 * @return mes parties
	 */
	public function showPartIPlay($player){
		$myParts = DAO::getAll("Partie","finished=0 AND (idJoueur1=".$player." OR idJoueur2=".$player.") LIMIT 10");
		return $myParts;
	}
	
	/**
	 * les parties disponibles
	 * @param $player instance du joueur
	 * @param $monde id du monde
	 * @return Partie
	 */
	public function showOtherParts($player, $monde){
		$parts=array();
		$joueur = DAO::getAll("Joueur","idMonde =".$monde);
		$myParts = DAO::getAll("Partie","idJoueur1 !=".$player." AND idJoueur2 IS NULL LIMIT 10");

		foreach ($joueur as $aJoueur){
			$e[]=$aJoueur->getId();
		}

		foreach ($myParts as $aPart){
			$g=$aPart->getJoueur1()->getId();
			if(in_array($g,$e)){
				$parts[]=$aPart;
			}
		}
		return $parts;
	}
	
	/**
	 * Affiche les informations relative à une partie
	 * @param $partie
	 */
	public function infoPartie($partie){
		$idPartie = str_replace("partie", "", $partie[0]);
		$aPartie = DAO::getOne("Partie", $idPartie);
		$win=new CUtils();
		$joueur=$_SESSION['player'];
		$valeur=$win->whoWin($aPartie, $joueur);
		$this->loadView("vInfoPartie",array("enCours"=>$aPartie->getJoueurEnCours()->getLogin(),
				"joueur1"=>$aPartie->getJoueur1(),
				"joueur2"=>$aPartie->getJoueur2(),
				"manche"=>$aPartie->getManche(),
				"finish"=>$aPartie->getFinished(),
				"valeur"=>$valeur
		));
	}
	
	/**
	 * @return les parties terminées 
	 */
	public function finished($player){
		$myPartsFinished = DAO::getAll("Partie","finished=1 AND (idJoueur1=".$player." OR idJoueur2=".$player.") LIMIT 10");
		return $myPartsFinished;
	}
	

	/**
	 * Evènement du click sur les bouton pour créer une partie
	 * @param $player
	 */
	public function createGame($player){
		echo JsUtils::dialogPlus("/trivia/CPartie/insertCreateGame","#person",".createGame",".t", "btn-close", "btn-search","btn-add", "Jouer", "Chercher","Ajouter","#reception");
		echo JsUtils::postFormAndBindTo("#person", "keyup", "/trivia/CPartie/search", "joueure","#reception");
		echo JsUtils::getAndBindTo(".btn-close", "click", "/trivia/CPartie/insertCreateGame","{}","#contain");
		echo JsUtils::getAndBindTo(".btn-add", "click", "/trivia/CPartie/insertCreateGame","{}","#contain");
	}
	
	/**
	 * Création d'une nouvelle partie
	 * @param $player instance du joueur
	 */
	public function insertCreateGame(){
	
		if(isset($_POST['person'])){
			$login=$_POST['person'];
			$person=DAO::getAll("Joueur","login like '$login%' LIMIT 10");
			$enemy="";
			foreach ($person as $aPerson){
				if($enemy==""){
					$enemy=$aPerson;
				}
			}
		}
		$player = $_SESSION["player"];
		$jouer = new Partie();
		$jouer->setJoueur1($player);
		$jouer->setJoueurEnCours($player);
		if(isset($enemy)){
			$jouer->setJoueur2($enemy);
		}
		if(DAO::insert($jouer)==1){
			
			echo $jouer." inséré";
			echo JsUtils::get("/trivia/CPartie/refresh","{}","body");
			echo JsUtils::doSomethingOn("#divMessage", "hide",5000);
		}
		else{
			echo "Partie impossible Ã  crÃ©er";
		}
	}
	
	/**
	 * Rechercher une personne
	 */
	public function search(){
		$login=$_POST['person'];
		$person=DAO::getAll("Joueur","login like '$login%' LIMIT 10");
		foreach ($person as $aPerson){
			echo JsUtils::doSomethingOn("#reception", "append","'<li class=\"suggest\">".$aPerson->getLogin()."</li><br>'");
		}
		
	}
	
	/**
	 * 
	 * @param $partie instance du joueur
	 * @return valide si la partie dispose de 2 joueurs
	 */
	public function checkPlayer($partie){
		if(!empty($partie)){
			$idPartie = str_replace("partie", "", $partie[0]);
			$aPartie = DAO::getOne("Partie", $idPartie);
			$player=$_SESSION['player'];
			
			if($aPartie->getJoueur2() == null){
				$aPartie->setJoueur2($player);
				$aPartie->setJoueurEnCours($player);
				$aPartie->setDernierCoup($this->initialiserPartie($idPartie));
				
				if(DAO::update($aPartie)==1){
					$_SESSION['partie']= $aPartie;
				//	echo JsUtils::execute('window.location = "/trivia/CDomaine"');
					echo JsUtils::get("/Trivia/CDomaine/index","{}","#contain");
					//echo JsUtils::get("/Trivia/CDomaine/index","{}","body");
				}
			}
			elseif($aPartie->getJoueur2()->getId()== $_SESSION['player']->getId() || $aPartie->getJoueur1()->getId()== $_SESSION['player']->getId()){
				if($_SESSION['player']->getId()==$aPartie->getJoueurEnCours()->getId()){
					$_SESSION['partie']= $aPartie;
					//echo JsUtils::execute('window.location = "/trivia/CDomaine"');
					echo JsUtils::get("/Trivia/CDomaine/index","{}","body");
				}
				else{
					echo "Ce n'est pas votre tour.";
				}
			}
			else{
				echo"Vous n'êtes pas inscrit dans la partie.";
			}
		}
		
	}
	
	/**
	 * Retourne l'heure du serveur
	 * @param $partie
	 * @return heure
	 */
	public function initialiserPartie($partie){
		$date = new DateTime();
		$dateTime=$date->format('Y-m-d H:i:s');
		$_SESSION['partie']= $partie;
		
		return $dateTime;
	}
	
	
	/**
	 * Joueur de la partie en cours
	 * @param $partie
	 * @param $joueur
	 * @return joueur
	 */
	public function joueurPartieEnCours($partie, $joueur){
		$partie=DAO::getOne("Partie", $partie);
		
		$result=null;
		if($partie->getJoueurEnCours()==$partie->getJoueur1()){
			$partie->setJoueurEnCours($partie->getJoueur2());
			$manche=$partie->getManche();
			$partie->setManche($manche+1);
			
			$result=DAO::update($partie);
			
		}
		else{
			if($partie->getJoueur2()== null){
				$partie->setJoueurEnCours(null);
				$result=DAO::update($partie);
			}
			else{
				$partie->setJoueurEnCours($partie->getJoueur1());
				$result=DAO::update($partie);
			}
		}
		if(!empty($_SESSION['couronne'])){
			$point = new CPoint();
			$initPoint=$point->checkPlayerPoint($partie, $joueur);
			$point->resetPoint($initPoint);
		}	
		return $result;
	}
	
	
	/**
	 * On verifie si la partie en cours est terminée
	 * @param unknown $partie
	 */
	public function partFinished($partie){
		$part=DAO::getOne("Partie", "id=".$partie." AND manche >=25");
		$result=false;
		if($part!=null){
			$result=$this->updatePartFinished($part);
		}
		return $result;
	}
	
	/**
	 * 
	 * On indique que la partie est terminée
	 */
	public function updatePartFinished($part){
		$partie=DAO::getOne("Partie", "id=".$part->getId());
		$partie->setFinished("1");
		return DAO::update($partie);
	}

	
}