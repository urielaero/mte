app.controller("fileController", function ($scope) {
	$scope.entidades = $archivosEntidad;
	$scope.entidades.forEach(function(entidad){
		entidad.census = 'Centros';
		entidad.format = 'win';
		entidad.service = 'r';
	});
	$scope.options = [
		'Centros',
		'Inmuebles',
		'CONAFE',
		'Supervisores'
	];
	$scope.mirrors = [
		'Rackspace',
		'Amazon'
	];

	$scope.formats = {
		'Windows': 'win',
		'UTF8': 'UTF_'
	};
	$scope.getLink = function(entidad){
		var key = getKey(entidad, entidad.format, entidad.service);
		return entidad[key];
	};

	$scope.formatDis = function(entidad, format, service) {
		var key = getKey(entidad, format, service)
		return !!entidad[key];
	};

	function getKey(entidad, format, service) {
		format = format == 'win' ? '': "UTF_";
		service = service.toUpperCase()
		var key = format+entidad.census.toUpperCase()+"_"+service;
		return key
	}
});
