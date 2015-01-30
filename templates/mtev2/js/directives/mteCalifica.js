(function () {
    var controller = function($scope,$http){ 
        $scope.input = {
            json:true
        };
        var onlyOne = false;
        $scope.califica = function(){
            if(onlyOne) return;
            onlyOne = true;
            if($scope.calificacion){
                $scope.input.calificaciones = $scope.calificacion.calificaciones;
                $scope.input.preguntas = $scope.calificacion.preguntas;
                $scope.input.calificacion = $scope.promedio;
            }

            $http({
                method:'POST',
                data:$scope.input,
                url:'/escuelas/calificar'
            }).then(function(res){
                $scope.success = res.data.success;
                $scope.error = $scope.success?false:true;
                if($scope.error){
                    onlyOne = false;
                    $scope.toggleForm = true;
                }
            });
        };

        $scope.$on('califica::promedio',function(e,data){
            console.log(e,data);
        });
    };
    controller.$inject = ['$scope','$http'];
    var directive = function () {
        return {
            controller : controller,
            scope : {
                promedio: '=?',
                calificacion: '=?'
            },
            templateUrl: 'mteCalifica.html'
        };
    };
    app.directive('mteCalifica', directive);

}());
