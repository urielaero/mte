app.controller("programaCTL", ['$scope', '$http', '$compile',function ($scope, $http, $compile) {
    $scope.states = window.entidadesParticipantes;
    $scope.programaId = window.programaId;
    $scope.loading = false;
    $scope.currentState = {};
    $scope.currentState.id = '';
    $scope.currentState.name = '';
    $scope.escuelas = [];
    //Offset que se utilizara para hacer un request de escuelas
    $scope.skip = 0;
    $scope.center = {
        zoom:12
    };
    $scope.markers = {lat:0,lng:0};
    $scope.layers = {
        baselayers: {
            googleRoadmap: {
                name: 'Google Streets',
                layerType: 'ROADMAP',
                type: 'google'
            }
        }
    };     
    $scope.loadMap = function(states){
        var static_coords = [
            {"lat" : 0, "lng" : 0},
            {"lat" : 21.8852562, "lng" : -102.2915677}, //Aguascalientes
            {"lat" : 30.8406338, "lng" : -115.2837585} , //Baja California
            {"lat" : 26.0444446, "lng" : -111.6660725 }, //Baja California Sur
            {"lat" : 19.8301251, "lng" : -90.5349087 } , //Campeche
            {"lat" : 27.058676, "lng" : -101.7068294 }, //Coahuila
            {"lat" : 19.2452342, "lng" : -103.7240868 }, //Colima
            {"lat" : 16.7569318, "lng" : -93.12923529999999}, //Chiapas
            {"lat" : 28.6329957,"lng" : -106.0691004}, //Chihuahua
            {"lat" : 19.2464696, "lng" : -99.10134979999999}, //Df
            {"lat" : 24.0277202, "lng" : -104.6531759 }, //Durango
            {"lat" : 21.0190145, "lng" : -101.2573586 }, //Guanajuato
            {"lat" : 17.4391926, "lng" : -99.54509739999999 }, //Guerrero
            {"lat" : 20.0910963, "lng" : -98.76238739999999 }, //Hidalgo
            {"lat" : 20.6595382, "lng" : -103.3494376 }, //Jalisco
            {"lat" : 19.4968732, "lng" : -99.72326729999999 }, //Estado de México
            {"lat" : 19.5665192, "lng" : -101.7068294 }, //Michoacán
            {"lat" : 18.6813049, "lng" : -99.10134979999999 }, //Morelos
            {"lat" : 21.7513844, "lng" : -104.8454619 }, //Nayarit
            {"lat" : 25.592172, "lng" : -99.99619469999999 }, //Nuevo León
            {"lat" : 17.0594169, "lng" : -96.7216219 }, //Oaxaca
            {"lat" : 19.0412893, "lng" : -98.192966}, //Puebla
            {"lat" : 20.5887932, "lng" : -100.3898881 }, //Querétaro
            {"lat" : 19.1817393, "lng" : -88.4791376 },//Quintana Roo
            {"lat" : 22.1564699, "lng" : -100.9855409 },//San Luis Potosí
            {"lat" : 25.1721091, "lng" : -107.4795173 },//Sinaloa
            {"lat" : 29.2972247, "lng" : -110.3308814 },//Sonora
            {"lat" : 17.8409173, "lng" : -92.6189273 },//Tabasco
            {"lat" : 24.26694, "lng" : -98.8362755 },//Tamaulipas
            {"lat" : 19.3181521, "lng" : -98.2375146 },//Tlaxcala
            {"lat" : 19.173773, "lng" : -96.1342241 },//Veracruz
            {"lat" : 20.7098786, "lng" : -89.0943377 },//Yucatán
            {"lat" : 22.7708555, "lng" : -102.5832426 }// Zacatecas  
        ];
        var markers = states.map(function(state){
            var mark = static_coords[state.id];
            mark.icon ={
                    iconUrl:'http://3903b795d5baf43f41af-5a4e2dc33f4d93e681c3d4c060607d64.r40.cf1.rackcdn.com/pins_3.png',
                    iconSize:[28, 57],
            };
            mark.message = "<div class='infoBox'>"+
                            "<a class='name' href='#' >"+
                            state.nombre+
                            "</a>"+
                            "<div class='address-popup'><p >Participa en "+state.count_participa+" escuelas</p><a href='' ng-click='loadEscuelasPorEntidad("+state.id+", \""+ state.nombre +"\")'>Ver lista de escuelas</a></div>"+
                            ""+
                            "</div>";
            return mark;
        });
        angular.extend($scope,{
            center:{
                lat : 22.1564699, 
                lng : -100.9855409, 
                zoom: 5
            },
            dafaults:{
                scrollWheelZoom: false
            },
            markers:markers.filter(function(e){
                return e;
            })
        });
    };

    $scope.loadEscuelasPorEntidad = function(stateId,stateName){
        $scope.loading = true;
        if($scope.currentState.id == ''){
            $scope.currentState.id = stateId;
            $scope.skip = 0;
        }
        else if($scope.currentState.id != stateId){
            //Cuando se cambia de entidad, el arreglo de escuelas se vacia y el
            //offset se reinicia
            $scope.escuelas = [];
            $scope.skip = 0;    
        }

        $scope.currentState.id = stateId;
        $scope.currentState.name = stateName;

        //Se hace una peticion ajax usando los parametros en la variable params
        var params = {id:$scope.programaId, es: stateId, skip: $scope.skip};
        $http({method:'POST',url:'/programas/estado-escuelas',data:params}).then(function(response){
            $scope.escuelas = $scope.escuelas.concat(response.data);
            $scope.skip+=20;
            $scope.loading = false;
        });
    }
    $scope.$on('leafletDirectiveMarker.click', function(e, args) {
        // Args will contain the marker name and other relevant information
        var markerName = args.leafletEvent.target.options.name; //has to be set above
        var $container = $(args.leafletEvent.target._popup._container).find('.leaflet-popup-content'); 
        $container.empty();
        var html = args.leafletEvent.target._popup._content;
        var linkFunction = $compile(angular.element(html));             
        var linkedDOM = linkFunction($scope); 
        $container.append(linkedDOM);
    });     

}]);