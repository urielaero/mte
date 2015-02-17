<div ng-show="show" class="email-box">
	<h4><strong ng-cloak><i class="icon-mail-01"></i>{{status}} </strong></h4>
	<form ng-submit="submit()" >
		<input type="text" ng-model="subscriber" placeholder="Tu correo">
		<input type="submit" value="Suscríbete"  class="button-bordered">
		<md-checkbox ng-model="check" aria-label="Checkbox 1"></md-checkbox><a href="#">Aviso de privacidad</a>
	</form>
</div>
<div class="box box-pink" ng-show="!show">
	<div layout="row">
		<div flex="25" class="icon-container">
			<div class="icon-wrapper vertical-align-center horizontal-align-center">
				<i class="icon-mejora"></i>
			</div>
		</div>	
		<div flex="75" class="text-container"><p>{{status}}</p></div>
	</div>
</div>