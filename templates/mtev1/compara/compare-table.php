<table>
	<tr>
		<th class='checkbox compara_table'></th>
		<th class='school'>Escuelas comparadas</th>
		<th>Nivel Escolar</th>
		<th class='rank'>Posición <?=$this->current_rank->name?></th>
		<th>Privada | Pública</th>
		<th class='calificacion'>Calificación enlace de español</th>
		<th class='calificacion'>Calificación enlace de matemáticas</th>			
		<th class='semaforos'>Semáforo educativo</th>
	</tr>
	<?php 
	foreach($this->escuelas as $escuela){
		$escuela->get_semaforo();
		$slug = $this->current_rank->slug;
		echo "<tr>";
		echo "<td class='checkbox compara_table'><a class='compara-escuela' href='{$escuela->cct}'></a>
			<span class='icon-popup'>Dejar de comparar</span>
		</td>";
		echo "<td class='school'><a href='/escuelas/index/$escuela->cct'>".$this->capitalize($escuela->nombre)."</td>";
		echo "<td>".$this->capitalize($escuela->nivel->nombre)."</td>";
		echo "<td class='rank'><span>".$escuela->$slug."</span></td>";
		echo "<td>".$this->capitalize($escuela->control->nombre)."</td>";
		echo "<td class='rank'><span>".round($escuela->promedio_espaniol)."</span></td>";
		echo "<td class='rank'><span>".round($escuela->promedio_matematicas)."</span></td>";
		echo "<td class='semaforo sem{$escuela->semaforo}'><span></span></td>";
		echo "</tr>";
	}
	?>
</table>
