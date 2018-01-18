;(function(){
    var directive = function () {
        return {
            restrict: 'A',
            scope: false,
            link: function($scope, $element, $atts) {
                var command = $atts.ga;
                var onEvent = function() {
                    if (command) {
                        if (command[0] === '\'') {
                            command = '[' + command + ']';
                        }
                        command = $scope.$eval(command);
                    }
                    ga.apply(null, command);
                };
                $element.bind('click', onEvent);
            }
        };
    };
    app.directive('ga', directive);
})();
