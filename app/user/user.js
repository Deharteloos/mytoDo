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

.controller('userCtrl', ['$scope', '$routeParams', '$location', '$http', function($scope, $routeParams, $location, $http) {
    $scope.username = ($routeParams.username !== undefined) ? $routeParams.username : sessionStorage.getItem('username');
    $scope.user = {};

    $scope.connected = $scope.username !== undefined;
    // List of task
    $scope.tasks = [];
    $scope.totalItems = $scope.tasks.length;
    $scope.currentPage = 1;
    $scope.itemsPerPage = 5;
    $scope.maxSize = 3; //Number of pager buttons to show

    $scope.saveTask = function() {
        $scope.newTask.duration = $scope.duration_hour * 60 + $scope.duration_minute;
        $http.post('scripts/create_task.php', {
            task : $scope.newTask,
            user_id : $scope.user.id
        })
            .then(function success(e) {
                 $scope.tasks.push(e.data.nTask);
                 //console.log(e);
            }, function error (e) {

            });
    };

    $scope.listTasks = function () {
        $http.post('scripts/task_list.php', {
            id: $scope.user.id
        })
            .then(function success(e) {
                $scope.tasks = e.data.tasks;
            }, function error(e) {

            });
    };

    $scope.setPage = function (pageNo) {
        $scope.currentPage = pageNo;
    };

    $scope.pageChanged = function() {
        console.log('Page changed to: ' + $scope.currentPage);
    };

    $scope.setItemsPerPage = function(num) {
        $scope.itemsPerPage = num;
        $scope.currentPage = 1; //reset to first page
    };

    $scope.trunk = function(_time) {
        return Math.floor(_time);
    };

    if($scope.username !== undefined) {
        $scope.user = JSON.parse(sessionStorage.getItem('user'))/*$location.search().user*/;
        $scope.connected = true;
    }

    $scope.listTasks();
}])


.service('shareUser', function () {
    this.user = {};
});



/*
.controller("taskListCtrl", ['$scope', '$http', 'shareUser', function ($scope, $http, shareUser) {

    // List of task
    $scope.tasks = [];
    $scope.totalItems = $scope.tasks.length;
    $scope.currentPage = 1;
    $scope.itemsPerPage = 5;
    $scope.maxSize = 3; //Number of pager buttons to show
    $scope.user = shareUser.user;
    var _id = $scope.user.id;

    $scope.listTasks = function () {
        $http.post('scripts/task_list.php', {
            id: _id
        })
            .then(function success(e) {
                $scope.tasks = e.data.tasks;
            }, function error(e) {

            });
    };
    $scope.listTasks();

    $scope.setPage = function (pageNo) {
        $scope.currentPage = pageNo;
    };

    $scope.pageChanged = function() {
        console.log('Page changed to: ' + $scope.currentPage);
    };

    $scope.setItemsPerPage = function(num) {
        $scope.itemsPerPage = num;
        $scope.currentPage = 1; //reset to first page
    }

}])
*/
