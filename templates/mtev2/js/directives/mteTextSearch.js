(function () {
    var controller = function($scope,$http,$location){ 
            $scope.getSchool = function(name){
                return $http({method:'POST',url:'/api/escuelas',data:{term:name}}).then(function(res){
                    console.log(res.data);
                    if(res.data && res.data.escuelas)
                        return res.data.escuelas;
                    return [];
                });
    
            };

            $scope.onSelect = function($item){
                window.location = '/escuelas/index/'+$item.cct;
            }; 
    };
    controller.$inject = ['$scope','$http','$location'];
    var directive = function () {
        return {
            controller : controller,
            scope : {
                model : '=',
            },
            templateUrl: function (elem, attr){ 
                if(attr.temp === 'headerTextSearch'){
                    return 'headerTextSearch.html';
                }
                return 'mteTextSearch.html'
            }
        };
    };
    app.directive('mteTextSearch', directive);

}());
