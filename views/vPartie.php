<div id="contain">
<h1 id="titre"><a href="#" id="trivia">Mission Trivia</a></h1>
<nav id="menu">
	<ul>
		<li><a href="#" id="logout">Déconnexion</a></li>
		<li><a href="#" class="profil">Profil</a></li>
	</ul>
</nav>	
<div class="clear"></div>

<div id="part">

<a href="#" id="linkAddPartie">Créer une partie</a><br><br>
<div id="listPartie">
<?php 

if(!empty($data)){

	foreach ($data as $partie=>$e){
		if($partie == "monTour"){
			echo "<h2>Votre tour</h2><br>";
			foreach ($e as $aPartie){
				echo'<a href="#" class="partie" id="partie'.$aPartie->getId().'" >'.$aPartie.'</a> <a href="#" class="imgPartie" id="partie'.$aPartie->getId().'"><img src="/Trivia/image/notification.png" /></a><br>';
			}
			echo"<br>";	
		}
		elseif($partie == "mesPartiesOuJeJoue"){
			echo "<h2>Mes parties</h2><br>";
			foreach ($e as $aPartie){
				echo'<a href="#" class="partie" id="partie'.$aPartie->getId().'" >'.$aPartie.'</a> <a href="#" class="imgPartie" id="partie'.$aPartie->getId().'"><img src="/Trivia/image/notification.png" /></a><br>';
			}
			echo"<br>";
		}
		elseif($partie == "autreParties"){
			echo "<h2>Parties disponible</h2><br>";
			foreach ($e as $aPartie){
				if($aPartie == null){
					echo "Aucune partie disponible";
				}
				echo'<a href="#" class="partie" id="partie'.$aPartie->getId().'" >'.$aPartie.'</a><br>';
			}
			echo"<br>";
		}
		else{
			echo "<h2>Parties terminée</h2><br>";
			foreach ($e as $aPartie){
				if($aPartie == null){
					echo "Aucune partie terminée";
				}
				echo'<a href="#" class="partFinished" id="partie'.$aPartie->getId().'" >'.$aPartie.'</a><br>';
			}
			
		}
	}
	
}
?>

 	
	

</div>
</div> 
<div id="escape"></div>
	<div id="divMessage"></div>
	<div class="createGame" title="Information">
	<p>Joueur: Joueur al�atoire</p>
	<p>Chercher: Trouver un joueur</p>
	</div>
	<div class="t" title="Information">
		<form id="joueure" name="joueure">
			<input type="text" id="person" name="person" placeholder="Trouver un joueur">
		</form>
		<div id="reception"></div>
	</div>

