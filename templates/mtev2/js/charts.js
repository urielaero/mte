var onLoadCallbackChart = onLoad();

if(typeof google != 'undefined' && google.load){
	google.load("visualization", "1", {packages:["corechart"]});
    google.setOnLoadCallback(onLoadCallbackChart.doneGoogle);
}

function onLoad(){
    var google = false,
    angular = false,
    done = false,
    run = function(){
        if(google && angular && done)
            done();
    };
    return{
        doneGoogle:function(){
            google = true;
            run();
        },
        doneAngular:function(cb){
            done = cb;
            angular = true;
            run();
        }
    }
}
