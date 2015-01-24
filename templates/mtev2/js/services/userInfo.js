app.service('userInfo',['$http','$cookieStore', function($http,$cookieStore	) {
	//$cookieStore.put('schools','');
	this.schools = $cookieStore.get('schools') || {visited:[],selected:[]};
	console.log(this.schools);
    this.getCCTs = function(){
        var ccts = [];
        this.schools.selected.forEach(function(school){
            ccts.push(school.cct);
        });
        return ccts;
    }
    this.toggleSchool = function(escuela){
    	this.addSchool(escuela,this.schools.selected,true);
    	$cookieStore.put('schools',this.schools);
    }
    this.visitSchool = function(escuela){
    	this.addSchool(escuela,this.schools.visited,false);
    	$cookieStore.put('schools',this.schools);
    }
    this.isSelected = function(escuela){
    	return this.indexOf(escuela,this.schools.selected) >= 0;
    }
    this.hasSelected = function(){
    	return this.schools.selected.length > 0;
    }
    this.addSchool = function(escuela,array,toggle){
    	var index = this.indexOf(escuela,array);
    	if(index < 0){
    		array.push({
    			cct : escuela.cct,
    			nombre: escuela.nombre,
    			localidad : escuela.localidad,
    			entidad : escuela.entidad,
    		});
    	}
    	else if(toggle)	
    		array.splice(index,1);
    	return array;
    }
    this.indexOf = function(escuela,array){
    	for(var i=0;i<array.length;i++){
    		if(array[i].cct == escuela.cct) return i;
    	}
    	return -1;
    }
    
}]);