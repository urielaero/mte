(function () {
    var controller = function($scope,$http){
        $scope._map = [[0,1],[2,3],[4,5]]
        $scope.icons =["icon-programaapoyo-01","icon-check-01","icon-familia-01","icon-escuela-01","icon-desk-01","icon-buscar-01"];
        $scope.preguntas = [];
        var preguntas;
        $scope.$watch('tipo',function(newV,oldV){
            if(!$scope.preloadpreguntas)
                return;
            
            preguntas = $scope.preloadpreguntas[newV]
            if(preguntas){
                for(var i=0;i<preguntas.length;i+=2){
                    $scope.preguntas.push([preguntas[i],preguntas[i+1]])
                }
            }
        });

        $scope.promedio = 0;
        $scope.calificaciones = [];
        $scope.range = [0,0,0,0,0,0,0,0,0,0];
        $scope.califica = function(i,q){
            $scope.calificaciones[q] = i;
            var sum = 0,
            promedio;
            for(var i=0;i<preguntas.length;i++){
                if($scope.calificaciones[i])
                    sum += $scope.calificaciones[i];
                else
                    $scope.calificaciones[i] = 0;
            }
            promedio = sum/preguntas.length;
            promedio = promedio.toString().length>3?promedio.toFixed(1):promedio;
            $scope.promedio = promedio;

            $scope.info_calificacion = {
                calificaciones:$scope.calificaciones,
                preguntas:preguntas.map(function(p){ return p.id})
            };
        };
    };
    controller.$inject = ['$scope','$http'];
    var directive = function () {
        return {
            controller : controller,
            scope : {
                tipo: '=',
                preloadpreguntas:'=',
		cct: '='
            },
            templateUrl: 'mteCalificaPreguntas.html'
        };
    };
    app.directive('mteCalificaPreguntas', directive);

}());
