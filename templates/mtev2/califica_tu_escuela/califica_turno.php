<script type="text/ng-template" id="mteCalifica.html">
	<?php $this->include_template('mteCalifica','directives'); ?>
</script>

<?php if($this->tipo_encuesta == 'bibliotecas'){ ?>
	<h1 class="green-title">Califica tu biblioteca seleccionando para cada campo una calificación del <strong>1-10</strong>.<br/>Estas calificaciones se promedian para generar la calificación general de tu biblioteca</h1>
<?php }else{ ?>
	<h1 class="green-title">Califica tu escuela seleccionando para cada campo una calificación del <strong>1-10</strong>.<br/>Estas calificaciones se promedian para generar la calificación general de tu escuela</h1>
<?php } ?>

<?php
$icons = array(
            "icon-programaapoyo-01",
            "icon-check-01",
            "icon-familia-01",
            "icon-escuela-01",
            "icon-desk-01",
            "icon-buscar-01",
        );


if($this->preguntas){?>
    <div ng-init="calificacion.total='<?=count($this->preguntas)?>'"></div>
    <?php
    foreach($this->preguntas as $i=>$pregunta){ 
        if(!($i%2))
            echo '<div class="questions-box space-between" layout="row" layout-sm="column">'
        ?>
	<div class="question" flex-sm="100" ng-init="calificacion.preguntas.push(<?=$pregunta->id?>)">
		<div class="question-content">
    		<div class="question-title q<?=intval(($i+2)/2)?>" layout="row">
    			<div class="icon-container" flex="20">
					<div  class="icon-wrapper vertical-align-center horizontal-align-center">
						<i class="<?=isset($icons[$i])?$icons[$i]:$icons[0]?>"></i>
					</div>		        				
    			</div>
    			<h3 flex="80"><?=$pregunta->titulo?></h3>
    		</div>
        	<div class="text">
				<p><?=$pregunta->pregunta?></p>
				<p>1 = "<?=$pregunta->descripcion_valor_minimo?>"</p>
				<p>10 = "<?=$pregunta->descripcion_valor_maximo?>"</p>
			</div>
			<div class="ans-row" layout="row" ng-cloak>
				<div flex 
					class="ans" 
					ng-repeat="i in range track by $index"
					ng-class="{'on': $index+1 == calificacion.calificaciones[<?=$i?>] }"
					ng-click="califica($index+1,<?=$i?>)"
					>
					{{$index+1}}
				</div>
			</div>			
		</div>
	</div>

    <?php 
        if($i%2==1)
            echo "</div>";
    }
}
?>
<div class="result" layout="row">
	<?php if($this->tipo_encuesta == 'bibliotecas'){ ?>
		<div flex="70" class="desc">En promedio, calificas a tu biblioteca con:</div>
	<?php }else{ ?>
		<div flex="70" class="desc">En promedio, calificas a tu escuela con:</div>
	<?php } ?>
	<div flex="30" class="number" ng-cloak>{{promedio}}</div>
</div>

<?php if($this->tipo_encuesta == 'bibliotecas'){ ?>
	<div mte-califica promedio="promedio" calificacion="calificacion" tipo="'biblioteca'"></div>
<?php }else{ ?>
	<div mte-califica promedio="promedio" calificacion="calificacion"></div>
<?php } ?>