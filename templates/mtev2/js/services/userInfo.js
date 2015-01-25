app.service('userInfo',['$rootScope','$http','$cookieStore', function($rootScope,$http,$cookieStore	) {
	//$cookieStore.put(this.cookiename,'');
	this.cookiename = 'escuelas';
	//console.log(this.schools);
    this.listeners = [];
    this.getCCTs = function(){
        var ccts = [];
        this.schools.selected.forEach(function(school){
            ccts.push(school.cct);
        });
        return ccts;
    }
    this.getSchools = function(){
        this.schools = $cookieStore.get(this.cookiename) || {visited:[],selected:[]};
        console.log(this.schools);
        return this.schools;
    }
    this.toggleSchool = function(escuela){
    	this.addSchool(escuela,this.schools.selected,true);
    	$cookieStore.put(this.cookiename,this.schools);
        this.emit('userInfo.schoolsChange');
    }
    this.visitSchool = function(escuela){
    	this.addSchool(escuela,this.schools.visited,false);
    	$cookieStore.put(this.cookiename,this.schools);
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
    	}else if(toggle)	
    		array.splice(index,1);
    	return array;
    }
    this.addListener = function(scope){
        this.listeners.push(scope);
    }
    this.indexOf = function(escuela,array){
    	for(var i=0;i<array.length;i++){
    		if(array[i].cct == escuela.cct) return i;
    	}
    	return -1;
    }
    this.emit = function(event,data){
        this.listeners.forEach(function(listener){
            //console.log('emmiting '+event);
            listener.$emit('userInfo.schoolsChange',data);
        });
    }
    this.getSchools();
    
}]);