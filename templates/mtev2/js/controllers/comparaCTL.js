app.controller("comparaCTL", ['$scope','$http','userInfo','templateData',function ($scope,$http,userInfo,templateData){
    $scope.escuelas = [];
    $scope.semaforos = templateData.getVar('semaforos');
    $scope.years = templateData.getVar('enlaceYears');
    $scope.loading = true;
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
            //console.log(response);
            $scope.escuelas = response.data.escuelas;
            $scope.loading = false;
        });
    }
    $scope.getEscuelas();
}]);