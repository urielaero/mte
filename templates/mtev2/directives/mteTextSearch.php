<label>Escuela o bibilioteca</label>
<div layout="column" class="text-field">
    <div class="contenedor-text-field">
        <div class="cont-input-text-field">
            <input type="text" 
            flex="100" 
            placeholder="Ej. Jean Piaget" 
            autocomplete="off"
            ng-model="text"
            typeahead="escuela.nombre for escuela in getSchool($viewValue) | filter:$viewValue"
            typeahead-on-select='onSelect($item)'
            />
        </div>

        <div class="icono-text-field">
           <div class="cont-ico-field">
                <h5 class="ico-text-field"><i class="icon-buscar-01"></i></h5>
            </div>
        </div>
        <div class='clear'></div>
        <!--
            <input type="submit" value="" flex="20">
        -->
    </div>

</div>
