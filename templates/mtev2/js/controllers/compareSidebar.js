app.controller("compareSidebarCTL", ['$scope', '$mdSidenav','userInfo',function ($scope, $mdSidenav,userInfo) {
    
	//Agregamos un listener a nuestro service para mantener nuestros datos actualizados
	$scope.schools = userInfo.getSchools();
	//console.log($scope.schools.selected);
    userInfo.addListener($scope);
    $scope.$on('userInfo.schoolsChange',function(e,schools){
    	$scope.schools = userInfo.getSchools();
    });

    $scope.close = function() {
        $mdSidenav('comparaSidenav').close();
    };
    
}]);