(function () {
    var controller = function($scope,$http){
        if(!$scope.tipo){
            $scope.tipo = 'escuela';
        } 
        $scope.input = {
            json:true
        };
        var onlyOne = false;
        $scope.califica = function(commentOptional){
            if($scope.captcha){
                $scope.input.recaptcha_challenge_field = $scope.captcha.challenge;
                $scope.input.recaptcha_response_field = $scope.captcha.response;
            }

            if(onlyOne) return;
            onlyOne = true;
            if($scope.calificacion && $scope.calificacion.calificaciones.length){
                $scope.input.calificaciones = $scope.calificacion.calificaciones;
                $scope.input.preguntas = $scope.calificacion.preguntas;
                $scope.input.calificacion = $scope.promedio;
            }
            if(commentOptional)
                $scope.input.optional_comement = true;

            $http({
                method:'POST',
                data:$scope.input,
                url:'/escuelas/calificar'
            }).then(function(res){
                $scope.success = res.data.success;
                $scope.error = $scope.success?false:true;
                $scope.error_captcha = res.data.captcha;
                if($scope.error){
                    onlyOne = false;
                    //$scope.toggleForm = true;
                }
            });
        };
    };
    controller.$inject = ['$scope','$http'];
    var directive = function () {
        return {
            controller : controller,
            scope : {
                promedio: '=?',
                calificacion: '=?',
                tipo: '=?',
            },
            templateUrl: 'mteCalifica.html'
        };
    };
    app.directive('mteCalifica', directive);

}());
