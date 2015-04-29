<div id="contain">
<div class="container">
<h1 id="titre"><a href="#" id="trivia">Mission Trivia</a></h1>
		<div class="row">
			<div class="span4">
				<div class="roulette_container" >
					<div class="roulette" style="display:none;">
						
						<?php
						$i=0;
						$couronne = 0;
						foreach ($data as $domaine){
							echo'<img data-value="'.$i.'" class="e" id="'.$domaine->getIcon().'" src="/Trivia/image/'.$domaine->getIcon().'"/>';
							if($domaine->getId() == $_SESSION['domaine']->getId()){
								$value= $i;
								if($domaine->getLibelle()=="Couronne"){
									$couronne=1;
								}
							}
							$i++;
						}
						?>
						</div>
					</div>
					<div class="btn_container">
						<p>
							<button class="btn btn-large btn-primary start"> START </button>
						</p>
					</div>
					<div id="message"><a href="#" class="nextQuestion" id="<?php echo $couronne; ?>" >Afficher question suivante</a></div>
				</div>
				
				<div id="speed" style="display:none;"></div>
						
				<!--<span class="param_name">stop image number :</span> <span class="stop_image_number_param"></span>-->
					
				<input id="stopImageNumber" name="stopImageNumber" style="display:none;"/>
				<span class="image_sample" style="display:none;">
					<input id="mage" value="<?php echo $value; ?>" />
				</span>
			</div>
			<pre style="display:none">
		
				var option = {
					speed : <span class="speed_param"></span>,
					duration : <span class="duration_param"></span>,
					stopImageNumber : <span class="stop_image_number_param"></span>,
					startCallback : function() {
						console.log('start');
					},
					slowDownCallback : function() {
						console.log('slowDown');
					},
					stopCallback : function($stopElm) {
						console.log('stop');
					}
				}
				$('div.roulette').roulette(option);	
			</pre>
						
		</div>
	</div>
</div>
	
	




