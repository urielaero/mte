var app = angular.module("mejoratuescuela",['ngMaterial','perfect_scrollbar','leaflet-directive']);

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
            escuelaRank1 = arr[arr.length-1],
            escuelaRank2 = arr[arr.length-2];
            
            if(e.indexOf('#')!=-1)
                return false;
            var current;
            if(e==currentCct && $scope.selectedIndex==0 && (escuelaRank1.cctRank == "#100" || escuelaRank1.cctRank=="#100"))
                current = escuelaRank1.cctRank=="#100"?escuelaRank1:escuelaRank2;
            else if(e==currentCct && $scope.selectedIndex==1 && (escuelaRank1.cctRank == "#200" || escuelaRank2.cctRank=="#200"))
                current = escuelaRank1.cctRank=="#200"?escuelaRank1:escuelaRank2;
            else
                current = escuela;
            current.lat = +current.latitud;
            current.lng = +current.longitud;
            current.message = "<div id='sample-infobox' class='infoBox'>"+
                            "<a href='/escuelas/index/"+current.cct+"' >"+current.nombre+"</a>"+
                        	"<p>"+current.direccion+"</p>"+
                        	"<div class='semafo sem"+current.semaforo+"'></div>"+
                        	"<div class='cup'></div>"+
                        	"<div class='rank'>"+current.rank+"</div>"+
                        	"<div class='pos'>Posición nivel estatal</div>"+
                            "<div class='clear'></div>"+
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


///Global functions
String.prototype.capitalize = function() {
    return this.charAt(0).toUpperCase() + this.slice(1).toLowerCase();
}
