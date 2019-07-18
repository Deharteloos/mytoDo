'use strict';

// Declare app level module which depends on views, and core components
angular.module('toDoApp', [
  'ngRoute',
  'toDoApp.main',
  'toDoApp.view2',
  'toDoApp.version'
]).
config(['$locationProvider', '$routeProvider', function($locationProvider, $routeProvider) {
  $locationProvider.hashPrefix('!');

  $routeProvider.otherwise({redirectTo: '/main'});
}]);
