app.controller("programasCTL", ['$scope', '$location',function ($scope, $location) {

	$scope.init = function(params){
		params = params || {};
		params.temaIndex = 0;
		$scope.programas = (programas || []).map(function(pr) {
                pr.zonas = (pr.zonas || '').replace(/\\r\\n/g, ', ');
                return pr;
		});
		$scope.zonas = [{nombre:'Nacional'}].concat(entidades);
		$scope.temas = ['Todos'];
		$scope.programas.forEach(function(programa){
			var ind = $scope.temas.indexOf(programa.tema_especifico) == -1;
			if(programa.tema_especifico != '' && ind){
				$scope.temas.push(programa.tema_especifico);
				if(params.tema && params.tema == programa.tema_especifico)
					params.temaIndex = $scope.temas.length - 1;
			}
		});
		$scope.controles = {
			'0' : {
				label : 'Organización de la sociedad civil',
				id : 0,
			},
			'1' : {
				label : 'Gobierno federal',
				id : 1,
			}
		};

		$scope.niveles = {
			'11' : {
				label : 'Prescolar',
				id : 11,
			},
			'12' : {
				label : 'Primaria',
				id : 12,
			},
			'13' : {
				label : 'Secundaria',
				id : 13,
			},
			'21' : {
				label : 'Bachillerato',
				id : 21,
			},
		}
		$scope.params = {
			tema : $scope.temas[params.temaIndex],
			zona : $scope.zonas[0],
			niveles : [],
			controles : [],
			text : '',
		};
	}
	var search = $location.search();
	$scope.init(search);
}]);
app.filter('programasFilter', function () {
  return function (programas,params) {
    return programas.filter(function (prog) {
    	var evaluate = true;
    	if(params.tema != 'Todos'){
    		if(params.tema != prog.tema_especifico) evaluate = false;
    	}
    	if(params.zona.nombre != 'Nacional'){
		var entidades = prog.lista_entidades || '';
    		entidades = entidades.split(',');
    		var found = false;
    		entidades.forEach(function(entidad){
    			if(entidad == params.zona.id) found = true;
    		})
    		if(!found) evaluate = false;
    	}
    	if(params.niveles.length > 0){
    		var niveles = prog.lista_niveles || ''
		niveles = niveles.split(',');
    		params.niveles.forEach(function(val,n){
    			if(val && ! niveles.indexOf(n.toString())) evaluate = false;
    		});
    	}
    	if(params.controles.length > 0){
    		selected = 
    			!(params.controles[0] && params.controles[1]) ?
    				params.controles[0] || params.controles[1] ? 
    					params.controles[0] ? 0 : 1
    				: false
    			: false;

    		if(selected !== false && prog.federal != selected) evaluate = false;
    	}
    	if(params.text.length > 0){
    		var exp = new RegExp(params.text,'i');
    		if(prog.nombre.search(exp) == -1) evaluate = false;
    	}
      	return evaluate;
    });
  };
});  
