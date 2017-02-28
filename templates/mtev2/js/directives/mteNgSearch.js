(function () {
//Pako: falta injectar $routeprovider aqui y en app.js instalalo con bower (bower install angular-route? (bower.io/search)) 
var controller = function ($scope,$http,userInfo,templateData,$location) {                

        var termSearch = false,
        getOneFilter = function(list,id){
            if(list && id)
                return list.filter(function(e){
                    if(e.id == id)
                        return e;
                })[0];
        },
        checkIfSelect = function(list,ids){
            if(list && ids){
                ids = ids.split(',');
                list.forEach(function(e){
                    if(ids.indexOf(e.id.toString())!=-1)
                        e.checked = true;
                });
            }
        
        };
        //inicializa la directiva
        $scope.init = function(){
            $scope.showSearch = typeof($scope.showSearch) == 'undefined' ? true : $scope.showSearch;
            //Pako: antes de cargar los defaults deberia leer el url y setear $scope.params si es relevante
            $scope.loadDefaults();
            $scope.escuelasResponse = true;
            //console.log($scope.params);
            //Pako: setear aqui la ruta basada en los parametros de busqueda ($scope.params)
            if($scope.urls){
                var search = $location.search();
		search.p = parseInt(search.p) || 1;
                termSearch = search.term;
		$scope.prueba = search.type_test || $scope.prueba;
                if(search.localidad) $scope.localidad = {id:search.localidad};
                if(search.entidad) $scope.entidad = getOneFilter(entidades,search.entidad); 
                if(search.municipio) $scope.municipio = getOneFilter(municipios,search.municipio);
                if(search.sort) $scope.sort = search.sort;
		console.log($scope.pagination, search);
                $scope.pagination.current_page = search.p; //|| 1;
                checkIfSelect($scope.niveles,search.niveles);
                checkIfSelect($scope.turnos,search.turno);
                checkIfSelect($scope.controles,search.control);
                $scope.getLocalidades(search.localidad);
                
            }
            $scope.getEscuelas();

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
            $scope.getEscuelas(true);
        }

        // Cargar localidades desde el API cuando cambia la entidad o municipio
        $scope.getLocalidades = function(select){
            $scope.localidades = [{nombre:'Todas'}];
            if(!select)
                $scope.localidad = $scope.localidades[0];
            var params  = {
                entidad : $scope.entidad.id || null,
                municipio : $scope.municipio.id || null,
            };
            $http({method:'POST',url:'/api/localidades',data:params}).then(function(response){
                $scope.loading = false;
                $scope.localidades = $scope.localidades.concat(response.data);
                if(select){
                    $scope.localidad = $scope.localidades.filter(function(e){
                        if(e.id == select)
                            return e;
                    })[0]; 
                }else{
                    $scope.localidad = $scope.localidades[0];
                }
            });
        }

        $scope.entidadChange = function(){
            if($scope.municipio && $scope.entidad.id != $scope.municipio.id){
                $scope.municipio = $scope.municipios[0];
            }

            $scope.pagination.current_page = 1;
            $scope.getLocalidades();
            $scope.getEscuelas(true);
        }
        $scope.municipioChange = function(){
            if($scope.localidad && $scope.entidad.id != $scope.localidad.id){
                $scope.localidad = $scope.localidades[0];
            }
            $scope.pagination.current_page = 1;
            $scope.getLocalidades();
            $scope.getEscuelas(true);
        }
       
        var reload = false;
        $scope.getEscuelas = function(reset){
            if(reset) $scope.pagination.current_page = 1;
            if($scope.showSearch && !($scope.params && $scope.params.search)) $scope.buildParams();
            //console.log($scope.params);
            $scope.loading = true;
            // Pako: aqui es un buen lugar para setear la ruta
            if(!$scope.params){
                $scope.escuelasResponse = false;
                return;
            }

            if($scope.urls)
                $location.search($scope.params);

            if($scope.params && $scope.params.search){
                if(reload){
                    var params = {};
                    angular.extend(params,$scope.params);
                    $scope.buildParams();
                    var url = '#?';
                    for(var k in $scope.params){
                        if(params[k])
                            $scope.params[k] = params[k];

                        if($scope.params[k])
                            url += k+'='+$scope.params[k] + '&';
                    }
                    location.href = '/compara/'+url;
                    return;
                }
                reload = true;
            }

                
            $http({method:'POST',url:'/api/escuelas',data:$scope.params}).then(function(response){
                $scope.pagination = response.data.pagination;
                if ($scope.params && $scope.params.type_test == 'enlace') {
                    $scope.semaforos = $scope.semaforos_enlace;
                } else {
                    $scope.semaforos = $scope.semaforos_planea;
                }
                $scope.escuelas = response.data.escuelas.map(function(sch){
                    if (sch && sch.nombre) {
                        sch.nombre = sch.nombre.replace(/[^\w!.&\-,ñ]+/g, ' '); 
                    }
                    return sch;
                });
                $scope.loading = false;
                if(response.data.escuelas && response.data.escuelas.length){
                    $scope.escuelasResponse = true;
                }else{
                    $scope.escuelasResponse = false;

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
                type_test: $scope.prueba == 'enlace'? 'enlace': 'planea'
            };
            $scope.params.niveles = $scope.processCheckBoxes($scope.niveles).join(',');
            var controles = $scope.processCheckBoxes($scope.controles);
            if(controles.length == 1) $scope.params.control = controles[0];
            var turnos = $scope.processCheckBoxes($scope.turnos);
            if(turnos.length == 1) $scope.params.turno = turnos[0];
            if(termSearch) $scope.params.term = termSearch;

        };
        $scope.termSearch = function(term){
            termSearch = term || false;
            $scope.getEscuelas(true);
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
		    pruebas: templateData.getVar('pruebas'),
		    prueba: 'planea'
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
		    prueba: 'planea'
                };
            }            
            angular.extend($scope,defaults);

            $scope.tableTitle = $scope.tableTitle || 'Escuelas';
            $scope.loading = true;
            $scope.escuelasResponse = false;
            $scope.pagination = {count:0,current_page:1};
            $scope.sortOptions = ['Semáforo de Resultados Educativos','Nombre de la escuela'];
            $scope.sort = $scope.sortOptions[0];
            $scope.semaforos_enlace = templateData.getVar('semaforos');
	    $scope.semaforos_planea = templateData.getVar('semaforos_planea');
            
        }

	$scope.clickSchool = function($event,escuela){
		$scope.click && $scope.click({event:{e:$event,escuela:escuela}});	
	};

        $scope.init();

    };
    //Pako: falta injectar $routeprovider aqui y en app.js instalalo con bower (bower install angular-route? (bower.io/search)) 
    controller.$inject = ['$scope','$http','userInfo','templateData','$location'];
    var directive = function () {
        return {
            controller : controller,
            scope : {
                objects : '=?',
                showSearch : '=?',
                params : '=?',
                tableTitle : '@',
                click : '&',
                urls : '=?',
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
