<?php

	echo"</fieldset></div>";

	echo"<div id='infoPartie'>
	<fielset>
		<legend>Etat de la partie:</legend>";
	//var_dump($data['valeur']);
		if($data['finish']=="1"){
			if($data['valeur']=="Egalit�"){
				echo $data['valeur']."<br>";
			}else{
				echo"Gagné: " .$data['valeur']."<br>";
			}
		}
	
		echo "Joueur: ".$data['joueur1']." VS ".$data['joueur2']."<br>";
	
		echo"Nombre de manche: " .$data['manche'];
	echo"</fieldset></div>";