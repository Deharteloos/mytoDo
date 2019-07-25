'use strict';

angular.module('toDoApp.admins', ['ngRoute'])

.config(['$routeProvider', function($routeProvider) {
    $routeProvider
        .when('/admin/:username/profil', {
            templateUrl: 'user/profil.html',
            controller: 'profilCtrl'
        })
        .when('/admin/:username', {
            templateUrl: 'admins/admin.html',
            controller: 'adminCtrl'
        });
}])

.controller('adminCtrl', ['$scope', function ($scope) {
    console.log(sessionStorage.getItem('admin'));
    $scope.works = 'Works';
}]);