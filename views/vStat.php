<div id="stat">
<?php 

if(!empty($data)){
?>
<h3>Statistique</h3>
	<?php
	
	foreach ($data as $stat){
		if($stat->getDomaine()->getLibelle() !="Couronne"){
			echo $stat->getDomaine()->getLibelle()." : <br>";
			echo"<progress id='avancement' value='".$stat->getNbBonnesReponses() * 100 / $stat->getNbReponses()."' max='100'></progress></p>";
		}
	}
}
	
	?>
</div>
