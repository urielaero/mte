<div id="sub-header">
	<div class="home container">
		<div layout="row">	
			<div class="column-left" flex="40">
				<?php 
					$logo = array('header/ninia.png' ,'header/ninio-preescolar.png');
					$child = $this->cookie("child");
					$child = $child===false?rand(0,1):($child==0?1:0);
					$this->print_img_tag($logo[$child],false,'img','kid-image');
				?>						
			</div>
			<div class="column-right" flex="60">
				<div class='titles'>
					<h1>
						<strong>MejoraTuEscuela.org</strong> es una plataforma de participación ciudadana
						para transformar la educación en México
					</h1>
				</div>
				<?php $this->include_template('simple_search','global'); ?>
			</div>
			<div class="clear"></div>
		</div>
	</div>
</div>


