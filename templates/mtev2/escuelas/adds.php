<?php
/*
$show_sismo = isset($this->escuela->programas['sismo_seguro']);
$not_safe = !$show_sismo && in_array($this->escuela->entidad->id, array(7, 9,12,13,15,16,17,20,21,29));
<div class="donation-form general paypal un safe <?=$not_safe?"":"hidden"?> ">
    <a href="/programas/index/51" class="donation" layout="column" layout-align="space-between center" layout-wrap>
	<div class="crop" flex ></div>
	<div flex class="text-content">
	    <p class="text">
	    <span class="red">Escuela aún NO tiene dictámen</span>
		para reanudar clases después del
		sismo.
	    <strong class="src">Fuente:</strong>
	    <br>
	    <span class="source">SEP Federal o autoridades
	    educativas locales</span>
	    </p>
	</div>
    </a>
</div>
<div class="donation-form general paypal safe <?=$show_sismo?"":"hidden"?> ">
    <a href="/programas/index/51" class="donation" layout="column" layout-align="space-between center" layout-wrap>
	<div class="crop" flex ></div>
	<div flex class="text-content">
	    <p class="text">
	    <strong>
	    Escuela CON dictámen para
	    reanudar clases después del
	    sismo.
	    </strong>
	    <br>
	    <strong class="src">Fuente:</strong>
	    <br>
	    <span class="source">SEP Federal o autoridades
	    educativas locales</span>
	    </p>
	</div>
    </a>
</div>
*/
?>
<div class="donation-form general paypal">
    <a href="/donativos" class="donation" layout="column" layout-align="space-between center" layout-wrap>
	<div class="crop" flex ></div>
	<div flex class="text-content">
	    <p class="text">¿Quieres ayudarnos a seguir 
	    <br>
	    mejorando la educación?
	    <br>
	    <span>¡Realiza un donativo!</span></p>
	</div>
    </a>
</div>



	<div class="adsbygoogle-content">
		<!-- School Profile Page Right Side 300 x 250 -->
		<ins class="adsbygoogle"
			style="display:inline-block;width:300px;height:250px"
			data-ad-client="ca-pub-5016039473129201"
			data-ad-slot="2015297378"
			<?php if ( !isset($this->config->ad_mode_test) || $this->config->ad_mode_test ) {?>
				data-ad-test="on"
			<?php } ?>
			>
		</ins>
		
		<script>
			(adsbygoogle = window.adsbygoogle || []).push({});
		</script>
	
	</div>

