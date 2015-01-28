(function () {
    var controller = function($scope,$http){ 
        $scope.status = "Mantente informado";
        $scope.show = true;
        $scope.check = true;
        var onlyOne = false;
        $scope.submit = function(){
            if($scope.check && !onlyOne){
                onlyOne = true;
                $http({
                    method:'POST',
                    url:'/api/subscribe',
                    data:{
                        correo:$scope.subscriber,
                        aviso:$scope.check
                    }
                 })
                 .then(function(res){
                        if(res.data.status){
                            $scope.status = "Registrado correctamente";
                            $scope.show = false;
                        }else{
                            $scope.status = "Ocurrio un error, intentalo de nuevo.";
                            onlyOne = false;
                        }
                 });
            }else{
                $scope.status = "Debes de aceptar el aviso de privacidad.";
            }
             
        };

    };
    controller.$inject = ['$scope','$http'];
    var directive = function () {
        return {
            controller : controller,
            scope : {
                model : '=',
            },
            templateUrl : 'mteSuscribe.html'
        };
    };
    app.directive('mteSuscribe', directive);
}());
