var app = angular.module("mejoratuescuela",['ngMaterial','perfect_scrollbar','leaflet-directive','ngCookies']);

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
            	//tweets[index] = $scope.replaceMentions($scope.replaceHashTags($scope.replaceURLWithHTMLLinks(tweet.text)));
            });
            $scope.tweets = tweets;
        });
	}
	$scope.twitterIni();
}]);

app.controller("escuelaCTL", ['$scope', '$mdSidenav',function ($scope, $mdSidenav) {
	$scope.selectedIndex = 0;
	$scope.countToggle = 0;
	$scope.toggleForm = false;
    $scope.toggleLeft = function() {
        $mdSidenav('comparaSidenav').toggle();
    };
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
    if(window.onLoadCallbackChart)
        onLoadCallbackChart.doneAngular(function(){
            $scope.loadCharts();
        });

    $scope.chart_colors = ["#16A452","#339DD1","#E9068B","#F6911B","#990099","#888888"];
    $scope.chart = [];
    $scope.loadCharts = function($event){
        if($event && angular.element($event.target).text().trim()!='Desempeñoacademico')
            return;
        var index = $scope.selectedIndex,
            options = {
                chartArea : {width:295,height:94,left:40,top:35},
                legend: {position:'none'},
                colors:$scope.chart_colors
            };
        Object.keys($scope.chart[index]).forEach(function(materia){
            var raw_data = $scope.chart[index][materia];
            if(raw_data){
                var data = google.visualization.arrayToDataTable(raw_data),
                chart = new google.visualization.LineChart(document.getElementById('profile-line-chart-'+materia));
                chart.draw(data, options);
            }
        });    
    };

    $scope.center = {
        zoom:12
    };
    $scope.markers = {lat:0,lng:0}
    $scope.loadMap = function(data,currentCct){
        var markers = data.escuelas.map(function(escuela,i,arr){
            var e = escuela.cct,
            escuelaRank1 = arr[arr.length-1] || {},
            escuelaRank2 = arr[arr.length-2] || {};
            
            if(e.indexOf('#')!=-1)
                return false;
            var current;
            if(e==currentCct && $scope.selectedIndex==0 && (escuelaRank1.cctRank == "#100" || escuelaRank2.cctRank=="#100"))
                current = escuelaRank1.cctRank=="#100"?escuelaRank1:escuelaRank2;
            else if(e==currentCct && $scope.selectedIndex==1 && (escuelaRank1.cctRank == "#200" || escuelaRank2.cctRank=="#200"))
                current = escuelaRank1.cctRank=="#200"?escuelaRank1:escuelaRank2;
            else
                current = escuela;
            current.lat = +current.latitud;
            current.lng = +current.longitud;
            current.message = "<div class='infoBox'>"+
                            "<a class='name esc-name' href='/escuelas/index/"+current.cct+"' >"+
                            current.nombre+
                            "<span class='semafo sem"+current.semaforo+"'></span>"+
                            "</a>"+
                        	"<div layout='row' class='rank-cont'><div class='rank' flex='20'>"+current.rank+"</div>"+
                        	"<div class='pos' flex='80'>Posición nivel estatal</div></div>"+
                            "<div class='address-popup'><p>"+current.direccion+"</p></div>"+
                            ""+
                            "</div>";
            var icon = currentCct==current.cct?current.semaforo:current.semaforo+'o';
            current.icon ={
                    iconUrl:'http://3903b795d5baf43f41af-5a4e2dc33f4d93e681c3d4c060607d64.r40.cf1.rackcdn.com/pins_'+icon+'.png',
                    iconSize:[28, 57],
            };
            return current;
        });
        angular.extend($scope,{
            center:{
                lat:+data.centerlat,
                lng:+data.centerlong,
                zoom:data.zoom
            },
            dafaults:{
                scrollWheelZoom: false
            },
            markers:markers.filter(function(e){
                return e;
            })
        });
    };
    $scope.scrollTo = function(target,event){
        event.preventDefault();
        setTimeout(
            function(){
                $('html, body').animate({
                    scrollTop: $('#' + target).offset().top
                }, 600);
            },
            300           
        );
    }
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


app.controller("compareSidebarCTL", ['$scope', '$mdSidenav',function ($scope, $mdSidenav) {
    $scope.close = function() {
        $mdSidenav('comparaSidenav').close();
    };
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
            {"lat" : 21.8852562, "lng" : -102.2915677},
            {"lat" : 30.8406338, "lng" : -115.2837585} ,
            {"lat" : 26.0444446, "lng" : -111.6660725 },
            {"lat" : 19.8301251, "lng" : -90.5349087 } ,
            {"lat" : 16.7569318, "lng" : -93.12923529999999},
            {"lat" : 28.6329957,"lng" : -106.0691004},
            {"lat" : 27.058676, "lng" : -101.7068294 },
            {"lat" : 19.2452342, "lng" : -103.7240868 },
            {"lat" : 19.2464696, "lng" : -99.10134979999999},
            {"lat" : 24.0277202, "lng" : -104.6531759 },
            {"lat" : 19.4968732, "lng" : -99.72326729999999 },
            {"lat" : 21.0190145, "lng" : -101.2573586 },
            {"lat" : 17.4391926, "lng" : -99.54509739999999 },
            {"lat" : 20.0910963, "lng" : -98.76238739999999 },
            {"lat" : 20.6595382, "lng" : -103.3494376 },
            {"lat" : 19.5665192, "lng" : -101.7068294 },
            {"lat" : 18.6813049, "lng" : -99.10134979999999 },
            {"lat" : 21.7513844, "lng" : -104.8454619 },
            {"lat" : 25.592172, "lng" : -99.99619469999999 },
            {"lat" : 17.0594169, "lng" : -96.7216219 },
            {"lat" : 25.4249499, "lng" : -101.2892991 },
            {"lat" : 20.5887932, "lng" : -100.3898881 },
            {"lat" : 19.1817393, "lng" : -88.4791376 },
            {"lat" : 22.1564699, "lng" : -100.9855409 },
            {"lat" : 25.1721091, "lng" : -107.4795173 },
            {"lat" : 29.2972247, "lng" : -110.3308814 },
            {"lat" : 17.8409173, "lng" : -92.6189273 },
            {"lat" : 24.26694, "lng" : -98.8362755 },
            {"lat" : 19.3181521, "lng" : -98.2375146 },
            {"lat" : 19.173773, "lng" : -96.1342241 },
            {"lat" : 20.7098786, "lng" : -89.0943377 },
            {"lat" : 22.7708555, "lng" : -102.5832426 }
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