app.controller("comparaCTL", ['$scope','$http','userInfo','templateData',function ($scope,$http,userInfo,templateData){
    $scope.escuelas = [];
    $scope.semaforos = templateData.getVar('semaforos');
    $scope.getEscuelas = function(){
        var params  = {
            ccts : userInfo.getCCTs().join(','),
            sort : 'Promedio general',
            pagination : 1000,
            cct_count_entidad : true,
        };
        $http({method:'POST',url:'/api/escuelas',data:params}).then(function(response){
            console.log(response);
            $scope.escuelas = response.data.escuelas;
        });
    }
    $scope.getEscuelas();
}]);