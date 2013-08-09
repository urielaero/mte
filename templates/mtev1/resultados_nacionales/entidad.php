<div class='container resultados-entidad'>
	<form action='' class='search-estado'>
		<select class='custom-select' name='estado' >
			<option value=''>Busca tu estado</option>
			<?php foreach($this->entidades as $entidad){ 
				echo "<option value='{$entidad->id}'>".$this->capitalize($entidad->nombre)."</option>";
			}
			?>

		</select>
	
	</form>
	<h1 class='full-blue'><?=$this->capitalize($this->entidad->nombre)?>
		<span><?=$this->entidad->id?>º de 32</span>	
	</h1>
	
	<div class='content'>
		<h2 class='promedio-gen'>
			<span class='left'>
				Promedio de <?=$this->capitalize($this->entidad->nombre)?>
				<span><?=$this->entidad->promedio_general?></span>
			</span>
			<span class='right'>
				Promedio Nacional
				<span><?=$this->entidad->promedio_nacional_general?></span>
			</span>
			<span class='decor'></span>
		</h2>
		<div class='column'>
			<p class='promedio-green'>
				Escuelas totales
				<span class='value'><?=$this->entidad->escuelas_totales?></span>
			</p>
			<p class='promedio-green'>
				Escuelas evaluadas
				<span class='value'><?=$this->entidad->escuelas_evaluadas?></span>
			</p>
			<div class='clear'></div>

			<p class='promedio-orange'>
				Número de escuelas primarias
				<span class='value'><?=$this->entidad->numero_escuelas_primaria?></span>
			</p>
			<div class='table'>
				<p>Promedio de español <span class='value'><?=$this->entidad->primaria_espaniol?></span></p>
				<p>Promedio de matemáticas <span class='value'><?=$this->entidad->primaria_matematicas?></span></p>
			</div>

			<p class='promedio-orange'>
				Número de escuelas secundarias
				<span class='value'><?=$this->entidad->numero_escuelas_secundaria?></span>
			</p>
			<div class='table'>
				<p>Promedio de español <span class='value'><?=$this->entidad->secundaria_espaniol?></span></p>
				<p>Promedio de matemáticas <span class='value'><?=$this->entidad->secundaria_espaniol?></span></p>
			</div>

			<p class='promedio-orange'>
				Número de escuelas bachillerato
				<span class='value'><?=$this->entidad->numero_escuelas_bachillerato?></span>
			</p>
			<div class='table'>
				<p>Promedio de español <span class='value'><?=$this->entidad->bachillerato_espaniol?></span></p>
				<p>Promedio de matemáticas <span class='value'><?=$this->entidad->bachillerato_matematicas?></span></p>
			</div>

		</div>
		<div class='column'>
			<p class='promedio-green blue'>
				Promedio de español
				<span class='value'><?=$this->entidad->promedio_espaniol?></span>
			</p>
			<p class='promedio-green blue'>
				Promedio de matemática
				<span class='value'><?=$this->entidad->promedio_matematicas?></span>
			</p>
			<div class='clear'></div>
			<div class='table'>
				<p>Promedio nacional de español <span class='value'><?=$this->entidad->promedio_nacional_espaniol_primaria?></span></p>
				<p>Promedio nacional de matemáticas <span class='value'><?=$this->entidad->promedio_nacional_matematicas_primaria?></span></p>
			</div>

			<div class='table'>
				<p>Promedio nacional de español <span class='value'><?=$this->entidad->promedio_nacional_espaniol_secundaria?></span></p>
				<p>Promedio nacional de matemáticas <span class='value'><?=$this->entidad->promedio_nacional_matematicas_secundaria?></span></p>
			</div>

			<div class='table'>
				<p>Promedio nacional de español <span class='value'><?=$this->entidad->promedio_nacional_espaniol_bachillerato?></span></p>
				<p>Promedio nacional de matemáticas <span class='value'><?=$this->entidad->promedio_nacional_matematicas_bachillerato?></span></p>
			</div>
		</div>
		<div class='clear'></div>
		<!--
		<div class='graphs'>
			<div class='graph-set on'>
				<a class='graph-button' href='#'>Distribución de Resultados en Primarias</a>
				<input type='hidden' id='primaria-init' name='initialized' class='initialized' value='1' />
				<input type='hidden' name='color' class='color' value='#0B9F49' />
				<div class='data' id='data-primarias'><?=$this->entidad->distribucion_primarias?></div>
				<div class='graph'id='graph-primarias'></div>
			</div>
			<div class='graph-set'>
				<a class='graph-button' href='#'>Distribución de Resultados en Secundarias</a>
				<input type='hidden' name='initialized' class='initialized' value='0' />
				<input type='hidden' name='color' class='color' value='#329DD1' />
				<div class='data' id='data-secundarias'><?=$this->entidad->distribucion_secundarias?></div>
				<div class='graph' id='graph-secundarias'></div>
			</div>
			<div class='graph-set'>
				<a class='graph-button' href='#'>Distribución de Resultados en Bachilleratos</a>
				<input type='hidden' name='initialized' class='initialized' value='0' />	
				<input type='hidden' name='color' class='color' value='#F6931B' />
				<div class='data' id='data-bachilleratos'><?=$this->entidad->distribucion_bachilleratos?></div>
				<div class='graph' id='graph-bachilleratos'></div>
			</div>
		</div>
		-->
		<?php if($this->petition_data){ 
				echo "<a href='/peticiones/'>firmar:".$this->petition_data[0]['title']."</a>";
			}
		?>
	</div>
</div>
