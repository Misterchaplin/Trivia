<?php 

$u="";
$i=1;
	foreach ($data as $question){
		if($u!=$question->getQuestion()->getId()){
			echo "<form id='frmCheckQuestion' name='frmCheckQuestion'>
			<br>Question : <br><label for='libelle'></label><input type='text' id='libelle' name='libelle' value='".$question->getQuestion()->getLibelle()."'><br>";
			$u=$question->getQuestion()->getId();
			echo "Reponse : <br>";
		}
			echo "<label for='reponse'><input type='text' id='reponse".$question->getId()."' name='reponse$i' value=".$question->getLibelle()." ><br>";
			echo"<input type='hidden' name='question' value='".$question->getQuestion()->getid()."'>";
			if($i<4){
				$i++;
			}else{
				$i=1;
			}
	}
	echo "<input type='button' value='Valider' class='btValider' id='btValider'></form>";

?>