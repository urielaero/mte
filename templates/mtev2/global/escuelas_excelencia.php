<?php  if( $this->escuela->programas){ ?>
<div id="escuelas-excelencia" ng-show="excelencia" ng-init="excelencia=true">
	<div ng-click="excelencia=false" class="cerrar-excelencia">
		<img class="cerrar-ex" src="/templates/mtev2/img/cerrar.png">
	</div>
	<h6 class="text-excelencia">esta escuela fue <br/> seleccionada para el programa:</h6>
	<div id="biblioteca-excelencia">
		<div class="biblioteca-excelencia">
			<i id="excelencia-icono" class="icon-biblioteca"></i>
		</div>
	</div>
	<h3 class="text-excelencia2">"Escuela de Excelencia para</h3>
	<h3 class="text-excelencia4">Abatir el Rezago Educativo"</h3>
	<h6 class="text-excelencia3"><a href="/programas/index/26">Haz click para conocer más</a></h6>
</div>
<?php } ?>
