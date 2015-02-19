<div ng-cloak>

	<h1 class="green-title">Califica tu {{tipo}} seleccionando para cada campo una calificación del <strong>1-10</strong>.<br/>Estas calificaciones se promedian para generar la calificación de la {{tipo}} según usuarios.</h1>

        <!--if(!($i%2))-->
         <div ng-repeat="pregunta in preguntas" class="questions-box space-between" layout="row" layout-sm="column">
		<div class="question" flex-sm="100" ng-repeat="single in pregunta" >
			<div class="question-content">
				<div class="question-title q{{$parent.$index+1}}" layout="row">
					<div class="icon-container" flex="20">
						<div  class="icon-wrapper vertical-align-center horizontal-align-center">
							<i class="{{icons[_map[$parent.$index][$index]]}}"></i>
						</div>
					</div>
					<h3 flex="80">{{single.titulo}}</h3>



				</div>

				<div class="text">
					<p>{{single.pregunta}}</p>
					<p>1 = "{{single.descripcion_valor_minimo}}"</p>
					<p>10 = "{{single.descripcion_valor_maximo}}"</p>
				</div>
				<div class="ans-row" layout="row" ng-cloak>
					<div flex 
						class="ans" 
						ng-repeat="i in range track by $index"
						ng-class="{'on': $index+1 == calificaciones[_map[$parent.$parent.$index][$parent.$index]] }"
						ng-click="califica($index+1,_map[$parent.$parent.$index][$parent.$index])"
					>
					{{$index+1}}
					</div>
				</div>
			</div>
		</div>
         </div>
	<div class="result" layout="row">
		<div flex="70" class="desc">En promedio, calificas a tu biblioteca con:</div>
		<div flex="30" class="number" ng-cloak>{{promedio}}</div>
	</div>
	<div mte-califica promedio="promedio" calificacion="info_calificacion" tipo="tipo" cct="cct"></div>
</div>
