

<div id="contain">
<div id="progressbar" class="progress-font" ><div class="progress-label"></div></div>
	<div id="question">
		<h1>Questions</h1>
		<?php 
		
		$passed=false;
		foreach ($data['question'] as $reponses){
			//foreach ($reponses as $reponse){
				
				if($passed==false){
					echo "<p id=laQuestion>".$reponses->getQuestion()."</p>";
					$passed=true;
				}
				if ($reponses->getQuestion()!=null){
					echo "<a href='#' class='reponse' id='_".$reponses->getQuestion()->getId()."_".$reponses->getId()."'>".$reponses->getLibelle()."</a><br>";
				}
				
			}
			
	//	}
		
		echo"<a href='#' class='textProblem' id='1'></a>";
		?>
	</div>

<div id="message"></div>
<div id="problem"></div>


<div id="sp" title="Signalement">
	<form id="frmSport" name="frmSport">
	<input type="hidden" name="question" value="<?php echo $reponses->getQuestion()->getId(); ?>" id="idQuestion"> 
	<input type="hidden" name="etat" value="" id="etat">
		<select name="sport">
		<?php 
		foreach ($data['probleme'] as $e){
		?>
			<option value="<?php echo $e->getId(); ?>" ><?php echo $e->getLibelle(); ?></option>
		<?php 
		}
		?>
		</select>
		
	</form>
</div>
	
	<div id="answer" title="Signalement"></div>
	<div id="divTarget"></div>
</div>
