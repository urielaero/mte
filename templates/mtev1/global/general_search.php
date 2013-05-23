<form action='/compara/#resultados' method='get' accept-charset='utf-8' class='general-search' id='general-search'>
	<p class='button-frame'>
		<input name='term' id='name-input' type='text' placeholder='Nombre de la Escuela' value='<?=$this->request('term');?>' />
		<input type='submit' class='integrated' value='' />
	</p>
	<fieldset class='busqueda-avanzada'>
		<p class='button-frame'>
			<select name='nivel' id='nivel-input' class='custom-select'>
				<option value=''>Nivel de Escolaridad</option>
				<?php 
				foreach($this->niveles as $nivel){
				$selected = $this->request('nivel') == $nivel->id && $this->request('nivel') != '' ? "selected='selected'" : '';
				echo "<option $selected value='{$nivel->id}'>".$this->capitalize($nivel->nombre)."</option>"; 
				}
				?>
			</select>
		</p>
		<p class='button-frame'>
			<select name='entidad' id='state-input' class='custom-select'>
				<option value=''>Estado</option>
				<?php 
				foreach($this->entidades as $entidad){
					$selected = $this->request('entidad') == $entidad->id ? "selected='selected'" : '';
					echo "<option $selected value='{$entidad->id}'>".$this->capitalize($entidad->nombre)."</option>";

				} 
				?>
			</select>
		</p>
		<p class='button-frame'>
			<select name='municipio' id='municipio-input' class='custom-select'>
				<option value=''>Municipio</option>
				<?php 
				foreach($this->municipios as $municipio){
				$selected = $this->request('municipio') == $municipio->id ? "selected='selected'" : '';
				echo "<option $selected value='{$municipio->id}'>".$this->capitalize($municipio->nombre).", ".$this->capitalize($municipio->entidad->nombre)."</option>";
				} 
				?>
			</select>
		</p>
		<p class='button-frame'>
			<?php $disabled = !$this->localidades ? "disabled='disabled'" : ''; ?>
			<select name='localidad' id='localidad-input' <?=$disabled?> class='custom-select'>
				<option value=''>Localidad</option>
				<?php
				if($this->localidades){
					foreach($this->localidades as $localidad){
						$selected = $this->request('localidad') == $localidad->id ? "selected='selected'" : '';
						echo "<option $selected value='{$localidad->id}'>".$this->capitalize($localidad->nombre)."</option>";
					} 
				}
				?>
			</select>
		</p>
		<p class='submit button-frame'>
			<input type='submit' value='Buscar' class='button'/>
			<input type='hidden' value='true' name='search' />
			<span class='before'></span>
			<span class='before after'></span>
		</p>
		<p class='adv-search mapa'><a href='/compara/' >Ver en <span>mapa</span></a></p>
	</fieldset>
 </form>