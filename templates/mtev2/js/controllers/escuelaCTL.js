app.controller("escuelaCTL", ['$scope', '$mdSidenav','userInfo',function ($scope, $mdSidenav,userInfo) {
	
    $scope.selectedIndex = 0;
	$scope.countToggle = 0;
	$scope.toggleForm = false;
    $scope.escuela = escuela;
    $scope.relatedSchoolParams = {
        nivel : $scope.escuela.nivel.id,
        turno : $scope.escuela.turno.id,
        localidad : $scope.escuela.localidad.id,
        limit : 6,
        sort : 'Semáforo educativo',

    }
    var currentSchool = { 
      id : $scope.escuela.id,
      cct : $scope.escuela.cct,
      nombre : $scope.escuela.nombre,
      entidad : $scope.escuela.entidad.nombre,  
      localidad : $scope.escuela.localidad.nombre,
      municipio : $scope.escuela.municipio.nombre,
    };
    userInfo.visitSchool(currentSchool);
    //console.log($scope.relatedSchoolParams);
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
        if(!data.escuelas.map && data.escuelas){
            data.escuelas = Object.keys(data.escuelas).map(function(es){
                return data.escuelas[es];
            })
        }
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
            //console.log(icon);
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
    };

    $scope.print = function(){
    	window.print();
    };

    $scope.isSelected = userInfo.isSelected(currentSchool);
    $scope.comparar = function(){
        userInfo.toggleSchool(currentSchool); 
        $scope.isSelected = userInfo.isSelected(currentSchool);
	if($scope.isSelected)
		location.href = '/compara/escuelas/';
    };


}]);
