<div id="ajouterQuestion">
	<form id="frmAjouterQuestion" name="frmAjouterQuestion">
			<label for="domaine">Domaine :</label>
			<select id="iddomaine" name="iddomaine">
				<?php 
				foreach ($data as $domaine){
					echo "<option class='element' id='element".$domaine->getId()."' value='".$domaine->getId()."'>".$domaine->getLibelle()."</option>";
					
				}
				?>
			</select><br>
			<label for="libelle">Question : </label><input type="text" id="libelle" name="libelle"><br>
			<label for="reponse1">Réponses 1: </label><input type="text" id="reponse1" name="reponse1"><br>
			<label for="reponse2">Réponses 2: </label><input type="text" id="reponse2" name="reponse2"><br>
			<label for="reponse3">Réponses 3: </label><input type="text" id="reponse3" name="reponse3"><br>
			<label for="reponse4">Réponses 4 (la bonne): </label><input type="text" id="reponse4" name="reponse4"><br>						
	
			<input type="button" value="Ajouter" id="btInsertQuestion">
					
	</form>
	<div id="notif"></div>
<div>