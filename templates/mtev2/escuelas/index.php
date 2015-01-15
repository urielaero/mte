<?php
$escuela_per_turnos = array();
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
		$escuela_per_turnos[] = $tmp;
	}
}else{	
	$tmp = new stdClass();
	$tmp->nombre_icon = 'matutino';
	$tmp->nombre = $this->capitalize('matutino');
        $tmp->rank = isset($this->escuela->rank_entidad) ? number_format($this->escuela->rank_entidad ,0): '--';
	$tmp->rank_total = number_format($this->entidad_cct_count,0);
	$tmp->total_evaluados = $this->escuela->total_evaluados?$this->escuela->total_evaluados:'N/D';
	$tmp->pct_reprobados = $this->escuela->pct_reprobados?$this->escuela->pct_reprobados:'N/D';
	$tmp->chart_ma = $this->escuela->line_chart_matematicas;
	$tmp->chart_es = $this->escuela->line_chart_espaniol;
	$escuela_per_turnos[] = $tmp;
}
?>

<div class="container profile profile-escuela" ng-controller="escuelaCTL">
	<div class="breadcrumb">
		<a href="/" class="start"><i class="icon-mejora"></i></a>
		<?php foreach($this->breadcrumb as $url => $breadcrumb){ ?>
			<a href="<?=$url ?>"><?=$breadcrumb ?></a>
		<?php } ?>
	</div>
	<div class="menu-top">
		<div layout="row" layout-sm="column" class="menu-row">
			<div class="profile-title" flex="55" flex-sm="100">
				<div class="title-container" layout="row">
					<div flex="25" class="icon-container" hide-sm>
						<div class="icon-wrapper vertical-align-center horizontal-align-center">
							<i class="icon-escuela-01"></i>
						</div>
					</div>
					<div flex="75" flex-sm="100">
						<h1><?=$this->capitalize($this->escuela->nombre)?></h1>
						<p>Posición estatal <?=isset($rank->rank_entidad) ? number_format($rank->rank_entidad ,0): '--' ?> <span>de</span> <?=number_format($this->entidad_cct_count,0)?></p>
					</div>
				</div>			
			</div>
			<div class="tabs" flex="30" flex-sm="100">
			    <md-tabs md-selected="selectedIndex">
			    	<?php foreach($escuela_per_turnos as $i=>$escuela){?>
				    	<md-tab id="<?=$escuela->nombre_icon?>-tab" aria-controls="tab<?=$i?>-content">
				    		<i class="icon-<?=$escuela->nombre_icon?>"></i>
				        	<?=$escuela->nombre?>
				      	</md-tab>
				<?php } ?>
			    </md-tabs>				
			</div>
			<div flex="15" flex-sm="100" class="compare-link">
				<a href="#" class="full-size-link"></a>
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
	?>
	        <div role="tabpanel" id="profile-content" aria-labelledby="tab<?=$i?>" ng-switch-when="<?=$i?>" md-swipe-left="next()" md-swipe-right="previous()" >
			<?php 
				$this->include_template('turno','escuelas');
			?>
	        </div>
	<?php } ?>
	<!--
        <div role="tabpanel" id="profile-content" aria-labelledby="tab1" ng-switch-when="0" md-swipe-left="next()" md-swipe-right="previous()" >
		<?php 
			$this->include_template('turno','escuelas');
		?>
        </div>
        <div role="tabpanel" id="tab3-content" aria-labelledby="tab2" ng-switch-when="1" md-swipe-left="next()" md-swipe-right="previous()">
            View for Item #3<br/>
            data.selectedIndex = 2
        </div>
	-->
    </ng-switch>
</div>
