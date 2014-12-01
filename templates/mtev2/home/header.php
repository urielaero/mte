<div id="sub-header">
	<div class='home container'>	
		<div class="column-left">
			<?php 
				$logo = array('header/ninia.png' ,'header/ninio-preescolar.png');
				$child = $this->cookie("child");
				$child = $child===false?rand(0,1):($child==0?1:0);
				$this->print_img_tag($logo[$child],false,'img','kid-image');
			?>						
		</div>
		<div class="column-right">
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


