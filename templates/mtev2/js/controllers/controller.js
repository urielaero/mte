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


app.controller("blogCTL", ['$scope', '$http', '$timeout', '$rootScope',function ($scope, $http, $timeout, $rootScope) {
    $scope.cdnUrl = 'http://3027fa229187276fb3fe-8b474283cd3017559b533eb77924d479.r81.cf2.rackcdn.com/';
    $scope.blogAddress = window.blogAddress;
    $scope.posts = [];
    $scope.getPosts = function(){
        $http.jsonp(
            $scope.blogAddress + '/api/get_category_posts/?category_slug=portada&count=2&callback=JSON_CALLBACK'
        ).then(function(response){
            $scope.posts = response.data.posts;
        });
    }
    /*$scope.posts = [
        'http://3027fa229187276fb3fe-8b474283cd3017559b533eb77924d479.r81.cf2.rackcdn.com/wp-content/uploads//2015/01/MTE_270115_OJO.png',
        'http://3027fa229187276fb3fe-8b474283cd3017559b533eb77924d479.r81.cf2.rackcdn.com/wp-content/uploads//2015/01/miamigofiel_matamoros.jpg',
        'http://3027fa229187276fb3fe-8b474283cd3017559b533eb77924d479.r81.cf2.rackcdn.com/wp-content/uploads//2015/01/shutterstock_206017312.jpg',
        'http://3027fa229187276fb3fe-8b474283cd3017559b533eb77924d479.r81.cf2.rackcdn.com/wp-content/uploads//2015/01/MTE_19012015_TipsEscuela.png',
        'http://3027fa229187276fb3fe-8b474283cd3017559b533eb77924d479.r81.cf2.rackcdn.com/wp-content/uploads//2015/01/shutterstock_199100342.jpg'
    ];*/
    $scope.showMoreBtn = false;
    $scope.getPosts();
    $timeout(function () {
       $rootScope.$broadcast('masonry.reload');
       $scope.showMoreBtn = true;
       }, 2000);
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



app.controller("mejoraCTL", ['$scope','$http','$timeout','$rootScope',function ($scope, $http, $timeout, $rootScope) {
	$scope.countToggle = 0;
	$scope.toggleForm = false;
    $scope.cdnUrl = 'http://3027fa229187276fb3fe-8b474283cd3017559b533eb77924d479.r81.cf2.rackcdn.com/';
    $scope.blogAddress = window.blogAddress;
    $scope.posts = [];
    $scope.getPosts = function(){
        $http.jsonp(
            $scope.blogAddress + '/api/get_category_posts/?category_slug=mejora&count=8&callback=JSON_CALLBACK'
        ).then(function(response){
            $scope.posts = response.data.posts;
        });
    }
    $scope.showMoreBtn = false;
    $scope.getPosts();
    $timeout(function () {
       $rootScope.$broadcast('masonry.reload');
       $scope.showMoreBtn = true;
       }, 2000);
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

app.controller("programaCTL", ['$scope',function ($scope) {
    $scope.states = window.entidadesParticipantes;
    $scope.center = {
        zoom:12
    };
    $scope.markers = {lat:0,lng:0};
    $scope.loadMap = function(states){
        var static_coords = [
            {"lat" : 0, "lng" : 0},
            {"lat" : 21.8852562, "lng" : -102.2915677}, //Aguascalientes
            {"lat" : 30.8406338, "lng" : -115.2837585} , //Baja California
            {"lat" : 26.0444446, "lng" : -111.6660725 }, //Baja California Sur
            {"lat" : 19.8301251, "lng" : -90.5349087 } , //Campeche
            {"lat" : 27.058676, "lng" : -101.7068294 }, //Coahuila
            {"lat" : 19.2452342, "lng" : -103.7240868 }, //Colima
            {"lat" : 16.7569318, "lng" : -93.12923529999999}, //Chiapas
            {"lat" : 28.6329957,"lng" : -106.0691004}, //Chihuahua
            {"lat" : 19.2464696, "lng" : -99.10134979999999}, //Df
            {"lat" : 24.0277202, "lng" : -104.6531759 }, //Durango
            {"lat" : 21.0190145, "lng" : -101.2573586 }, //Guanajuato
            {"lat" : 17.4391926, "lng" : -99.54509739999999 }, //Guerrero
            {"lat" : 20.0910963, "lng" : -98.76238739999999 }, //Hidalgo
            {"lat" : 20.6595382, "lng" : -103.3494376 }, //Jalisco
            {"lat" : 19.4968732, "lng" : -99.72326729999999 }, //Estado de México
            {"lat" : 19.5665192, "lng" : -101.7068294 }, //Michoacán
            {"lat" : 18.6813049, "lng" : -99.10134979999999 }, //Morelos
            {"lat" : 21.7513844, "lng" : -104.8454619 }, //Nayarit
            {"lat" : 25.592172, "lng" : -99.99619469999999 }, //Nuevo León
            {"lat" : 17.0594169, "lng" : -96.7216219 }, //Oaxaca
            {"lat" : 25.4249499, "lng" : -101.2892991 }, //Puebla
            {"lat" : 20.5887932, "lng" : -100.3898881 }, //Querétaro
            {"lat" : 19.1817393, "lng" : -88.4791376 },//Quintana Roo
            {"lat" : 22.1564699, "lng" : -100.9855409 },//San Luis Potosí
            {"lat" : 25.1721091, "lng" : -107.4795173 },//Sinaloa
            {"lat" : 29.2972247, "lng" : -110.3308814 },//Sonora
            {"lat" : 17.8409173, "lng" : -92.6189273 },//Tabasco
            {"lat" : 24.26694, "lng" : -98.8362755 },//Tamaulipas
            {"lat" : 19.3181521, "lng" : -98.2375146 },//Tlaxcala
            {"lat" : 19.173773, "lng" : -96.1342241 },//Veracruz
            {"lat" : 20.7098786, "lng" : -89.0943377 },//Yucatán
            {"lat" : 22.7708555, "lng" : -102.5832426 }// Zacatecas  
        ];
        var markers = states.map(function(state){
            var mark = static_coords[state.id];
            mark.icon ={
                    iconUrl:'http://3903b795d5baf43f41af-5a4e2dc33f4d93e681c3d4c060607d64.r40.cf1.rackcdn.com/pins_3.png',
                    iconSize:[28, 57],
            };
            mark.message = "<div class='infoBox'>"+
                            "<a class='name' href='#' >"+
                            state.nombre+
                            "</a>"+
                            "<div class='address-popup'><p>Participa en "+state.count_participa+" escuelas</p></div>"+
                            ""+
                            "</div>";
            return mark;
        });
        angular.extend($scope,{
            center:{
                lat : 22.1564699, 
                lng : -100.9855409, 
                zoom: 5
            },
            dafaults:{
                scrollWheelZoom: false
            },
            markers:markers.filter(function(e){
                return e;
            })
        });
    };
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
