app.service('templateData',[ function() {

    this.getVar = function(variable){
        return this[variable];
    }
    this.enlaceYears = [2006,2007,2008,2009,2010,2011,2012,2013,2014];
    this.semaforos = [
        {
            "label" : "Reprobado",
            "icon" : "icon-tache-01",
            "class" : "rank1"
        },
        {
            "label" : "De panzazo",
            "icon" : "icon-tache-01",
            "class" : "rank2"
        },
        {
            "label" : "Bien",
            "icon" : "icon-check-01",
            "class" : "rank3"
        },
        {
            "label" : "Excelente",
            "icon" : "icon-check-01",
            "class" : "rank4"
        },
        {
            "label" : "No toma la prueba ENLACE",
            "icon" : "icon-notomaenlace",
            "class" : "rank5"
        },
        {
            "label" : "Poco confiable",
            "icon" : "icon-pococonfiable",
            "class" : "rank6"
        },
        {
            "label" : "Esta escuela no toma la prueba ENLACE para todos los años",
            "icon" : "icon-notodoslosanos",
            "class" : "rank7"
        },
        {
            "label" : "Prueba ENLACE no disponible para este nivel escolar",
            "icon" : "icon-notomaenlace",
            "class" : "rank8"
        },
        {
            "label" : "Prueba ENLACE no disponible para este nivel escolar",
            "icon" : "icon-notomaenlace",
            "class" : "rank9"
        }
    ];
    this.niveles = [
        {
            id : 11,
            label : 'Preescolar',
            checked : false,
        },
        {
            id : 12,
            label : 'Primaria',
            checked : false,
        },
        {
            id : 13,
            label : 'Secundaria',
            checked : false,
        },
        {
            id : 22,
            label : 'Bachillerato',
            checked : false,
        },
        {
            id : 'BB',
            label : 'Biblioteca',
            checked : false,
        },
    ];
    this.turnos = [
        {
            id : 100,
            label : 'Matutino',
            checked : false,
        },
        {
            id : 200,
            label : 'Vespertino',
            checked : false,
        },
    ];
    this.controles = [
        {
            id : 1,
            label : 'Público',
            checked : false,
        },
        {
            id : 2,
            label : 'Privado',
            checked : false,
        },
    ];
}]);
