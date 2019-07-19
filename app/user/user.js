'use strict';

angular.module('toDoApp.user', ['ngRoute'])

.config(['$routeProvider', function($routeProvider) {
    $routeProvider/*.when('/user', {
        templateUrl: 'user/user.html',
        controller: 'userCtrl'
    })*/
    .when('/users/:username', {
        templateUrl: 'user/user.html',
        controller: 'userCtrl'
    });
}])

.controller('userCtrl', ['$scope', '$routeParams', '$location',
    function($scope, $routeParams, $location) {
        $scope.username = $routeParams.username;
        console.log($location.search());
}]);