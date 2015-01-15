var app = angular.module("mejoratuescuela", ['ngMaterial','perfect_scrollbar']);

app.controller("headerCTL", ['$scope','$timeout','$mdSidenav',function ($scope, $timeout, $mdSidenav) {
	$scope.toggleLeft = function() {
		$mdSidenav('left').toggle();
	};
}]);

app.controller("sidebarCTL", ['$scope','$timeout','$mdSidenav',function ($scope, $timeout, $mdSidenav) {
	$scope.close = function() {
		$mdSidenav('left').close();
	};
}]);


app.controller("twitterCTL", ['$scope','$http',function ($scope,$http) {
	
	$scope.replaceURLWithHTMLLinks = function(text) {
	    var exp = /(\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/ig;
	    return text.replace(exp,"<a href='$1'>$1</a>"); 
	}
	$scope.replaceHashTags = function(text) {
	    var exp = /#(\S*)/ig;
	    return text.replace(exp,"<a href='http://twitter.com/#!/search/$1'>#$1</a>"); 
	}
	$scope.replaceMentions = function(text) {
	    var exp = /@(\w{3,})/ig;
	    return text.replace(exp,"<a href='http://twitter.com/$1'>@$1</a>"); 
	}
	$scope.twitterIni = function(){
	    var username =  "mejoratuescuela";
		var page_proxy = '/home/twitter';	
        $http({method: 'GET', url: page_proxy})
        .success(function(tweets){
            tweets.forEach(function(tweet,index) {
            	console.log(tweets[index]);
            	//tweets[index] = $scope.replaceMentions($scope.replaceHashTags($scope.replaceURLWithHTMLLinks(tweet.text)));
            });
            $scope.tweets = tweets;
        });
	}
	$scope.twitterIni();
}]);

app.controller("escuelaCTL", ['$scope',function ($scope) {
	$scope.selectedIndex = 0;
	$scope.countToggle = 0;
	$scope.toggleForm = false;
    $scope.next = function() {
      $scope.selectedIndex = Math.min($scope.selectedIndex + 1, 2) ;
    };
    $scope.previous = function() {
      $scope.selectedIndex = Math.max($scope.selectedIndex - 1, 0);
    };
    $scope.toggleFormEvent = function(){
    	if($scope.countToggle == 0){
    		$scope.toggleForm = true;
    	}
    }
    $(document).ready(function(){
	    $('.footable').footable();
	    $('.footable tr td').click(function(){
	    	$(this).trigger('footable_toggle_row');
	    });
    });
}]);

app.controller("mejoraCTL", ['$scope',function ($scope) {
	$scope.countToggle = 0;
	$scope.toggleForm = false;
    $scope.toggleFormEvent = function(){
    	if($scope.countToggle == 0){
    		$scope.toggleForm = true;
    	}
    }
}]);


app.controller("compareCTL", ['$scope',function ($scope) {
	$scope.selectedIndex = 0;
	$scope.countToggle = 0;
	$scope.toggleForm = false;
    $scope.next = function() {
      $scope.selectedIndex = Math.min($scope.selectedIndex + 1, 2) ;
    };
    $scope.previous = function() {
      $scope.selectedIndex = Math.max($scope.selectedIndex - 1, 0);
    };
    $scope.toggleFormEvent = function(){
    	if($scope.countToggle == 0){
    		$scope.toggleForm = true;
    	}
    }
    $(document).ready(function(){
	    $('.footable').footable();
	    $('.footable tr td').click(function(){
	    	$(this).trigger('footable_toggle_row');
	    });
    });
}]);

app.controller("faqCTL", ['$scope',function ($scope) {
	$scope.toggleQuestion = function(e){
		var elem = angular.element(e.target);
		var content = elem.parent().find('.question-content');
		if(content.hasClass('on')){
			content.removeClass('on');
		}else{
			content.addClass('on');
		}
	}
}]);
