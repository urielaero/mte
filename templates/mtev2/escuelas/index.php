<script type='text/javascript'>
    window.escuela = <?= json_encode($this->escuelaSummary) ?>;
</script>

<script type="text/ng-template" id="mteCalifica.html">
	<?php $this->include_template('mteCalificaPerfil','directives'); ?>
</script>

<?php
$escuela_per_turnos = array();
$turnos = array();
if(isset($this->escuela->censo) && isset($this->escuela->censo["turnos"])){
	foreach($this->escuela->censo["turnos"] as $t){
		$turnos[$t->nombre] = $t;
	}
}
if(!empty($this->escuela->rank)){
	foreach($this->escuela->rank as $rank){
		$tmp = new stdClass();
		$tmp->nombre_icon = $rank->turno[0]->nombre=='VESPERTINO'?'vespertino-01':strtolower($rank->turno[0]->nombre);
		$tmp->nombre = $this->capitalize($rank->turno[0]->nombre);
		$tmp->turnos_eval = $rank->turnos_eval;
		$tmp->rank = isset($rank->rank_entidad) ? number_format($rank->rank_entidad ,0): '--';
		$tmp->rank_total = number_format($this->entidad_cct_count,0);
		$tmp->total_evaluados = $rank->total_evaluados?$rank->total_evaluados:'N/D';
		$tmp->pct_reprobados = $rank->pct_reprobados?$rank->pct_reprobados:'N/D';
		$tmp->semaforo =  $this->config->semaforos[$rank->semaforo];
		$tmp->chart_ma = $this->escuela->matematicas_charts && isset($this->escuela->matematicas_charts[$rank->turnos_eval])?$this->escuela->matematicas_charts[$rank->turnos_eval]:'';
		$tmp->chart_es = $this->escuela->espaniol_charts && isset($this->escuela->espaniol_charts[$rank->turnos_eval])?$this->escuela->espaniol_charts[$rank->turnos_eval]:'';
		if(count($turnos) && isset($turnos[$rank->turno[0]->nombre]))
			$tmp->censo = $turnos[$rank->turno[0]->nombre];
		else
			$tmp->censo = false;
		$escuela_per_turnos[] = $tmp;
	}
}else{	
	$tmp = new stdClass();
	$tmp->nombre_icon = 'matutino';
	$tmp->nombre = $this->capitalize('matutino');
        $tmp->rank = isset($this->escuela->rank_entidad) ? number_format($this->escuela->rank_entidad ,0): '--';
	$tmp->rank_total = number_format($this->entidad_cct_count,0);
	$tmp->total_evaluados = isset($this->escuela->total_evaluados)?$this->escuela->total_evaluados:'N/D';
	$tmp->pct_reprobados = isset($this->escuela->pct_reprobados)?$this->escuela->pct_reprobados:'N/D';
	$tmp->chart_ma = $this->escuela->line_chart_matematicas;
	$tmp->chart_es = $this->escuela->line_chart_espaniol;
	$tmp->semaforo = false;
	$tmp->censo = false;
	$escuela_per_turnos[] = $tmp;
}
?>


<div class="container profile profile-escuela" ng-controller="escuelaCTL">
	<div class="breadcrumb perfect-breadcrumb">
		<a href="/" class="start"><i class="icon-mejora"></i></a>
		<?php foreach($this->breadcrumb as $url => $breadcrumb){ ?>
			<a href="<?=$url ?>"><?=$breadcrumb ?></a>
		<?php } ?>
	</div>
	<div class="menu-top">
		<div layout="row" layout-sm="column" class="menu-row perfect-menu-row">
			<div class="profile-title" flex="55" flex-sm="100">
				<div class="title-container" layout="row">
					<div flex="25" class="icon-container" hide-sm>
						<div class="icon-wrapper vertical-align-center horizontal-align-center">
							<i class="icon-escuela-01"></i>
						</div>
					</div>
					<?php 
					?>

					<div flex="75" flex-sm="100">
						<h1><?=$this->capitalize($this->escuela->nombre)?></h1>
				    	<?php foreach($escuela_per_turnos as $i=>$escuela){?>
							<p ng-if="selectedIndex==<?=$i?>">Posición estatal <?=$escuela->rank?> <span>de</span> <?=number_format($this->entidad_cct_count,0)?></p>
					<?php } ?>
					</div>
				</div>			
			</div>
			<div class="tabs" flex="30" flex-sm="100">
			    <md-tabs md-selected="selectedIndex" ng-click="loadCharts()">
			    	<?php foreach($escuela_per_turnos as $i=>$escuela){?>
				    	<md-tab id="<?=$escuela->nombre_icon?>-tab" aria-controls="tab<?=$i?>-content">
				    		<i class="icon-<?=$escuela->nombre_icon?>"></i>
				        	<?=$escuela->nombre?>
				      	</md-tab>
				<?php } ?>
			    </md-tabs>				
			</div>
			<div flex="15" flex-sm="100" class="compare-link">
				<a href="" class="full-size-link"></a>
				<div class="icon-wrapper vertical-align-center horizontal-align-center">
					<div flex="column">
						<div><i class="icon-compara-01"></i></div>
						<div><a href="">Comparar</a></div>
					</div>
				</div>

			</div>
		</div>
	</div>
    <ng-switch on="selectedIndex" class="tabpanel-container">
    	<?php foreach($escuela_per_turnos as $i=>$escuela){
		$this->escuela_per_turno = $escuela;
        $this->escuela_per_turno_index = $i;
	?>
	        <div role="tabpanel" id="profile-content" aria-labelledby="tab<?=$i?>" ng-switch-when="<?=$i?>" md-swipe-left="next()" md-swipe-right="previous()" >
				<?php $this->include_template('turno','escuelas'); ?>
	        </div>
	<?php } ?>
    </ng-switch>

    <script type="text/ng-template" id="mteNgSearch.html">
		<?php $this->include_template('mteNgSearch','directives'); ?>
	</script>
	<script type="text/ng-template" id="mteTextSearch.html">
		<?php $this->include_template('mteTextSearch','directives'); ?>
	</script>
	
	

</div>
