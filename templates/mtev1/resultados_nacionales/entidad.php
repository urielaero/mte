<div class='container resultados-entidad'>
	<h1 class='full-blue'><?=$this->capitalize($this->entidad->nombre)?><a href='/resultados-nacionales'>Ver todos los estados</a></h1>
	
	<div class='content'>
		<h2 class='promedio-gen'>Promedio General <span>87.8</span></h2>
		<div class='column'>
			<p class='promedio-green'>
				Escuelas totales
				<span class='value'>6790</span>
			</p>
			<p class='promedio-green'>
				Escuelas evaluadas
				<span class='value'>6790</span>
			</p>
			<div class='clear'></div>
			<p class='promedio-orange'>
				Numero Escuelas Publicas
				<span class='value'>790</span>
			</p>
			<div class='table'>
				<p>Promedio Español <span class='value'>87.6</span></p>
				<p>Promedio Matemáticas <span class='value'>87.6</span></p>
			</div>
		</div>
		<div class='column'>
			<p class='promedio-green blue'>
				Escuelas totales
				<span class='value'>6790</span>
			</p>
			<p class='promedio-green blue'>
				Escuelas evaluadas
				<span class='value'>6790</span>
			</p>
			<div class='clear'></div>
			<p class='promedio-orange'>
				Numero Escuelas Privadas
				<span class='value'>790</span>
			</p>
			<div class='table'>
				<p>Promedio Español <span class='value'>87.6</span></p>
				<p>Promedio Matemáticas <span class='value'>87.6</span></p>
			</div>
		</div>
		<div class='clear'></div>
		<di class='graphs'>
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
	</div>
</div>