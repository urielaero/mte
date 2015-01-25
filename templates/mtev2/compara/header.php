<div id="sub-header" class="prefect-sub-header">
	<div class="home container">
		<?php if(isset($this->principal) && $this->principal){?>
			<div class="column-right center-content">
				<div class='titles'>
					<h1><strong>Conoce tu escuela</strong></h1>
					<p>El primer paso para poder mejorar tu centro escolar es saber cómo está.</p>
					<p>Te invitamos a que conozcas y compartas esta información.</p>
				</div>
			</div>
		<?php }else{ ?>
			<div layout="row" layout-sm="column">	
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
				<div class="column-right" flex="60" flex-sm="100">
					<div class='titles'>
						<h1>
							<strong>Califica tu escuela</strong>
						</h1>
						<p>Una vez que conoces y has comparado tu escuela, te invitamos a que califiques algunos aspectos de la misma. Las calificaciones ayudan a detectar áreas de mejora y a reconocer los logros alcanzados</p>
					</div>
				</div>
				<div class="clear"></div>
			</div>
		<?php } ?>
	</div>
</div>


