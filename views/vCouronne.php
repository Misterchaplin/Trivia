
<div id="contain">
	<div id="couronne">
		<?php 
			foreach ($data as $domaine){
				if($domaine->getLibelle()!="Couronne"){
					echo'<a href="#" class="imgDomaine" id="'.$domaine->getId().'" ><img src="/Trivia/image/'.$domaine->getIcon().'"/></a>';
			
				}		
			}
		?>
	</div>
</div>
<a href="#" id="linkCouronneQuestion">Passer à la question</a>
<div id="message"></div>