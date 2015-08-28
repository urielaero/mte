<label>Escuela o bibilioteca</label>
<div  class="text-field">
    <form class="contenedor-text-field" ng-submit="search()">
        <div class="cont-input-text-field">
            <input type="text" 
            flex="100" 
            placeholder="Ej. Jean Piaget" 
            autocomplete="off"
            ng-model="text"
            typeahead="escuela.nombre for escuela in getSchool($viewValue) | filter:$viewValue"
            typeahead-template-url="typeahead-template.html"
            typeahead-on-select='onSelect($item)'
            typeahead-focus-first='false'
            />
        </div>

        <div class="icono-text-field">
           <div class="cont-ico-field">
                <h5 class="ico-text-field" ng-click="search()"><i class="icon-buscar-01"></i></h5>
           </div>
        </div>
        <div class='clear'></div>
        <!--
            <input type="submit" value="" flex="20">
        -->
    </form>
</div>
<script type="text/ng-template" id="typeahead-template.html">
    <a tabindex="-1">
        <i class="icon-escuela-01"></i>
        <strong><span bind-html-unsafe="match.model.nombre"></span> (<span bind-html-unsafe="match.model.nom_nivel || match.model.nivel"></span>)</strong>
        <p><span bind-html-unsafe="match.model.direccion" class="small"></span></p>
    </a>
</script>
