<?php
class CLogin extends \BaseController {
	
	public function index() {
		if(!empty($_SESSION['player'])){
			echo JsUtils::execute('window.location = "/trivia/CPartie"');
		}
			
			$this->loadView("vHeader");
			$this->refresh();
		
	}
	
	public function refresh(){
		$this->loadView("vLogin");
		echo JsUtils::getAndBindTo("#linkRegister", "click", "/Trivia/CLogin/viewAddNew/","{}","#blockRegister");
		
		echo JsUtils::postFormAndBindTo("#btlogin", "click", "/Trivia/CLogin/login/", "frmlog", "#divMessage");
	}
	

	public function viewAddNew(){
		echo JsUtils::doSomethingOn("#frmlog", "hide");
		echo JsUtils::doSomethingOn("#linkRegister", "hide");
		$mondes =DAO::getAll("Monde");
		$this->loadView("vHeader");
		$this->loadView("vRegister",$mondes);
		echo JsUtils::getAndBindTo("#connect", "click", "/Trivia/CLogin/index", "{}","#divMessage");
		echo JsUtils::postFormAndBindTo("#btRegister", "click", "/Trivia/CLogin/addNew/", "frmAdd","#divMessage");
	}
			
	/**
	 * Check la saisie du login
	 */
		public function login(){
			$joueur = new Joueur();
			RequestUtils::setValuesToObject($joueur);
			$login = htmlspecialchars($_POST['login']);
			$password = htmlspecialchars($_POST['password']);
			$password=hash("sha512",$password);
			
			if(!empty($login) && !empty($password)){
				$checkPlayer= DAO::getOne("Joueur", "login='".$login."'AND password='".$password."'");
				if($checkPlayer instanceof Joueur){
					$_SESSION['player']=$checkPlayer;
					echo JsUtils::get("/trivia/CPartie/index","{}","body");
				}	
				else{
					echo "Identifiant incorrect";
				}
			}
			else{
				echo"Entrer vos identifiant.";
			}
		}
		
		/**
		 * Ajouter nouveau joueur
		 */
		public function addNew(){
		$nouveau = new Joueur();
		RequestUtils::setValuesToObject($nouveau);
		$monde=DAO::getOne("Monde", $_POST["idMonde"]);
		$nom=htmlspecialchars($_POST['nom']);
		$prenom=htmlspecialchars($_POST['prenom']);
		$mail=htmlspecialchars($_POST['mail']);
		$login=htmlspecialchars($_POST['login']);
		$password=$_POST['password'];
		$password=hash("sha512",$password);
		$nouveau->setMonde($monde);
		$nouveau->setNom($nom);
		$nouveau->setPrenom($prenom);
		$nouveau->setMail($mail);
		$nouveau->setLogin($login);
		$nouveau->setPassword($password);
	
		if(DAO::insert($nouveau)==1){
			$_SESSION['player']=$nouveau;
			echo JsUtils::get("/trivia/CPartie/index","{}","body");
			//echo JsUtils::execute('window.location = "/trivia/CPartie"');
		}
		
	}
	
	
	public function logout(){
		session_unset();
		session_destroy();
		//echo JsUtils::execute('window.location = "/trivia/CLogin"');
		echo JsUtils::get("/trivia/CLogin/index","{}","body");
	}
	
		
}