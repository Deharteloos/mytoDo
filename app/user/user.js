'use strict';

angular.module('toDoApp.user', ['ngRoute'])

.config(['$routeProvider', function($routeProvider) {
    $routeProvider/*.when('/user', {
        templateUrl: 'user/user.html',
        controller: 'userCtrl'
    })*/
    .when('/users/:username/profil', {
        templateUrl: 'user/profil.html',
        controller: 'profilCtrl'
    })
    .when('/users/:username', {
        templateUrl: 'user/user.html',
        controller: 'userCtrl'
    });
}])

.controller('userCtrl', ['$scope', '$routeParams', '$location', '$http', function($scope, $routeParams, $location, $http) {
    $scope.username = ($routeParams.username !== undefined) ? $routeParams.username : sessionStorage.getItem('username');
    $scope.user = {};

    $scope.connected = $scope.username !== undefined;
    $scope.initForm = function () {
        $scope.modalTitle = "Nouvelle tâche";
        $scope.modalAction = "Créer";
    };
    // List of task
    $scope.tasks = [];
    $scope.totalItems = $scope.tasks.length;
    $scope.currentPage = 1;
    $scope.itemsPerPage = 5;
    $scope.maxSize = 3; //Number of pager buttons to show

    $scope.saveTask = function(modalTitle) {
        $scope.newTask.duration = $scope.duration_hour * 60 + $scope.duration_minute;
        if(angular.equals(modalTitle,'Nouvelle tâche')) {
            $http.post('scripts/create_task.php', {
                task : $scope.newTask,
                user_id : $scope.user.id
            })
                .then(function success(e) {
                    $scope.tasks.push(e.data.nTask);
                    $('#creerTacheForm').modal('hide');
                    $scope.clearModal();
                    //console.log(e);
                }, function error (e) {

                });
        }
        else {
            $http.post('scripts/edit_task.php', {
                task : $scope.newTask
            })
                .then(function success(e) {
                    $scope.listTasks();
                    $('#creerTacheForm').modal('hide');
                    $scope.clearModal();
                    //console.log(e);
                }, function error (e) {

                });
        }
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

    $scope.clearModal = function () {
        $scope.newTask = {};
        $scope.duration_hour = null;
        $scope.duration_minute = null;
    };

    $scope.showEditTask = function (task) {
        $scope.newTask = {};
        console.log(task.title);
        $scope.modalTitle = "Modification tâche";
        $scope.newTask.id = task.id;
        $scope.newTask.title = task.title;
        $scope.newTask.description = task.description;
        $scope.duration_hour = Math.floor(task.duration / 60);
        $scope.duration_minute = task.duration % 60;
        $scope.newTask.started_at = new Date(task.started_at);
        $scope.newTask.ended_at = new Date(task.ended_at);
        $scope.modalAction = 'Enregistrer';
        $('#creerTacheForm').modal('show');
    };

    if($scope.username !== undefined) {
        $scope.user = JSON.parse(sessionStorage.getItem('user'))/*$location.search().user*/;
        $scope.connected = true;
    }

    $scope.listTasks();
}])

.controller('profilCtrl', ['$scope', '$http', '$location', function ($scope, $http, $location) {
    var user = JSON.parse(sessionStorage.getItem('user'));
    $scope.username = user.username;
    $scope.name = user.name;
    $scope.email = user.email;

    $scope.updateProfile = function () {
        $http.post('scripts/update_user.php', {
            username: $scope.username,
            name: $scope.name,
            email: $scope.email,
            id: user.id
        })
            .then(function success(e) {
                user.name = $scope.name;
                user.username = $scope.username;
                user.email = $scope.email;
                sessionStorage.setItem('user', JSON.stringify(user));
                sessionStorage.setItem('username', user.username);
                $location.path('users/'+user.username+'/profil');
            }, function error(e) {

            });
    };

    $scope.updatePassword = function () {
        console.log(user);
        $http.post('scripts/update_userPwd.php', {
            formerPwd: $scope.formerPwd,
            newPwd: $scope.newPwd,
            id: user.id,
            pwd : user.password
        })
            .then(function success(e) {
                if(e.data.error === undefined && e.data.pwd !== undefined) {
                    user.password = e.data.pwd;
                    sessionStorage.setItem('user', JSON.stringify(user));
                    $location.path('users/'+user.username+'/profil');
                }
                else {
                    console.log(e.data.error);
                    $location.path('users/'+user.username+'/profil');
                    alert(e.data.error);
                }
            }, function error(e) {

            });
    };
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
