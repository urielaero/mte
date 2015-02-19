app.controller("headerCTL", ['$scope','$timeout','$mdSidenav','$cookieStore', function ($scope, $timeout, $mdSidenav,$cookieStore) {
	$scope.toggleLeft = function() {
		$mdSidenav('left').toggle();
	};
        $scope.back_v1 = function(){
        var user_agent = window.navigator && window.navigator.userAgent;
        ga('send', 'event', 'beta_button', 'return_to_v1', user_agent);
        $cookieStore.remove('beta_template',0);
        location.reload();
    };

}]);

app.controller("sidebarCTL", ['$scope','$timeout','$mdSidenav',function ($scope, $timeout, $mdSidenav) {
	$scope.close = function() {
		$mdSidenav('left').close();
	};
}]);


app.controller("blogCTL", ['$scope', '$http', '$timeout', '$rootScope', '$filter',function ($scope, $http, $timeout, $rootScope, $filter) {
    $scope.cdnUrl = 'http://3027fa229187276fb3fe-8b474283cd3017559b533eb77924d479.r81.cf2.rackcdn.com/';
    $scope.blogAddress = window.blogAddress;
    $scope.posts = [];
    $scope.loading = true;
    var imgReg = /src="((http:\/\/.+)jpg)"/;
    $scope.getPosts = function(){
        var page = $scope.postsPage;
        $scope.loading = true;
        $http.jsonp(
            $scope.blogAddress + '/api/get_category_posts/?category_slug=portada&count=2&callback=JSON_CALLBACK'
        ).then(function(response){
            response.data.posts.forEach(function(p){
                var img = '';
                if(typeof p.thumbnail_images!='undefined'){
                    if(typeof p.thumbnail_images.large != 'undefined'){
                        img = p.thumbnail_images.large.url;
                    }
                    else if(typeof p.thumbnail_images.full != 'undefined'){
                        img = p.thumbnail_images.full.url;
                    }                    
                }else if(p.attachments[0]!='undefined' && p.attachments.length > 0){
                    img = p.attachments[0].url;                    
                }else if(p.content){
                    img = p.content.match(imgReg)[1];
                }
                var imgObj; 
                img = $filter('replaceWithCdnUrl')(img,$scope.cdnUrl, $scope.blogAddress);
                imgObj = new Image();
                imgObj.src = img;
                angular.element(imgObj).on('load', function (event) {
                    p.image = img;
                    $scope.posts.push(p);
                    //TODO: Revisar una alternativa a apply
                    $scope.$apply();
                    if($scope.posts.length % 2 == 0){
                        $scope.loading = false;
                    }
                });
            });
        });
    }

    $scope.getPosts();
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
        $http({method: 'POST', url: page_proxy})
        .success(function(tweets){
            tweets.forEach(function(tweet,index) {
            	//tweets[index] = $scope.replaceMentions($scope.replaceHashTags($scope.replaceURLWithHTMLLinks(tweet.text)));
            });
            $scope.tweets = tweets;
        });
	}
	$scope.twitterIni();
}]);



app.controller("mejoraCTL", ['$scope','$http','$timeout','$rootScope','$window','$filter',function ($scope, $http, $timeout, $rootScope, $window, $filter) {
	$scope.countToggle = 0;
	$scope.toggleForm = false;
    $scope.cdnUrl = 'http://3027fa229187276fb3fe-8b474283cd3017559b533eb77924d479.r81.cf2.rackcdn.com/';
    $scope.blogAddress = window.blogAddress;
    $scope.posts = [];
    $scope.postsPage = 1;
    $scope.maxPostCount = 4;
    $scope.loading = true;
    $scope.getPosts = function(){
        var page = $scope.postsPage;
        $scope.loading = true;
        $http.jsonp(
            $scope.blogAddress + '/api/get_category_posts/?category_slug=mejora&count=4&page='+page+'&callback=JSON_CALLBACK'
        ).then(function(response){
            response.data.posts.forEach(function(p){
                var img = '';
                if(typeof p.thumbnail_images!='undefined'){
                    if(typeof p.thumbnail_images.large != 'undefined'){
                        img = p.thumbnail_images.large.url;
                    }
                    else if(typeof p.thumbnail_images.full != 'undefined'){
                        img = p.thumbnail_images.full.url;
                    }
                }else if(p.attachments[0]!='undefined' && p.attachments.length > 0){
                    img = p.attachments[0].url;                    
                }else{
                    img = '';
                }
                var imgObj; 
                img = $filter('replaceWithCdnUrl')(img,$scope.cdnUrl, $scope.blogAddress);
                imgObj = new Image();
                imgObj.src = img;
                angular.element(imgObj).on('load', function (event) {
                    p.image = img;
                    $scope.posts.push(p);
                    //TODO: Revisar una alternativa a apply
                    $scope.$apply();
                    if($scope.posts.length % $scope.maxPostCount == 0){
                        $scope.loading = false;
                    }
                });
            });
            $scope.postsPage++;
        });
    }

    $scope.getPosts();

    $scope.goTo = function(url){
        $window.location.href = url;
    }


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


app.controller("calificaCTL", ['$scope',function ($scope) {
    $scope.selectedIndex = 0;
    $scope.range = [0,0,0,0,0,0,0,0,0,0];
    $scope.calificacion = {
        calificaciones:[],
        preguntas:[]
    };
    $scope.promedio = 0;
    $scope.califica = function(i,q){
        $scope.calificacion.calificaciones[q] = i;
        var sum = 0,
        promedio;
        for(var i=0;i<$scope.calificacion.total;i++){
            if($scope.calificacion.calificaciones[i])
                sum += $scope.calificacion.calificaciones[i];
            else
                $scope.calificacion.calificaciones[i] = 0;
        }
        promedio = sum/$scope.calificacion.total;
        promedio = promedio.toString().length>3?promedio.toFixed(1):promedio;
        $scope.promedio = promedio;

    };
}]);

app.controller("calificaIndexCTL",['$scope','userInfo','$location',function($scope,userInfo,$location){
    var visited_cct = userInfo.getCCTs('visited');
    var byCCT = {
        ccts:visited_cct.toString(),
        sort : 'Semáforo educativo'
    };

    if(visited_cct.length)
    	$scope.byCCT = byCCT;

    var isBiblioteca = /^..BB/;
    $scope.click = function(data){
    	data.e.preventDefault();
        //$location.path('/califica_tu_escuela/califica/'+data.escuela.cct);
        $scope.selectCCT = data.escuela.cct;
        if(isBiblioteca.test(data.escuela.cct))
            $scope.tipo = 'biblioteca';
        else
            $scope.tipo = "escuela";
        
    }
}]);

///Global functions
String.prototype.capitalize = function() {
    return this.charAt(0).toUpperCase() + this.slice(1).toLowerCase();
}
$(document).ready(function(){
    $('.footable').footable();
    $('.footable tr td').click(function(){
        $(this).trigger('footable_toggle_row');
    });

});
