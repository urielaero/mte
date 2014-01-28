<div class="container programas">
	<div class="column left">
		<h1 class="title"><?php echo $this->programa->nombre; ?></h1>
		<div class="white-box">
			<!--<h3>Objetivo del programa</h3>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Hic consectetur quam odio. Necessitatibus, voluptatibus optio facilis ullam quas amet quidem nobis pariatur maxime sit magni reiciendis inventore nemo. Corporis, fugit.</p>
			-->
			<p><span class="blue">Tema especifico que atiende el prgrama</span> <?php echo $this->programa->nombre; ?></p>
		</div>
		<h2 class="title">Descripcion del programa</h2>
		<div class="white-box">
			<p><?php echo $this->programa->descripcion; ?></p>
		</div>
		<h2 class="title green">Clave CCT de las escuelas en las que se trabaja(2013/2014)</h2>
		<div class="white-box map">
			<table>
				<?php for($countT=0;$countT<3;$countT++): ?>
				<tr>
					<td>CCT 873420 | Colegio Alexandre</td>
					<td><a href="#" class="button-frame"><span class="button">Ver escuela</span></a></td>
					<div class="clear"></div>
				</tr>
				<?php endfor; ?>
			</table>
		</div>


		<div class="info">
			<h2 class="title">¿Que debe hacer una escuela que esta interesada en participar en el proyecto?</h2>
			<div class="white-box">
				<p><?php echo $this->programa->requisitos; ?></p>
			</div>
			<h2 class="title">Pagina web del programa</h2>
			<div class="white-box">
				<a href="http://<?=$this->programa->sitio_web;?>" ><?php echo $this->programa->sitio_web; ?></a>
			</div>
			<h2 class="title">Contácto</h2>
			<div class="white-box">
				<p>
					<?php echo $this->programa->telefono; ?>
					|<?php echo $this->programa->telefono_contacto; ?>
					|<?php echo $this->programa->mail; ?>
				</p>
			</div>
		</div>
		<script src="http://d3js.org/d3.v3.min.js"></script>
		<script src="http://d3js.org/topojson.v0.min.js"></script>
		<script>
		
		var x = d3.scale.linear()
		    .domain([0, width])
		    .range([0, width]);
		 
		var y = d3.scale.linear()
		    .domain([0, height])
		    .range([height, 0]);
		 
		var width = 680,
		    height = 500;
		 
		var projection = d3.geo.mercator()
		    .scale(1200)
		    .center([-94.34034978813841, 24.012062015793]);
		 
		var svg = d3.select(".container.programas .column.left").append("svg")
		    .attr("width", width)
		    .attr("height", height);
		 
		var g = svg.append("g");

		var path = d3.geo.path()
    		.projection(projection);
		 
		d3.json("/mx_tj.json", function(error, mx) {
		  /*svg.selectAll("path")
		    .data(topojson.object(mx, mx.objects.municipios2).geometries)
		    .enter().append("path")
		    .attr("d", d3.geo.path().projection(projection))
		    .attr("fill", "transparent")
		    .style("stroke", "#333")
		    .style("stroke-width", ".2px")
		    .attr("class", "muns");
			*/
		
		  g.selectAll("path")
		    .data(topojson.object(mx, mx.objects.estados2).geometries)
		    .enter().append("path")
		    .attr("d", d3.geo.path().projection(projection))
		    .attr("fill", "#C4EAD1")
		    .style("stroke", "#40AA6C");

		   g.selectAll("path")
		    .data(topojson.object(mx, mx.objects.estados2).properties)
		    //.enter().append("path")
		    .attr("class",function(d) { return d.name; })
		    .text(function(d) { return d.id; });



		    /*svg.selectAll(".place-label")
			    .data(topojson.object(mx, mx.objects.estados2).properties)
			  .enter().append("text")
			    .attr("class", "place-label")
			    .attr("transform", function(d) { return "translate(" + d3.geo.path().projection(projection) + ")"; })
			    .attr("dy", ".35em")
			    .text(function(d) { return d.id; });

			svg.selectAll(".place-label")
		    .attr("x", function(d) { return d.geometry.coordinates[0] > -1 ? 6 : -6; })
		    .style("text-anchor", function(d) { return d.geometries.coordinates[0] > -1 ? "start" : "end"; });*/
		    

		 
		});
		
		/*$('body').css('background-color','#fff');

		$('.container.programas svg path').each(function(){
		if($(this).hasClass('4') || $(this).hasClass('6')){
			$(this).append("<? $this->print_img_tag('COMPARADOR/pinmap.png'); ?>");
			console.log("encontro");
		}
		});*/

		</script>

		<div class="overlay-map">
			<script>
				<?php $arrayEstados = array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,31); ?>
				<?php foreach ($arr as $item) : ?>
	   				arr.push('<?php echo $item?>');
			   <?php endforeach; ?>
			</script>
		</div>

	</div>
	<div class="column right">
		<h1>Otros programas</h1>
		<div class="lista-programas">
			<h2>Programas federales</h2>
			<ul>
				<li><a href="#">Programa escuelas de calidad</a></li>
				<li><a href="#">Programa escuela segura</a></li>
				<li><a href="#">Programa escuelas tiempo completo</a></li>
			</ul>			
		</div>

		<div class="lista-programas">
			<h2>Programas OSC´s</h2>
			<ul>
				<li><a href="#">Escuela siempre Abierta</a></li>
				<li><a href="#">Programa escuela segura</a></li>
				<li><a href="#">Programa escuelas tiempo completo</a></li>
				<li><a href="#">Programa escuelas de calidad</a></li>
				<li><a href="#">Programa nacional de lectura</a></li>
				<li><a href="#">Escuela de Jornada Amplia</a></li>

			</ul>			
		</div>

		<div class="share-blue">
			<a href="javascript:window.print()" class="option print"><span class="icon"></span>Imprimir</a>
			<a href="#" class="option share"><span class="icon"></span></span>Compartir</a>	
			<?php
			//if($this->location == 'escuelas' && $this->get('action')=='index')
				$this->include_template('share_buttons_simple','global');
			?>
		</div>
	</div>
	<div class="clear"></div>
</div>