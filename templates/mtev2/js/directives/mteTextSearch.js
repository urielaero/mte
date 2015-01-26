(function () {
    var controller = function($scope,$http,$location,userInfo){ 
        $scope.getSchool = function(name){
            return $http({method:'POST',url:'/api/escuelas',data:{term:name,solr:true}}).then(function(res){
                console.log(res.data);
                if(res.data && res.data.escuelas)
                    return res.data.escuelas;
                return [];
            });

        };
        $scope.toggleSchool = function(escuela){
            console.log('toggleSchool');
            userInfo.toggleSchool(escuela);
        };
        $scope.onSelect = function($item){
            window.location = '/escuelas/index/'+$item.cct;
        }; 
    };
    controller.$inject = ['$scope','$http','$location','userInfo'];
    var directive = function () {
        return {
            controller : controller,
            scope : {
                model : '=',
            },
            templateUrl: function (elem, attr){ 
                if(attr.temp == 'undefined'){
                    return 'mteTextSearch.html'
                }
                return attr.temp + '.html'
            }
        };
    };
    app.directive('mteTextSearch', directive);

}());
