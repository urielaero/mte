<div class="cont-input-text-field">
	<input type="text" 
	placeholder="Nombre de la escuela"
	onfocus="this.placeholder = ''" 
	onblur="this.placeholder = 'Nombre de la escuela'" 
	autocomplete="off"
	ng-model="text"
	typeahead="escuela.nombre for escuela in getSchool($viewValue) | filter:$viewValue"
	typeahead-template-url="typeahead-template.html"
	typeahead-on-select='toggleSchool($item)'
	/>
</div>
<script type="text/ng-template" id="typeahead-template.html">
    <a tabindex="-1">
        <i class="icon-escuela-01"></i>
        <strong><span bind-html-unsafe="match.model.nombre"></span> (<span bind-html-unsafe="match.model.nom_nivel || match.model.nivel"></span>)</strong>
        <p><span bind-html-unsafe="match.model.direccion" class="small"></span></p>
    </a>
</script>
