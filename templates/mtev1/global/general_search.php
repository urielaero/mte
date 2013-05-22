<form action='/busqueda' method='get' accept-charset='utf-8' class='general-search' id='general-search'>
	<p class='button-frame'><input name='term' id='name-input' type='text' placeholder='Nombre de la Escuela' value='<?=$this->request('term');?>' /></p>
	<p class='adv-search'><a href='/compara/' >Búsqueda Avanzada</a></p>
	<fieldset name='busqueda-avanzada'>
		<select name='nivel' id='nivel-input'>
			<option value=''>Nivel de Escolaridad</option>
			<?php 
			foreach($this->niveles as $nivel){
			$selected = $this->request('nivel') == $nivel->id && $this->request('nivel') != '' ? "selected='selected'" : '';
			echo "<option $selected value='{$nivel->id}'>".$this->capitalize($nivel->nombre)."</option>"; 
			}
			?>
		</select>
		<select name='entidad' id='state-input'>
			<option value=''>Estado</option>
			<?php 
			foreach($this->entidades as $entidad){
				$selected = $this->request('entidad') == $entidad->id ? "selected='selected'" : '';
				echo "<option $selected value='{$entidad->id}'>".$this->capitalize($entidad->nombre)."</option>";

			} 
			?>
		</select>

		<select name='municipio' id='municipio-input'>
			<option value=''>Municipio</option>
			<?php 
			foreach($this->municipios as $municipio){
			$selected = $this->request('municipio') == $municipio->id ? "selected='selected'" : '';
			echo "<option $selected value='{$municipio->id}'>".$this->capitalize($municipio->nombre).", ".$this->capitalize($municipio->entidad->nombre)."</option>";
			} 
			?>
		</select>

		<?php $disabled = !$this->localidades ? "disabled='disabled'" : ''; ?>
		<select name='localidad' id='localidad-input' <?=$disabled?>>
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
		
		<p class='submits'>
			<input type='submit' value='Buscar'/>
		</p>
	</fieldset>
 </form>