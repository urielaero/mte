<div id="sub-header">
	<div class="home container">
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
					<h1><strong>Datos Abiertos</strong></h1>
					<p>MejoraTuEscuela.org es una plataforma de participación ciudadana para transformar la educación en México</p>
				</div>
				<script type="text/ng-template" id="headerTextSearch.html">
					<?php $this->include_template('headerTextSearch','directives'); ?>
				</script>
				<div mte-text-search object='textSearch' temp="headerTextSearch" ></div>
			</div>
			<div class="clear"></div>
		</div>
	</div>
</div>
