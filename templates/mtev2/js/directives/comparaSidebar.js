(function () {
    var controller = function ($scope, $mdSidenav,userInfo) {
        
        //Agregamos un listener a nuestro service para mantener nuestros datos actualizados
        $scope.schools = userInfo.getSchools();

        userInfo.addListener($scope);
        $scope.$on('userInfo.schoolsChange',function(e,schools){
            console.log('event received'+e);
            $scope.schools = userInfo.getSchools();
        });

        $scope.selectSchool = function(escuela){
            userInfo.toggleSchool(escuela);
        }

        $scope.isSelected = function(escuela){
            return userInfo.isSelected(escuela);
        }

        $scope.close = function() {
            $mdSidenav('comparaSidenav').close();
        };

        $scope.toggleSchool = function(escuela){
            userInfo.toggleSchool(escuela);
        };
        $scope.toggleComparador = function() {
            $mdSidenav('comparaSidenav').toggle();
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