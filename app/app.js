'use strict';

// Declare app level module which depends on views, and core components
angular.module('toDoApp', [
    'ngRoute',
    'ui.bootstrap',
    'toDoApp.main',
    'toDoApp.user',
    'toDoApp.admins',
    'toDoApp.version'
])

.directive('equalsTo', [function () {
    return {
        restrict: 'A',
        scope: true,
        require: 'ngModel',
        link: function (scope, elem, attrs, control) {
            var check = function () {
                //Valeur du champs courant
                var v1 = scope.$eval(attrs.ngModel); // attrs.ngModel = "ConfirmPassword"
                //valeur du champ à comparer
                var v2 = (scope.$eval(attrs.equalsTo !== undefined)) ? scope.$eval(attrs.equalsTo).$viewValue : undefined; // attrs.equalsTo = "Password"
                return v1 === v2;
            };

            scope.$watch(check, function (isValid) {
                // Défini si le champ est valide
                control.$setValidity("equalsTo", isValid);
            });
        }
    };
}])

.config(['$locationProvider', '$routeProvider', function($locationProvider, $routeProvider) {
  $locationProvider.hashPrefix('!');

  $routeProvider.otherwise({redirectTo: '/main'});
}]);
