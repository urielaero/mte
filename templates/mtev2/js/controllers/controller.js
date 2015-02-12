app.controller("headerCTL", ['$scope','$timeout','$mdSidenav','$cookieStore', function ($scope, $timeout, $mdSidenav,$cookieStore) {
	$scope.toggleLeft = function() {
		$mdSidenav('left').toggle();
	};
        $scope.back_v1 = function(){
        var user_agent = window.navigator && window.navigator.userAgent;
        ga('send', 'event', 'beta_button', 'no-beta', user_agent);
        $cookieStore.remove('beta_template','0');
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
        $location.path('/califica_tu_escuela/califica/'+data.escuela.cct);
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
