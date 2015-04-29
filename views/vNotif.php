
<?php
echo"<div id='containNotif'>";
foreach ($data as $partie=>$e){
	
		if($partie == "partie"){
			echo"<div id='notifPartie'>";
			echo "<h2>Partie :</h2>";
			echo "Contre : ".$e->getJoueur2();
			echo"</div>";
		}
		elseif($partie == "score"){
			echo"<div id='notifScore'>
			<h2>Score :</h2>";
			$a=count($e);
			echo " ".$a;
			echo"</div>";
		}
		elseif($partie == "point"){
			echo "<div id='notifPoint'>
				<h2>Point :</h2>";
		if(!empty($e)){
				echo " ".$e->getNbpoint();
			}
			else{
				echo " 0";
			}
			echo"</div>";
		}
		
}
echo"</div>";
?>


