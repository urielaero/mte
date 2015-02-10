(function () {
//Pako: falta injectar $routeprovider aqui y en app.js instalalo con bower (bower install angular-route? (bower.io/search)) 
var controller = function ($scope,$http,userInfo,templateData) {                
        //inicializa la directiva
        $scope.init = function(){
            $scope.showSearch = typeof($scope.showSearch) == 'undefined' ? true : $scope.showSearch;
            //Pako: antes de cargar los defaults deberia leer el url y setear $scope.params si es relevante
            $scope.loadDefaults();
            $scope.escuelasResponse = true;
            //console.log($scope.params);
            $scope.getEscuelas();
            //Pako: setear aqui la ruta basada en los parametros de busqueda ($scope.params)

        }
        //Funciones que usan el servicio de usuario (comparacion)
        //recibe una escuela y regresa la clase apropiada para el icono de comparar
        $scope.isChecked = function(escuela){
            return userInfo.isSelected(escuela) ? 'icon-check-01': '';
            //return ;
        }
        $scope.toggleSchool = function(escuela,$event){
            if ($event.stopPropagation) $event.stopPropagation();
            if ($event.preventDefault) $event.preventDefault();
            $event.cancelBubble = true;
            $event.returnValue = false;
            userInfo.toggleSchool(escuela);
        }
        $scope.hasSelected = function(){
            return userInfo.hasSelected();
        }
        /////////////////////////////////////////////////////////////////////////////


        // Cuando cambia un checkbox en el comparador re-cargamos las escuelas
        $scope.checkBoxChange = function(){
            $scope.getEscuelas();
        }

        // Cargar localidades desde el API cuando cambia la entidad o municipio
        $scope.getLocalidades = function(){
            $scope.localidades = [{nombre:'Todas'}];
            $scope.localidad = $scope.localidades[0];
            var params  = {
                entidad : $scope.entidad.id || null,
                municipio : $scope.municipio.id || null,
            };
            $http({method:'POST',url:'/api/localidades',data:params}).then(function(response){
                $scope.loading = false;
                $scope.localidades = $scope.localidades.concat(response.data);
                $scope.localidad = $scope.localidades[0];
            });
        }

        $scope.entidadChange = function(){
            if($scope.municipio && $scope.entidad.id != $scope.municipio.id){
                $scope.municipio = $scope.municipios[0];
            }

            $scope.pagination.current_page = 1;
            $scope.getLocalidades();
            $scope.getEscuelas();
        }
        $scope.municipioChange = function(){
            if($scope.localidad && $scope.entidad.id != $scope.localidad.id){
                $scope.localidad = $scope.localidades[0];
            }
            $scope.pagination.current_page = 1;
            $scope.getLocalidades();
            $scope.getEscuelas();
        }
        
        $scope.getEscuelas = function(){
            if($scope.showSearch) $scope.buildParams();
            //console.log($scope.params);
            $scope.loading = true;
            // Pako: aqui es un buen lugar para setear la ruta
            $http({method:'POST',url:'/api/escuelas',data:$scope.params}).then(function(response){
                //console.log(response.data);
                $scope.pagination = response.data.pagination;
                $scope.escuelas = response.data.escuelas;
                $scope.loading = false;
                if(response.data.escuelas){
                    $scope.escuelasResponse = true;
                    console.log('hay data');
                }else{
                    $scope.escuelasResponse = false;
                    console.log('no hay data');

                }
            });
        }
        $scope.numberFormat = function(number){
            if(typeof(number) == 'string'){
                number = parseInt(number);
            }
            //Todo un IF que cheque si el navegador cuenta con esta funcion o cambiar a plugin de preferencia
            if(typeof(number) == 'number')
                return new Intl.NumberFormat().format(number.toFixed(2));
            else
                return false;
        }
        $scope.processCheckBoxes = function(set){
            var items =[];
            set.forEach(function(item){
                if(item.checked) items.push(item.id);
            });
            return items;
        }
        $scope.buildParams = function(){
            $scope.params  = {
                entidad : $scope.entidad.id || null,
                municipio : $scope.municipio.id || null,
                localidad : $scope.localidad.id || null,
                p : $scope.pagination.current_page || 1,
                sort : $scope.sort,
            };
           // console.log($scope.params);
            $scope.params.niveles = $scope.processCheckBoxes($scope.niveles).join(',');
            var controles = $scope.processCheckBoxes($scope.controles);
            if(controles.length == 1) $scope.params.control = controles[0];
            var turnos = $scope.processCheckBoxes($scope.turnos);
            if(turnos.length == 1) $scope.params.turno = turnos[0];
            if(termSearch) $scope.params.term = termSearch;

        };
        var termSearch = false;
        $scope.termSearch = function(term){
            termSearch = term || false;
            $scope.getEscuelas();
        };

        $scope.loadDefaults = function(){
            // Todo cargar estos datos mediant un servicio
            if($scope.showSearch){
                entidades = [{nombre:'Todos'}].concat(entidades);
                municipios = [{nombre:'Todos'}].concat(municipios);
                localidades = [{nombre:'Todas'}].concat(localidades);
                var defaults = {
                    entidades : entidades,
                    municipios : municipios,
                    localidades : localidades,
                    entidad : entidades[0],
                    municipio : municipios[0],
                    localidad : localidades[0],
                    niveles : templateData.getVar('niveles'),
                    turnos : templateData.getVar('turnos'),
                    controles : templateData.getVar('controles'),
                };
            }else{
                var defaults = {
                    entidades : [],
                    municipios : [],
                    localidades : [],
                    localidad : [],
                    niveles : [],
                    turnos : [],
                    controles : [],
                };
            }            
            angular.extend($scope,defaults);

            $scope.tableTitle = $scope.tableTitle || 'Escuelas';
            $scope.loading = true;
            $scope.escuelasResponse = false;
            $scope.pagination = {count:0,current_page:1};
            $scope.sortOptions = ['Semáforo educativo','Nombre de la escuela'];
            $scope.sort = $scope.sortOptions[0];
            $scope.semaforos = templateData.getVar('semaforos');
            
        }

	$scope.clickSchool = function($event){
		$scope.click && $scope.click({event:$event});	
	};

        $scope.init();

    };
    //Pako: falta injectar $routeprovider aqui y en app.js instalalo con bower (bower install angular-route? (bower.io/search)) 
    controller.$inject = ['$scope','$http','userInfo','templateData'];
    var directive = function () {
        return {
            controller : controller,
            scope : {
                objects : '=?',
                showSearch : '=?',
                params : '=?',
                tableTitle : '@',
		click : '&'
            },
            templateUrl : 'mteNgSearch.html'
        };
    };
    
    app.directive('mteNgSearch', directive);
    app.filter('municipiosFilter', function () {
      return function (municipios,entidad) {
        return municipios.filter(function (mun) {
          return !entidad.id || !mun.entidad || mun.entidad.id == entidad.id
        });
      };
    });  

    
}());
