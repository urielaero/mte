<label>Escuela o bibilioteca</label>
<div layout="column" class="text-field">
    <input type="text" 
        flex="100" 
        placeholder="Ej. Jean Piaget" 
        autocomplete="off"
        ng-model="text"
        typeahead="escuela.nombre for escuela in getSchool($viewValue) | filter:$viewValue"
        typeahead-on-select='onSelect($item)'
    />
    <!--
        <input type="submit" value="" flex="20">
    -->


</div>
