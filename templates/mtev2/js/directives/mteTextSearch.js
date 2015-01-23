(function () {
    var controller = function($scope,$http){
        
    };
    controller.$inject = ['$scope','$http'];
    var directive = function () {
        return {
            controller : controller,
            scope : {
                
            },
            templateUrl : 'mteTextSearch.html'
        };
    };
    app.directive('mteTextSearch', directive);

}());