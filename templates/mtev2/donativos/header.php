<div id="sub-header" class="head-donation">
	<div class="home container">
		<div layout="row" layout-sm="column" flex="100">	
			<div class="column-left" flex="40" hide-sm>
				<div class="flex-container full-height">
					<?php 
						$logo = array('header/ninia.png' ,'header/ninio-preescolar.png');
						$child = $this->cookie("child");
						$child = $child===false?rand(0,1):($child==0?1:0);
						$this->print_img_tag($logo[$child],false,'img','kid-image item-align-bottom');
					?>		
				</div>				
			</div>
			<div class="column-right" flex="80" flex-sm="100">
				<div class='titles'>
					<h1 class="title-donation">
						<strong>¡Gracias por tu donativo!</strong> 
					</h1>
				</div>

			</div>
			<div class="clear"></div>
		</div>
	</div>
</div>
