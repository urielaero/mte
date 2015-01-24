(function () {
    var controller = function ($scope,$http,userInfo,templateData) {
        $scope.entidades = [{nombre:'Todos'}].concat(entidades);
        $scope.entidad = $scope.entidades[0];
        $scope.municipios = [{nombre:'Todos'}].concat(municipios);
        $scope.municipio = $scope.municipios[0];
        $scope.localidades = [{nombre:'Todas'}].concat(localidades);
        $scope.localidad = $scope.localidades[0];
        $scope.loading = true;
        $scope.pagination = {count:0,current_page:1};
        $scope.sortOptions = ['Semáforo educativo','Nombre de la escuela'];
        $scope.sort = $scope.sortOptions[0];
        $scope.semaforos = templateData.getVar('semaforos');
        $scope.niveles = templateData.getVar('niveles');
        $scope.turnos = templateData.getVar('turnos');
        $scope.controles = templateData.getVar('controles');

        //Funciones que usan el servicio de usuario (comparacion)
        //recibe una escuela y regresa la clase apropiada para el icono de comparar
        $scope.isChecked = function(escuela){
            return userInfo.isSelected(escuela) ? 'icon-check-01': '';
            //return ;
        }
        $scope.toggleSchool = function(escuela){
            userInfo.toggleSchool(escuela);
        }
        $scope.hasSelected = function(){
            return userInfo.hasSelected();
        }

        $scope.checkBoxChange = function(){
            $scope.getEscuelas();
        }
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
            $scope.buildParams();
            $scope.loading = true;
            $http({method:'POST',url:'/api/escuelas',data:$scope.params}).then(function(response){
                //console.log(response.data);
                $scope.pagination = response.data.pagination;
                $scope.escuelas = response.data.escuelas;
                $scope.loading = false;
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
            console.log($scope.params);
            $scope.params.niveles = $scope.processCheckBoxes($scope.niveles).join(',');
            var controles = $scope.processCheckBoxes($scope.controles);
            if(controles.length == 1) $scope.params.control = controles[0];
            var turnos = $scope.processCheckBoxes($scope.turnos);
            if(turnos.length == 1) $scope.params.turno = turnos[0];

        };
        $scope.getEscuelas();
    };
    
    controller.$inject = ['$scope','$http','userInfo','templateData'];
    var directive = function () {
        return {
            controller : controller,
            scope : {
                objects : '=',
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