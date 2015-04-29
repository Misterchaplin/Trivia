	<div class="container">
		<div class="row">
			<div class="span4">
				<div class="roulette_container" >
					<div class="roulette" style="display:none;">
						
						<?php
							foreach ($data as $domaine){
								echo'<img data-value="'.$domaine->getId().'" src="/Trivia/image/'.$domaine->getIcon().'"/>';
							}	
						?>
						</div>
					</div>
					<div class="btn_container">
						<p>
							<button class="btn btn-large btn-primary start"> START </button>
						</p>
					</div>
				</div>
				
				<div id="speed" style="display:none;"></div>
						
				<!--<span class="param_name">stop image number :</span> <span class="stop_image_number_param"></span>-->
					
				<input id="stopImageNumber" name="stopImageNumber" style="display:none;"/>
				<span class="image_sample" style="display:none;">
					<input id="mage" value=" <?php echo $_SESSION['domaine']; ?>" />
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