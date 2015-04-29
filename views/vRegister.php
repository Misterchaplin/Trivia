
<form id="frmAdd" name="frmAdd">
	
		<label for="nom">Nom : </label><input type="text" id="nom" name="nom"><br>
		<label for="prenom">Prenom : </label><input type="text" id="prenom" name="prenom"><br>
		<label for="mail">Mail : </label><input type="mail" id="mail" name="mail"><br>
		<label for="login">Login : </label><input type="text" id="login" name="login"><br>
		<label for="password">Mot de passe : </label><input type="password" id="password" name="password"><br>
		<label for="idMonde">Monde : </label>
		
		<select id="idMonde" name="idMonde">
		<?php 
		
		
		foreach ($data as $monde){
		//	echo Gui::select($monde);
			echo "<option class='element' id='element".$monde->getId()."' value='".$monde->getId()."'>".$monde->getLibelle()."</option>";
			
		}
		?>
		</select>
		<hr>
		<input type="button" value="S'inscrire" id="btRegister">
		<!-- <input type="button" value="Se connecter" id="connect"> -->
</form>

