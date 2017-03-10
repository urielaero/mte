app.controller("donationCTL", ['$scope',function ($scope){
    $scope.toPaypal = function(slt) { 
        console.log('run', slt);
        $scope.loader = true;
        jQuery(slt).submit();
    };
}]);
