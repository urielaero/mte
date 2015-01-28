<div class="email-box">
	<h4><strong ng-cloak><i class="icon-mail-01"></i>{{status}} </strong></h4>
	<form ng-submit="submit()" ng-show="show">
		<input type="text" ng-model="subscriber">
		<input type="submit" value="Suscríbete" class="button-bordered">
		<md-checkbox ng-model="check" aria-label="Checkbox 1"></md-checkbox><a href="#">Aviso de privacidad</a>
	</form>
</div>
