app.controller("comparaCTL", ['$scope','$http','userInfo','templateData','$mdSidenav',function ($scope,$http,userInfo,templateData,$mdSidenav){
    $scope.escuelas = [];
    $scope.semaforos = templateData.getVar('semaforos');
    $scope.years = templateData.getVar('enlaceYears');
    $scope.loading = true;
    $scope.statsYear = 2012;

    $scope.toggleComparador = function() {
        $mdSidenav('comparaSidenav').toggle();
    };
    $scope.getPCT = function(score,escuela){
        var pct = (score/escuela.stats[$scope.statsYear].alumnos) * 100;
        return pct.toFixed(1)+'%';
    }
    $scope.getEscuelas = function(){
        var ccts = userInfo.getCCTs().join(',');
        var params  = {
            ccts : ccts,
            sort : 'Promedio general',
            pagination : 1000,
            cct_count_entidad : true,
            detail : true,
        };
        $http({method:'POST',url:'/api/escuelas',data:params}).then(function(response){
            console.log(response);
            $scope.escuelas = response.data.escuelas;
            $scope.loading = false;
            $scope.loadMap(response.data.escuelas);
        });
    }
    $scope.center = {
        zoom:12
    };
    $scope.markers = {lat:0,lng:0}
    $scope.loadMap = function(data){
        console.log('load map inside');
        var markers = data.map(function(escuela){

            var marker = {
                lat: parseFloat(escuela.latitud),
                lng: parseFloat(escuela.longitud)
            };
            var icon = escuela.semaforo;
            marker.icon ={
                    iconUrl:'http://3903b795d5baf43f41af-5a4e2dc33f4d93e681c3d4c060607d64.r40.cf1.rackcdn.com/pins_'+icon+'.png',
                    iconSize:[28, 57]
            };
            marker.message = "<div class='infoBox'>"+
                            "<a class='name esc-name' href='/escuelas/index/"+escuela.cct+"' >"+
                            escuela.nombre+
                            "<span class='semafo sem"+escuela.semaforo+"'></span>"+
                            "</a>"+
                            "<div layout='row' class='rank-cont'><div class='rank' flex='20'>"+escuela.rank+"</div>"+
                            "<div class='pos' flex='80'>Posición nivel estatal</div></div>"+
                            "<div class='address-popup'><p>"+escuela.direccion+"</p></div>"+
                            ""+
                            "</div>";
            return marker;
        });
        angular.extend($scope,{
            center:{
                lat : 22.1564699, 
                lng : -100.9855409, 
                zoom: 5
            },
            defaults:{
                scrollWheelZoom: false
            },
            markers:markers.filter(function(e){
                return e;
            })
        });
    };
    $scope.getEscuelas();
}]);