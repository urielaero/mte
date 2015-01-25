(function () {
    var controller = function ($scope, $mdSidenav,userInfo) {
    
        //Agregamos un listener a nuestro service para mantener nuestros datos actualizados
        $scope.schools = userInfo.getSchools();
        userInfo.addListener($scope);
        $scope.$on('userInfo.schoolsChange',function(e,schools){
            $scope.schools = userInfo.getSchools();
        });

        $scope.close = function() {
            $mdSidenav('comparaSidenav').close();
        };

        $scope.toggleSchool = function(escuela){
            userInfo.toggleSchool(escuela);
        };
        
    };
    controller.$inject = ['$scope','$mdSidenav','userInfo'];
    var directive = function () {
        return {
            controller : controller,
            scope : {
                //model : '=',
            },
            templateUrl : 'comparaSidebar.html'
        };
    };
    app.directive('comparaSidebar', directive);

}());