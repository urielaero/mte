app.controller("conoceCTL", ['$scope','$http',function ($scope,$http) {
    $scope.entidades = entidades;
    $scope.municipios = municipios;
    $scope.localidades = localidades;
    
}]);

app.filter('municipiosFilter', function () {
  return function (municipios,entidad) {
    return municipios.filter(function (mun) {
      return !entidad.id || !mun.entidad || mun.entidad.id == entidad.id
    });
  };
});