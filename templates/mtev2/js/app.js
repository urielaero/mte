angular.module('mteFilters', []).
	filter('htmlToPlaintext', function() {
	return function(text) {
	  return angular.element(text).text();
	}
})
.filter('replaceWithCdnUrl', function() {
	return function(text, cdnUrl, blogUrl) {
	  return text.replace(blogUrl,cdnUrl);
	}
});

  
var app = angular.module("mejoratuescuela",['ngMaterial','perfect_scrollbar','leaflet-directive','ngCookies','ui.bootstrap','wu.masonry','mteFilters']);


/*
no implementado
app.config(['$routeProvider','$locationProvider',function($routeProvider, $locationProvider) {
	$routeProvider.when('/compara',{
		templateUrl : '/compara',
		controller : 'comparaCTL',
	});

  	$locationProvider.html5Mode(true);
}]);*/